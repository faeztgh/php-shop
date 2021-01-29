<?php
include('includes/head.php');
include('includes/functions.php');
?>

<?php
// setting up session

if (!isset($_SESSION)) {
    session_start();
} else {
    header("location: ../login.php");
}

if (isset($_SESSION)) {
    // if user be inactive for specified second session will be cleared
    // and user will be logged out automatically
    clearSessionWhileInactive(60 * 30);

    if (isset($_SESSION["LOGGEDIN"]) && $_SESSION['LOGGEDIN'] == true) {
        if ($_SESSION['ROLE'] == "user") {
            header('location: ../login.php');
        }
    } else {
        header('location: ../login.php');
    }
}
?>


    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right position-fixed pt-5" id="sidebar-wrapper">
            <div class="sidebar-heading">Admin Dashboard</div>
            <div class="list-group list-group-flush">
                <a href="view_products.php" class="list-group-item list-group-item-action bg-light">View Products</a>
                <a href="add_product.php" class="list-group-item list-group-item-action bg-light">Add
                    Product</a>
                <a href="edit_product.php" class="list-group-item list-group-item-action bg-light">Edit
                    Product</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">none</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">none</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <?php
            include('../includes/head.php');

            ?>
            <div class="container-fluid">

                <div class="animated fadeIn">
                    <div class="row align-items-center justify-content-center">

                        <div class="col-lg-4 col-md-6 col-xs-12">
<!--                            --><?php
//                            $currPage = "";
//                            if (isset($_GET['chosen'])) {
//                                $currPage = $_GET['chosen'];
//                            }
//                            switch ($currPage) {
//                                case "addProduct":
//                                    include('add_product.php');
//                                    break;
//                                case "editProduct":
//                                    include('edit_product.php');
//                                    break;
//                                default:
//                                    include('view_products.php');
//                                    break;
//
//                            }
//                            ?>
                        </div>
                    </div>
                    <!--/row-->
                </div>

            </div>
            <!--/.container-fluid-->

        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php
include('includes/tail.php') ;
?>