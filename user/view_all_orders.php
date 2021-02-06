<?php
include('../config/db.php');

?>

    <table class="table table-striped mt-5 pt-5">

        <thead>
        <tr>
            <th class="text-danger">ID</th>
            <th class="text-danger">User</th>
            <th class="text-danger">Product</th>
            <th class="text-danger">Count</th>
            <th class="text-danger">Order Date</th>
            <th class="text-danger">Payment Status</th>
            <th class="text-danger">Paid Date</th>
            <th class="text-danger">Shipping Price</th>
            <th class="text-danger">Total Price</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $select_all_orders_quer = "SELECT * FROM t_order ORDER BY o_id DESC";
        $stmt = $pdo->prepare($select_all_orders_quer);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $order_id = $row['o_id'];
            $order_userId = $row['o_userId'];
            $order_productId = $row['o_productId'];
            $order_orderDate = $row['o_orderDate'];
            $order_isPaid = $row['o_isPaid'];
            $order_paidDate = $row['o_paidDate'];
            $order_shippingPrice = $row['o_shippingPrice'];
            $order_totalPrice = $row['o_totalPrice'];
            $order_count = $row['o_count'];


            $order_isPaid = $order_isPaid ? "Payed" : "Not Payed";


            //Find User in DB
            $find_user_query = "SELECT * FROM t_user WHERE u_id=:u_id";
            $u_stmt = $pdo->prepare($find_user_query);
            $u_stmt->execute(['u_id' => $order_userId]);
            if ($u_row = $u_stmt->fetch()) {
                $userFullname = $u_row['u_name'] . " " . $u_row['u_lastName'];
            }

            // Retrieve products in DB
            $order_productId = json_decode($order_productId)[0];
            $select_all_products_query = "SELECT * FROM t_product WHERE p_id=:p_id";
            $p_stmt = $pdo->prepare($select_all_products_query);
            $p_stmt->execute(['p_id' => $order_productId]);

            while ($p_row = $p_stmt->fetch()) {
                $product_name = $p_row['p_name'];

                echo "<tr>";
                ?>


                <?php
                echo "<td>{$order_id}</td>";
                echo "<td>{$userFullname}</td>";
                echo "<td>{$product_name}</td>";
                echo "<td>{$order_count}</td>";
                echo "<td>{$order_orderDate}</td>";
                echo "<td>{$order_isPaid}</td>";
                echo "<td> {$order_paidDate}</td>";
                echo "<td> {$order_shippingPrice}</td>";
                echo "<td> {$order_totalPrice}</td>";


            }
        }


        ?>
        </tbody>
    </table>


<?php
include('includes/tail.php');
?>