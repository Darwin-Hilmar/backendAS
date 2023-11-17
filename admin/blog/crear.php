<?php

    require '../../includes/app.php';
    use App\Blog;
    use Intervention\Image\ImageManagerStatic as Image;


    estaAutenticado();

    $blog = new Blog;

    //Arreglo con mensajes de errores
    $errores = Blog::getErrores();

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Crea una nueva instancia
        $blog = new Blog($_POST['blog']);
        
        // Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true)) . ".png";

        // Setear la nueva imagen
        // Realiza un resize a la imagen con intervention
        if($_FILES['blog']['tmp_name']['imagen']){
            
            $image = Image::make($_FILES['blog']['tmp_name']['imagen']);
            $blog->setImagen($nombreImagen);
            $blog->setUrl($nombreImagen);
        }
        
        
        // Validar
        $errores = $blog->validar();

        //Revisar que el arreglo de errores este vacio
        if(empty($errores)){

            // Crear carpeta para subir imagenes
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }

            // Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            // Guarda en la base de datos
            $blog->guardar();
        }
    }

    includeTemplate('header');
?>




<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                <?php foreach($errores as $error): ?>
                    <div class="error_tls">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Crear un blog</h1>
                        </div>
                        
                        <form class="user" method="POST" action='/admin/blog/crear.php' enctype="multipart/form-data">
                            <?php include '../../includes/templates/formulario-blog.php' ?>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Guardar blog</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
    includeTemplate('footer');
?>