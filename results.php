<?php
include('config/db.php');

if (isset($_GET['search']) && empty($_GET['search'])) {
    header('location: index.php');
}

if (isset($_GET['cat'])) {
    $page_title = $_GET['cat'];
}
if (isset($_GET['search'])) {
    $page_title = "Results for: " . $_GET['search'];
}

$message = "";
?>

<?php
include('includes/head.php');
?>

<!-- Page Content -->
<div class="container" style="text-align: left; max-width: 1500px">
    <div class="row">
        <div class="col-lg-3">
            <?php
            include('includes/neon_shop_name.php');
            ?>
            <div class="list-group">
                <a href="results.php?cat=laptop" class="list-group-item">Laptop</a>
                <a href="results.php?cat=mobile" class="list-group-item">Phone</a>
                <a href="results.php?cat=tablet" class="list-group-item">Tablet</a>
                <a href="results.php?cat=smartWatch" class="list-group-item">Smart Watch</a>


            </div>

        </div>
        <div class="col-lg-9">

            <div class="row mt-5">

                <?php


                if (isset($_GET)) {
                    if (isset($_GET['cat'])) {
                        $cat = trim($_GET['cat']);
                        $query = "SELECT * FROM t_product WHERE p_category=:category";
                        $stmt = $pdo->prepare($query);
                        $exec = $stmt->execute(['category' => $cat]);

                    }

                    if (isset($_GET['search'])) {
                        $searchInput = trim($_GET['search']);
                        $query = "SELECT * FROM t_product WHERE p_name LIKE :searchInput 
                                UNION 
                                SELECT * FROM t_product WHERE p_category LIKE :searchInput 
                                UNION 
                                SELECT * FROM t_product WHERE p_description LIKE :searchInput 
                                UNION 
                                SELECT * FROM t_product WHERE p_brand LIKE :searchInput 
                        ";
                        $stmt = $pdo->prepare($query);
                        $exec = $stmt->execute(['searchInput' => "%" . $searchInput . "%"]);
                    }

                    if (isset($_GET['cat']) || isset($_GET['search'])) {
                        if ($exec) {
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


                                $desc = substr($desc, 0, 150);

                                echo " <div class='col-lg-4 col-md-6 mb-4'>
                                   <div class='card'>
                                    <a href='single_product.php?id={$id}'><img class='card-img-top' src='assets/img/products/{$img}' alt='$name' style='height: 300px'></a>
                                       <div class='card-body'>
                                       <h4 class='card-title'>
                                           <a href='single_product.php?id={$id}'>$name</a>
                                       </h4>
                                       <h5>$$price</h5>
                                        <p class='card-text'>$desc ... 
                                            <a href='single_product.php?id={$id}' class='btn btn-link'>Read more</a>
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
                        }
                    } else {
                        echo "<div class='alert alert-danger text-center'>No Result Found!</div>";
                    }
                }

                ?>
            </div>
            <?php
            if (isset($_GET['cat']) || isset($_GET['search'])) {
                if ($stmt->rowCount() <= 0) {
                    if (isset($_GET['cat'])) {
                        echo "<div class='alert alert-info text-center'>No Result Found for \" $_GET[cat] \"</div>";
                    } else if (isset($_GET['search'])) {
                        echo "<div class='alert alert-info text-center'>No Result Found for \" $_GET[search] \"</div>";
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- /.row -->


<?php
include('includes/tail.php');
?>

