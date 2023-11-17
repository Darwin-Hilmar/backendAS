<?php

require '../../includes/app.php';
$auth = estaAutenticado();

use App\Curso;

// Implementar un método para obtener todas las propiedades
$cursos = Curso::all();

// Muestra el mensaje condicional
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];

    if(validarTipoContenido($tipo)){

        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($tipo === 'curso') {
            $curso = curso::find($id);
            $curso->eliminar($id);
        }
    }
    
}

includeTemplate('header');
?>


<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de cursos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Palabras Clave</th>
                            <th>Enlace</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Palabras Clave</th>
                            <th>Enlace</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($cursos as $curso): ?>
                        <tr>
                            <td><?php echo $curso->titulo; ?></td>
                            <td><?php echo $curso->autor; ?></td>
                            <td><?php echo $curso->pclave; ?></td>
                            <td><?php echo $curso->video; ?></td>
                        </div>
                            </td>
                            <td><?php echo $curso->descripcion; ?></td>
                            <td><?php echo $curso->creado; ?></td>
                            
                            <td class="d-flex-column align-items-center justify-content-center">
                                <?php 
                                    if($_SESSION['rol'] == 1){
                                ?>
                                    <a href="/admin/curso/actualizar.php?id=<?php echo $curso->id; ?>">
                                        <button type="submit" class="btn btn-primary form-control mb-3">
                                            <i class="fas fa-solid fa-pen"></i>
                                        </button>
                                    </a>
                    
                                    
                                    <form name="eliminar" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este curso?');">
                                        <input type="hidden" name="id" value="<?php echo $curso->id; ?>">
                                        <input type="hidden" name="tipo" value="curso">
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Verificar el valor de $alerta y mostrar la alerta correspondiente
        <?php
        if($resultado){

            $mensaje = mostrarNotificacion( intval( $resultado ) );

            if ($mensaje == true) {
                echo "Swal.fire('¡Formulario enviado!', ' Curso " . s($mensaje) . " ', 'success').then(function() {
                    window.location.href = 'visualizar.php';
                });";
            } else if ($alerta === false) {
                echo "Swal.fire('Error al enviar el formulario', 'No se ha podido enviar el formulario. Por favor, intenta nuevamente.', 'error');";
            }
        }
        ?>
    });
</script>


<?php
includeTemplate('footer');
?>