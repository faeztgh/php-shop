<?php
require('config/db.php');
$page_title = "Shop";
include('includes/head.php');
?>


    <!-- Page Content -->
    <div class="container" style="text-align: left">

        <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">Shop Name</h1>
                <div class="list-group">
                    <a href="#" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="row">

                    <?php
                    $query = "SELECT * FROM product";

                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    while ($productRow = $stmt->fetch()) {

                        $name = $productRow['p_name'];
                        $category = $productRow['p_category'];
                        $img = $productRow['p_image'];
                        $price = $productRow['p_price'];
                        $desc = $productRow['p_description'];
                        $color = $productRow['p_color'];
                        $size = $productRow['p_size'];
                        $isAvailable = $productRow['p_isAvailable'];
                        $count = $productRow['p_count'];
                        $weight = $productRow['p_weight'];
                        $brand = $productRow['p_brand'];


                        $desc = substr($desc, 0, 200);

                        echo " <div class='col-lg-4 col-md-6 mb-4'>
                                   <div class='card h-100'>
                                    <a href=''><img class='card-img-top' src='assets/img/products/{$img}' alt='$name'></a>
                                       <div class='card-body'>
                                       <h4 class='card-title'>
                                           <a href=''>$name</a>
                                       </h4>
                                       <h5>$$price</h5>
                                        <p class='card-text'>$desc ... 
                                            <a href='' class='btn btn-link'>Read more</a>
                                        </p>
                                        </div>
                                    <div class='card-footer'>
                                        <small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                    </div>
                                </div>
                            </div>";
                    }

                    ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

<?php
include("includes/tail.php");
?>