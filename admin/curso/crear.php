<?php

    require '../../includes/app.php';
    use App\Curso;
    // use Intervention\Image\ImageManagerStatic as Image;


    estaAutenticado();

    $curso = new Curso;

    //Arreglo con mensajes de errores
    $errores = Curso::getErrores();

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Crea una nueva instancia
        $curso = new Curso($_POST['curso']);
        
        // Generar un nombre unico
        // $nombreImagen = md5( uniqid( rand(), true)) . ".png";

        // Setear la nueva imagen
        // Realiza un resize a la imagen con intervention
        // if($_FILES['curso']['tmp_name']['imagen']){
            
        //     $image = Image::make($_FILES['curso']['tmp_name']['imagen']);
        //     $curso->setImagen($nombreImagen);
        //     $curso->setUrl($nombreImagen);
        // }
        
        
        // Validar
        $errores = $curso->validar();

        //Revisar que el arreglo de errores este vacio
        if(empty($errores)){

            // Crear carpeta para subir imagenes
            // if(!is_dir(CARPETA_IMAGENES)){
            //     mkdir(CARPETA_IMAGENES);
            // }

            // Guarda la imagen en el servidor
            // $image->save(CARPETA_IMAGENES . $nombreImagen);

            // Guarda en la base de datos
            $curso->guardar();
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
                        
                        <div class="my-2"></div>
                        <a class="btn btn-danger btn-icon-split d-flex align-items-center justify-content-start mr-5 ml-5">
                            <span class="icon text-white-50">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            <span class="text"><?php echo $error; ?></span>
                        </a>

                    </div>
                <?php endforeach; ?>
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Crear un curso</h1>
                        </div>
                        
                        <form class="user" method="POST" action='/admin/curso/crear.php' enctype="multipart/form-data">
                            <?php include '../../includes/templates/formulario-curso.php' ?>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Guardar curso</button>
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