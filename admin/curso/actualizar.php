<?php

    require '../../includes/app.php';
    use App\Curso;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();

    
    // Validar la URL por ID válido
    $id = validarORedireccionar('/admin/dashboard.php');

    // Obtener los datos del curso
    $curso = Curso::find($id);

    //Arreglo con mensajes de errores
    $errores = Curso::getErrores();

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Asignar los atributos
        $args = $_POST['curso'];
        // $args['titulo'] = $_POST['titulo'] ?? null;

        $curso->sincronizar($args);
        
        // Validar
        $errores = $curso->validar();

        // Generar un nombre unico
        // $nombreImagen = md5( uniqid( rand(), true)) . ".png";

        // Subida de archivos
        // if($_FILES['curso']['tmp_name']['imagen']){
        //     $image = Image::make($_FILES['curso']['tmp_name']['imagen']);
        //     $curso->setImagen($nombreImagen);
        //     $curso->setUrl($nombreImagen);
        // }

        //Revisar que el arreglo de errores este vacio
        if(empty($errores)){
            // if($_FILES['curso']['tmp_name']['imagen']){
            //     // Almacenar la imagen
            //     $image->save(CARPETA_IMAGENES . $nombreImagen);
            // }

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
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Actualizar un curso</h1>
                        </div>
                        
                        <form class="user" method="POST" enctype="multipart/form-data">
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