<?php

require '../../includes/app.php';
$auth = estaAutenticado();

use App\Blog;

// Implementar un método para obtener todas las propiedades
$blogs = Blog::all();

// Muestra el mensaje condicional
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];

    if(validarTipoContenido($tipo)){

        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($tipo === 'blog') {
            $blog = Blog::find($id);
            $blog->eliminar($id);
        }
    }
    
}

includeTemplate('header');
?>


<div class="container-fluid">
    <?php 
        if($resultado){
            $mensaje = mostrarNotificacion( intval( $resultado ) );

            if($mensaje){?>
                <h3 class="h3 mb-2 text-gray-800"><?php echo s($mensaje); ?></h3>
            <?php } 
        } 
    ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de blogs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Imagen</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Imagen</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($blogs as $blog): ?>
                        <tr>
                            <td><?php echo $blog->titulo; ?></td>
                            <td><?php echo $blog->autor; ?></td>
                            <td><img class="imagen-tabla" src="../../imagenes/<?php echo $blog->imagen; ?>" width="60%" alt="imagen"></td>
                            <td><?php echo $blog->descripcion; ?></td>
                            <td><?php echo $blog->creado; ?></td>
                            <td class="d-flex-column align-items-center justify-content-center">
                                
                                <?php 
                                    if($_SESSION['rol'] == 1){
                                ?>
                                    <a href="/admin/blog/actualizar.php?id=<?php echo $blog->id; ?>">
                                        <button type="submit" class="btn btn-primary form-control mb-3">
                                            <i class="fas fa-solid fa-pen"></i>
                                        </button>
                                    </a>
                                    
                                    
                                    <form name="eliminar" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este blog?');">
                                        <input type="hidden" name="id" value="<?php echo $blog->id; ?>">
                                        <input type="hidden" name="tipo" value="blog">
                                        <button type="submit" class="btn btn-danger form-control mb-3">
                                            <i class="fas fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                <?php
                                    }else if($_SESSION['rol'] == 2){
                                ?>
                                    <i class="fas fa-solid fa-user-shield fa-2x "></i>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
includeTemplate('footer');
?>