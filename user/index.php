<?php
$page_title = "User Dashboard";
include('includes/functions.php');

?>

<?php
include('includes/head.php');
include('includes/sidebar.php');
?>
    <div id="page-content-wrapper">
        <div class="d-flex " id="wrapper" style="overflow: unset">
            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-6 col-md-6 col-xs-12">


                            <?php
                            $page="";
                            if (isset($_GET,$_GET['page'])){
                                $page=$_GET['page'];
                            }

                            switch ($page){
                                case "orders_list":
                                    include ('view_all_orders.php');
                                    break;

                                default:
                                    include ('edit_profile.php');
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('includes/tail.php');
?>