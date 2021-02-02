<?php
<<<<<<< HEAD
<<<<<<< HEAD
require('../config/db.php');
//Setting up cart
$productId = $quantity = "";
$productIdsArray = array();
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] == false) {
    header("location: ../login.php");
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
    $productIdsArray = json_encode($productIdsArray);

    if (isset($_SESSION) && isset($_SESSION['ID'])) {
        $userId = $_SESSION['ID'];
    }
    $makeOrderQuery = "INSERT INTO t_order (o_userId, o_productId, o_isPaid, o_paidDate, o_shippingPrice, o_totalPrice, o_count)
                                VALUES (:userId,:productId,:isPaid,:paidDate,:shippingPrice,:totalPrice,:totalCount)";

    $stmt = $pdo->prepare($makeOrderQuery);

    if (!empty($productIdsArray)) {
        $exec = $stmt->execute(['userId' => $userId, 'productId' => $productIdsArray, 'isPaid' => $isPaid, 'paidDate' => $paidDate,
            'shippingPrice' => $shippingPrice, 'totalPrice' => $totalPrice, 'totalCount' => $totalItem]);

        if ($exec) {
            echo "Shopping Completed";
        } else {
            echo "Sth went wrong on making order :(";
        }
    } else {
        echo "No product exist";
    }

}


=======
>>>>>>> parent of 3a2e5c1... make cart
=======
>>>>>>> parent of 3a2e5c1... make cart
?>
<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/cart.css">
<div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Shopping Cart</b></h4>
                    </div>
<<<<<<< HEAD
<<<<<<< HEAD
                    <div class="col align-self-center text-right text-muted">Items: <?php echo $totalItem ?></div>
                </div>
            </div>

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <?php
                if (empty($products)) {
                    echo "
                                <div class='alert alert-info'>You have no products added in your Shopping Cart</div>
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
                                <div class="row ">
                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        <input style="width: 65px" type="number" class="form-control-sm"
                                               name="quantity-<?php $product['p_id'] ?>"
                                               value="<?php echo $productsInCart[$product['p_id']] ?>" min="1"
                                               max="<?php echo $product['p_count'] ?>" placeholder="1" required>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        <div class="col">&euro; <?php echo $price ?></div>
                                    </div>
                                </div>
                                <span class="close">&#10005;</span>
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
                <div class="col text-right">&euro; <?php echo $totalPrice ?></div>
            </div>
            <form>
                <p class="mt-5">SHIPPING</p>
                <select class="mb-5">
                    <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                </select>
                <p>GIVE CODE</p> <input id="code" placeholder="Enter your code">
            </form>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">TOTAL PRICE</div>
                <div class="col text-right">&euro; <?php echo $totalPrice ?></div>
            </div>

            <button class="btn btn-dark w-100" type="submit" name="checkout">CHECKOUT</button>
            <a class="btn btn-outline-dark w-100 mt-2" href="../shop.php">Continue Shopping</a>
        </div>
        </form>
=======
                    <div class="col align-self-center text-right text-muted">3 items</div>
                </div>
            </div>
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/1GrakTl.jpg"></div>
=======
                    <div class="col align-self-center text-right text-muted">3 items</div>
                </div>
            </div>
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/1GrakTl.jpg"></div>
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col"><a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a></div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
            <div class="row">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/ba3tvGm.jpg"></div>
>>>>>>> parent of 3a2e5c1... make cart
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col"><a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a></div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
<<<<<<< HEAD
            <div class="row">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/ba3tvGm.jpg"></div>
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col"><a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a></div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
=======
>>>>>>> parent of 3a2e5c1... make cart
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/pHQ3xT3.jpg"></div>
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col"><a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a></div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
            <div class="back-to-shop"><a href="#">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
        </div>
        <div class="col-md-4 summary">
            <div>
                <h5><b>Summary</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;">ITEMS 3</div>
                <div class="col text-right">&euro; 132.00</div>
            </div>
            <form>
                <p>SHIPPING</p> <select>
                    <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                </select>
                <p>GIVE CODE</p> <input id="code" placeholder="Enter your code">
            </form>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">TOTAL PRICE</div>
                <div class="col text-right">&euro; 137.00</div>
            </div>
            <button class="btn">CHECKOUT</button>
        </div>
<<<<<<< HEAD
>>>>>>> parent of 3a2e5c1... make cart
=======
>>>>>>> parent of 3a2e5c1... make cart
    </div>
</div>
