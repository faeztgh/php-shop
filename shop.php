<?php
require('config/db.php');
?>
    <!-- Bootstrap core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!--My Style-->
    <link rel="stylesheet" href="assets/css/shop.css">
<?php
$page_title = "Shop";
include('includes/navigation.php');
?>
    <link rel="stylesheet" href="assets/css/neon.css">


    <!-- Page Content -->
    <div class="container" style="text-align: left;  ">

        <div class="row">
            <div class="col-lg-3">
                <?php
                include('includes/neon_shop_name.php');
                ?>
                <div class="list-group">
                    <a href="results.php?cat=laptop" class="list-group-item">Laptop</a>
                    <a href="results.php?cat=mobile" class="list-group-item">Phone</a>
                    <a href="results.php?cat=tablet" class="list-group-item">Tablet</a>
                </div>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        $count = 7;
                        for ($i = 0; $i < $count; $i++) {
                            echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i'></li>";
                        }
                        ?>

                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $car_query = "SELECT * FROM t_product";

                        $car_stmt = $pdo->prepare($car_query);
                        $car_stmt->execute();
                        while (($car_row = $car_stmt->fetch()) && ($count > 0)) {

                            $name = $car_row['p_name'];
                            $category = $car_row['p_category'];
                            $img = $car_row['p_image'];


                            echo "<div class='carousel-item '>
                                      <img class='d-block img-fluid' src='assets/img/products/{$img}' alt='$name'>
                                  </div>";

                            $count--;

                        }
                        ?>

                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="assets/img/products/1.jpg" alt="First slide">
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

                <div class="row mt-5">

                    <?php
                    $query = "SELECT * FROM t_product";

                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    while ($productRow = $stmt->fetch()) {
                        $id = $productRow['p_id'];
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
                                    <a href='single_product.php?id={$id}'><img class='card-img-top' src='assets/img/products/{$img}' alt='$name'></a>
                                       <div class='card-body'>
                                       <h4 class='card-title'>
                                           <a href=''>$name</a>
                                       </h4>
                                       <h5>$$price</h5>
                                        <p class='card-text'>$desc ... 
                                            <a href='' class='btn btn-link'>Read more</a>
                                        </p>
                                        </div>
                                    <div class='card-footer d-flex justify-content-between'>
                                        <small class='text-muted align-self-end'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                 <form action='user/cart.php' method='post'>
                                 <input type='hidden' name='product_id' value='{$id}'>
                                       <button class='btn btn-outline-primary' type='submit' name='addToCartSubmit'>Add to Cart <i class='fa fa-shopping-cart'></i></button>
                                 </form>
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
include("includes/home/footer.php");
?>
<?php
include("includes/tail.php");
?>