
<?php
/**
 * Created by PhpStorm.
 * User: newworld
 * Date: 11/24/18
 * Time: 3:34 PM
 */
require 'static/common.php';
require 'static/user.php';

session_start();
$current_user = user();
$id = $current_user['user_id'];
$user_info = getUserDB($id);
$cart_dish = getDishByUserId($id);
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <title>Account</title>
    <link rel="stylesheet" href="css/index.css">
    <meta charset="utf-8">
</head>

<body class="bg-light">
<?php include 'header.php'; ?>
<div class="container" style="">
    <div class="py-5 text-center">
        <h2>My Account</h2>
    </div>

    <div class="py-5 text-center">
        <p>
            <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <p>Address</p>

            </a>
        </p>

        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <div>
                    <p>First name: <?php echo $user_info[0]['first_name']?></p>
                    <p>Last name: <?php echo $user_info[0]['last_name']?></p>
                    <p>Email: <?php echo $user_info[0]['email']?></p>
                    <p>Phone Number: <?php echo $user_info[0]['mobile']?></p>

                </div>
            </div>
        </div>

        <p>
            <a data-toggle="collapse" href="#colorder" aria-expanded="false" aria-controls="collapseExample">
                <p>View my cart</p>

            </a>
        </p>

        <div class="collapse" id="colorder">
            <div class="card card-body">
                <div>
                    <?php if (count($cart_dish) >0) :?>
                    <a href="order.php">Cart</a>
                    <?php else: ?>
                    <p>no item here</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <p>
            <a data-toggle="collapse" href="#colckeck" aria-expanded="false" aria-controls="collapseExample">
        <p>View my order</p>

        </a>
        </p>

        <div class="collapse" id="colckeck">
            <div class="card card-body">
                <div>
                    <?php if (count($cart_dish) >0) :?>
                        <a href="all_order.php">history</a>
                    <?php else: ?>
                        <p>no item here</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div>
            <a href="logout.php">Log Out</a>
        </div>

    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2018-2019 Pizzapizza</p>
    </footer>
</div>
</body>