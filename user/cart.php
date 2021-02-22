<?php

require('../config/db.php');
//Setting up cart

$productId = $quantity = $successMsg = $id = $errorMsg = "";
$productIdsArray = array();
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] == false) {
    header("location: ../login.php");
}


// Delete product from cart
if (isset($_GET, $_GET['remove'])) {
    $removeId = $_GET['remove'];

    if (($key = array_search($removeId, $productIdsArray)) !== false) {
        unset($productIdsArray[$key]);
        session_destroy();
    }
    if (isset($_SESSION, $_SESSION['CART'][$removeId])) {
        if (array_search($removeId, $_SESSION['CART'][$removeId]) !== false) {
            unset($_SESSION['CART'][$removeId]);
            header('location: cart.php');
        }
    }


}


if (isset($_POST['addToCartSubmit'], $_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $quantity = 1;
}


if ($quantity > 0) {
    if (isset($_SESSION['CART']) && is_array($_SESSION['CART'])) {

        if (array_key_exists($productId, $_SESSION['CART'])) {
            $_SESSION['CART'][$productId] += $quantity;
        } else {
            $_SESSION["CART"][$productId] = $quantity;
        }
    } else {
        $_SESSION['CART'] = array($productId => $quantity);
    }
}


// get products in the cart
$productsInCart = isset($_SESSION['CART']) ? $_SESSION['CART'] : array();
$products = array();
$totalPrice = 0.0;
$totalItem = count($_SESSION['CART']) - 1;
if ($productsInCart) {
    $array_to_question_marks = implode(',', array_fill(0, count($productsInCart), '?'));
    $query = "SELECT * FROM t_product WHERE p_id IN ($array_to_question_marks)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array_keys($productsInCart));
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // calc total
    foreach ($products as $product) {
        $id = $product['p_id'];
        $totalPrice += (float)$product['p_price'] * (int)$productsInCart[$id];
        // also push the chosen products id in the array
        array_push($productIdsArray, $id);
    }
}


// finish shopping

if (isset($_POST['checkout'])) {
    $isPaid = "true";
    $paidDate = date("Y-m-d", time());
    $shippingPrice = 0.0;

    if (isset($_SESSION) && isset($_SESSION['ID'])) {
        $userId = $_SESSION['ID'];
    }
    foreach ($products as $product) {

        $makeOrderQuery = "INSERT INTO t_order (o_userId, o_productId, o_isPaid, o_paidDate, o_shippingPrice, o_totalPrice, o_count)
                                VALUES (:userId,:productId,:isPaid,:paidDate,:shippingPrice,:totalPrice,:totalCount)";

        $stmt = $pdo->prepare($makeOrderQuery);

        if (!empty($productIdsArray)) {
            if (!empty($productsInCart[$id])) {
                $exec = null;
                if (is_array($productIdsArray) || is_object($productIdsArray)) {
                    $exec = $stmt->execute(['userId' => $userId, 'productId' => $product['p_id'], 'isPaid' => $isPaid, 'paidDate' => $paidDate,
                        'shippingPrice' => $shippingPrice, 'totalPrice' => $product['p_price'], 'totalCount' => $productsInCart[$id]]);

                }

                if ($exec) {
                    if (isset($_SESSION, $_SESSION['CART'])) {

                        foreach ($_SESSION['CART'] as $k => $val) {

                            if ($k !== "USER_ID") {
                                unset($_SESSION['CART'][$k]);
                                header('location: cart.php?msg=completeShopping');
                            }
                        }
                    }
                } else {
                    $errorMsg = "Sth went wrong on making order :(";
                }
            } else {
                $errorMsg = "Please add product to your cart first";
            }
        } else {
            echo "No product exist";
        }

    }
}

// set complete shopping msg
if (isset($_GET, $_GET['msg'])) {
    if ($_GET['msg'] == "completeShopping") {
        $successMsg = " Shopping Completed!
                        <br>
                        <a href='../shop.php' class='text-secondary'>
                         <i class='fa fa-arrow-left'></i> 
                         Back To Shop
                        </a> 
                         ";
    }
}

?>
<head>

    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <title>Cart</title>
</head>
<body>

<form class="card" style="padding: 0" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="row">
        <div class="col-md-8 cart">
            <?php
            if (!empty($successMsg)) {
                echo "<div class='alert alert-success text-center'> $successMsg</div>";
            }
            if (!empty($errorMsg)) {
                echo "<div class='alert alert-danger text-center'>$errorMsg</div>";
            }
            ?>
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Shopping Cart</b></h4>
                    </div>
                    <div class="col align-self-center text-right text-muted">Items: <?php echo $totalItem ?></div>
                </div>
            </div>

            <?php
            if (empty($products)) {

                echo "
                                <div class='alert alert-info text-center'>You have no products added in your Shopping Cart</div>
                ";

            } else {


                foreach ($products as $product) {

                    $img = $product['p_image'];
                    $name = $product['p_name'];
                    $category = $product['p_category'];
                    $price = $product['p_price'];


                    ?>


                    <div class="row border-top border-bottom">
                        <div class="row main align-items-center">
                            <div class="col-2"><img class="img-fluid"
                                                    src="../assets/img/products/<?php echo $img ?>">
                            </div>
                            <div class="col">
                                <div class="row text-muted"><?php echo $name ?></div>
                                <div class="row"><?php echo $category ?></div>
                            </div>
                            <div class="row col">
                                <div class="col-md-6 d-flex align-items-center justify-content-center">

                                    <select class='custom-select'
                                            name='quantity-<?php $product['p_id'] ?>'>
                                        <option class="text-primary"
                                                value="<?php echo $productsInCart[$product['p_id']] ?>"><?php echo $productsInCart[$product['p_id']] ?></option>
                                        <hr>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>


                                </div>
                                <div class="col-md-6 d-flex align-items-center justify-content-center">
                                    <div class="col">$<?php echo $price ?></div>
                                </div>
                            </div>
                            <a class="close" href="cart.php?remove=<?php echo $product['p_id'] ?>">&#10005;
                            </a>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>

        </div>
        <div class="col-md-4 summary">
            <div>
                <h5><b>Summary</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;">Total Items: <?php echo $totalItem ?></div>
                <div class="col text-right">$ <?php echo $totalPrice ?></div>
            </div>

            <p class="mt-5">SHIPPING</p>
            <select class="mb-5">
                <option class="text-muted">Standard-Delivery- $5.00</option>
            </select>

            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">TOTAL PRICE</div>
                <div class="col text-right">$ <?php echo $totalPrice ?></div>
            </div>

            <button class="btn btn-dark w-100" type="submit" name="checkout">CHECKOUT</button>
            <a class="btn btn-outline-dark w-100 mt-2" href="../shop.php">Continue Shopping</a>
        </div>
    </div>

</form>
</body>
