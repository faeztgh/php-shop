<?php
include('includes/functions.php');
setupSession();
?>
<?php

if (isset($_GET['chosen'])) {
    $currPage = $_GET['chosen'];
} else {
    $currPage = "";
}
?>
<?php
$page_title = "Manage Products";
include('includes/head.php');
include('../includes/navigation.php');
include('includes/sidebar.php');
?>
<div id="page-content-wrapper">
    <div class="d-flex " id="wrapper" style="overflow: unset">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <?php
                        switch ($currPage) {
                            case "addProduct":
                                include('add_product.php');
                                break;
                            case "editProduct":
                                include('edit_product.php');
                                break;
                            case "viewOrders":
                                include('view_all_orders.php');
                                break;
                            case "viewProducts":
                                include('view_products.php');
                                break;
                            default:
                                include('error.php');
                                break;
                        }
                        ?>
                    </div>
                </div>
                <!--/row-->
            </div>
        </div>
    </div>
    <!--/.container-fluid-->
</div>

