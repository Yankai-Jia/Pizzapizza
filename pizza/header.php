<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 11/26/2018
 * Time: 11:42 AM
 */

$current_user['username'];

?>
<link rel="stylesheet" href="assets/bootstrap.css">
<!--<link rel="stylesheet" href="css/index.css">-->
<div class="show">
    <div class="header">
        <div class="row">
            <div class="col-8 dropdown">
                <nav class="nav nav-pills nav-justified">
<!--                    <a class="nav-link  btn " href="assets/img/icon_pizzapizza.png">Logo</a>-->
                    <img src="assets/img/icon_pizzapizza.png" width="38" height="38" class="d-inline-block align-top">
                    <a class="nav-link btn " href="index.php">Home</a>
                    <a class="nav-link btn" href="about.html">About</a>
                    <?php if ($current_user['role']==1): ?>
                        <a class="nav-link btn" href="control.php">Administrator</a>
<!--                    --><?php //else: ?>
<!--                         <a class="nav-link btn" href="#Contact">Contact</a>-->
                    <?php endif; ?>
                </nav>
            </div>


            <div class="col-4">
                <div class="login">
                    <nav class="nav nav-pills nav-justified">
                        <?php if(isset($current_user)):?>
                            <p>"&nbsp"</p>
                            <a class="nav-link" href="account.php"><?php echo $current_user['username']?></a>
                            <p>"&nbsp"</p>
<!--                            <a class="nav-link" href="order.php">Cart</a>-->
<!--                            <img src="assets/img/cart.png" href="order.php" width="38" height="38" class="d-inline-block align-top">-->
                            <a href="order.php">
                                <img src="assets/img/cart.png" width="38" height="38" class="d-inline-block align-top">
                            </a>
                            <p>"&nbsp"</p>
<!--                            <a class="nav-link" href="wish.php">Wish List</a>-->
<!--                            <img src="assets/img/wish_list.png" href="wish.php" width="35" height="35"  class="d-inline-block">-->
                            <a href="wish.php">
                                <img src="assets/img/wish_list.png" width="35" height="35"  class="d-inline-block">
                            </a>
                            <p>"&nbsp"</p>
<!--                        --><?php //if(!isset($current_user) || $current_user=0):?>
<!--                            <a class="nav-link" href="login.php">Login</a>-->
<!--                            <a class="nav-link" href="signup.php">Sign Up</a>-->
<!--                        --><?php //endif;?>
                        <?php else:?>
                        <a class="nav-link" href="login.php">Login</a>
                        <a class="nav-link" href="signup.php">Sign Up</a>
                        <?php endif;?>


                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
