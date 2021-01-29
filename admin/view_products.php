<?php
include('../config/db.php');
$page_title = "View Products";
include('../includes/head.php');
?>


    <div class="container-fluid mt-5 pt-5">
        <div class="animated fadeIn">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-11 col-md-11 col-xs-12 m-auto">
                    <form action="" method="post">
                        <table class="table table-striped">

                            <thead>
                            <tr>
                                <th><input id="selectAllBox" type="checkbox"></th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Is Available</th>
                                <th>Added Date</th>
                                <th>Count</th>
                                <th>Weight</th>
                                <th>Brand</th>
                                <th>Tags</th>
                                <th>Operation</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $select_all_products_query = "SELECT * FROM product ORDER BY p_id DESC";
                            $stmt = $pdo->prepare($select_all_products_query);
                            $stmt->execute();
                            while ($row = $stmt->fetch()) {
                                $product_id = $row['p_id'];
                                $product_name = $row['p_name'];
                                $product_category = $row['p_category'];
                                $product_image = $row['p_image'];
                                $product_price = $row['p_price'];
                                $product_desc = $row['p_description'];
                                $product_color = $row['p_color'];
                                $product_size = $row['p_size'];
                                $product_isAvailable = $row['p_isAvailable'];
                                $product_addedDate = $row['p_addedDate'];
                                $product_count = $row['p_count'];
                                $product_weight = $row['p_weight'];
                                $product_brand = $row['p_brand'];
                                $product_tags = $row['p_tags'];

                                $product_desc = substr($product_desc, 0, 50);
                                echo "<tr>";
                                ?>
                                <td><input type="checkbox" class="checkboxes" name="checkBoxArray[]"
                                           value="<?php echo $product_id ?>"></td>
                                <?php
                                echo "<td>{$product_id}</td>";
                                echo "<td>{$product_name}</td>";
                                echo "<td>{$product_category}</td>";
                                echo "<td width='100'><img src='../assets/img/products/{$product_image}' style='max-width: 100%;'> </td>";
                                echo "<td>\${$product_price}</td>";
                                echo "<td> {$product_color}</td>";
                                echo "<td> {$product_size}</td>";
                                echo "<td> {$product_isAvailable}</td>";
                                echo "<td>{$product_addedDate}</td>";
                                echo "<td>{$product_count}</td>";
                                echo "<td>{$product_weight}</td>";
                                echo "<td>{$product_brand}</td>";
                                echo "<td>{$product_tags}</td>";
                                echo "<td>
                                          <a class='btn btn-sm btn-danger' href='post.php?delete={$product_id}'>Delete</a>
                                          <a class='btn btn-sm btn-warning' href='post.php?source=edit_post&p_id={$product_id}'>Edit</a>
                                      </td>";
                                echo "<tr>";

                            }


                            ?>
                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
            <!--/row-->
        </div>

    </div>
    <!--/.container-fluid-->

<?php
include('includes/tail.php');
?>