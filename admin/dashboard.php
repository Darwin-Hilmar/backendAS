
<?php

    require '../includes/app.php';
    $auth = estaAutenticado();
    use App\Blog;
    use App\Curso;

    $cantidadBlogs = 0;
    $cantidadCursos = 0;
    
    $blogs = Blog::all();
    $cursos = Curso::all();

    foreach($blogs as $blog): 
         $cantidadBlogs++;
         $mes_blog = date('m', strtotime($blog->creado));

         if (!isset($conteo_meses_blog[$mes_blog])) {
             $conteo_meses_blog[$mes_blog] = 1; // Inicializar el conteo del mes si no existe
         } else {
             $conteo_meses_blog[$mes_blog]++;
         }
    endforeach;
    
    $blogs_meses_json = json_encode($conteo_meses_blog);

    foreach($cursos as $curso): 
        $cantidadCursos++;
        $mes_curso = date('m', strtotime($curso->creado));

         if (!isset($conteo_meses_curso[$mes_curso])) {
             $conteo_meses_curso[$mes_curso] = 1; // Inicializar el conteo del mes si no existe
         } else {
             $conteo_meses_curso[$mes_curso]++;
         }
    endforeach;

    $cursos_meses_json = json_encode($conteo_meses_curso);


    includeTemplate('header');
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example --> 

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Blogs
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $cantidadBlogs; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-blog fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Cursos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $cantidadCursos; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-7">
                           <!-- Area Chart -->
                           <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Blogs por mes</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            var datosMesesBlog = <?php echo $blogs_meses_json; ?>;
                            miFuncionJavaScriptArea(datosMesesBlog);
                        </script>

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-7">
                           <!-- Area Chart -->
                           <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cursos por mes</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChartC"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <script>
                            var datosMesesCurso = <?php echo $cursos_meses_json; ?>;
                            miFuncionJavaScriptAreaC(datosMesesCurso);
                        </script>

                    </div>

                    <div class="row">
                         <!-- Pie Chart -->
                         <div class="col-xl-12 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Gràfico representativo</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Blogs
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> Cursos
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            miFuncionJavaScript(<?php echo $cantidadBlogs ?>, <?php echo $cantidadCursos ?>);
                        </script>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php
                includeTemplate('footer');
            ?>

  