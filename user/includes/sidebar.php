<!-- Sidebar -->
<?php
if (isset($_SESSION['CART'])) {
    $cartCount = count($_SESSION['CART']) - 1;
}
?>

<style>
    .badge {
        padding: 10px;
        -webkit-border-radius: 9px;
        -moz-border-radius: 9px;
        border-radius: 50px;
    }


    #lblCartCount {
        font-size: 10px;
        background: #ff0000;
        color: #fff;
        padding: 3px 5px;
        vertical-align: top;
        margin-left: -10px;
    }
</style>

<div class="bg-dark text-light border-right position-fixed pt-5" id="sidebar-wrapper" style="z-index: 1; top: 0">
    <div class="sidebar-heading">User Dashboard</div>
    <div class="list-group list-group-flush">
        <a href="cart.php" class="list-group-item list-group-item-action bg-dark text-light">
            <span class='badge badge-danger'  id='lblCartCount'> <?php echo $cartCount ?></span>
            <i  class="fa fa-shopping-bag"></i> Cart
        </a>
        <a href="edit_profile.php" class="list-group-item list-group-item-action bg-dark text-light ">
            <i class="fa fa-user"> </i> Edit Profile
        </a>


    </div>
</div>
<!-- /#sidebar-wrapper -->