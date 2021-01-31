<?php
include('../config/db.php');

?>


    <form action="" method="post">
        <table class="table table-striped">

            <thead>
            <tr>
                <!--                <th><input id="selectAllBox" type="checkbox"></th>-->
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
            $select_all_products_query = "SELECT * FROM t_product ORDER BY p_id DESC";
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
                <!--                <td><input type="checkbox" class="checkboxes" name="checkBoxArray[]"-->
                <!--                           value="--><?php //echo $product_id ?><!--"></td>-->
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
                                          <a class='btn btn-sm btn-danger ' href='products.php?delete={$product_id}'>Delete</a>
                                          <a class='btn btn-sm btn-warning' href='products.php?chosen=editProduct&p_id={$product_id}'>Edit</a>
                                      </td>";
                echo "<tr>";

            }


            if (isset($_GET['delete'])) {
                $delete_id = $_GET['delete'];

                $delete_selected_pid_query = "DELETE FROM t_product WHERE p_id = {$delete_id}";
                $dl_stmt = $pdo->prepare($delete_selected_pid_query);

                if ($dl_stmt->execute()) {
                    echo "<h1 class='alert alert-success'>Product deleted successfully</h1>";
                    header("location: products.php");
                } else {
                    echo "<h1 class='alert alert-danger'>Something went wrong!</h1>";

                }
            }
            ?>
            </tbody>
        </table>
    </form>


<?php
include('includes/tail.php');
?>