<?php
include('config/db.php');


?>

<?php
if (isset($_GET)) {
    if (isset($_GET['id'])) {
        $productId = trim($_GET['id']);
        $query = "SELECT * FROM t_product WHERE p_id=:productId";
        $stmt = $pdo->prepare($query);
        $exec = $stmt->execute(['productId' => $productId]);
    }

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

            $isAvailable = $isAvailable ? "Available" : "Not Available";

            ?>

            <?php
            $page_title = $name;
            include('includes/head.php');
            ?>
            <!-- Page Content -->
            <div class="container">


            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="position-sticky" style="top: 100px">
                        <h1 class="my-4 text-uppercase" style="top: 200px"><?php echo $name ?>
                            <small> By </small>
                            <small class="text-primary"> <?php echo $brand ?></small>
                        </h1>
                        <img class="img-fluid "
                             src="assets/img/products/<?php echo $img ?>" alt="">
                    </div>
                </div>

                <div class="col-md-12 col-lg-4">
                    <h3 class="my-3 text-uppercase text-secondary"><?php echo $name ?></h3>
                    <p><?php echo $desc ?></p>
                    <details>
                        <summary class="my-3 text-capitalize text-secondary">Product Details</summary>
                        <ul>
                            <li>Brand:
                                <span class="text-primary"><?php echo $brand ?></span>
                            </li>
                            <li>Color:
                                <span class="text-primary"><?php echo $color ?></span>
                            </li>
                            <li>Size:
                                <span class="text-primary"><?php echo $size ?></span>
                            </li>
                            <li>Weight:
                                <span class="text-primary"><?php echo $weight ?></span>
                            </li>
                            <li>Status:
                                <span class="text-primary"><?php echo $isAvailable ?></span>
                            </li>

                        </ul>
                    </details>
                </div>

            </div>
            <!-- /.row -->

            <?php
        }
    }
}
?>

    <!-- Related Projects Row -->
    <h3 class="my-4">Related Products</h3>

    <div class="row">

        <?php

        $query = "SELECT * FROM t_product WHERE p_category=:category";
        $stmt = $pdo->prepare($query);
        $exec = $stmt->execute(['category' => $category]);


        if ($exec) {
            $counter = 0;
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

                $counter++;

                ?>


                <div class="col-md-3 col-sm-6 mb-4 d-flex flex-column align-items-center justify-content-center">
                    <a href="single_product.php?id=<?php echo $id ?>">
                        <img class="img-fluid" src="assets/img/products/<?php echo $img ?>" alt="<?php echo $name ?>">
                    </a>
                    <a class="btn btn-link mt-1 " href="single_product.php?id=<?php echo $id ?>"><?php echo $name ?></a>
                </div>
                <?php

                if ($counter >= 8) {
                    break;
                }
            }
        }
        ?>
    </div>
    <!-- /.row -->

    </div>
    <!-- /.container -->

<?php
include('includes/tail.php');
?>