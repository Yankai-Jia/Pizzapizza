<?php
/**
 * Created by PhpStorm.
 * User: newworld
 * Date: 11/24/18
 * Time: 8:29 PM
 */

session_start();
require 'static/common.php';
require 'static/user.php';

$current_user = user();
$id = $current_user['user_id'];

if (isset($_GET['data'])){
    $tip = $_GET['data'];
}
else $tip = 3;

$cart_dish = getDishByUserId($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        table{
            margin-left: 130px;
        }
    </style>
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h2>Shopping Cart</h2>
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Your cart</span>
                            <span class="badge badge-secondary badge-pill"><?php echo count($cart_dish) ?></span>
                        </h4>

    </div>
    <table class="table table-borderless">
        <?php $total_price= $tip; ?>
        <?php if(isset($cart_dish)):
            foreach ($cart_dish as $dish){ ?>
                <tr><td> * </td></tr>
                <th><?php echo $dish['name'];?></th>

                <tr>
                    <td>quantity</td>
                    <td><span class="badge badge-pill badge-dark"><?php echo $dish['dish_qty'] ?></span></td>
                </tr>
                <tr>
                    <td>favor</td>
                    <td><span class="badge badge-pill badge-dark"><?php echo $dish['flavor'] ?></span></td>
                </tr>
                <tr>
                    <td>price</td>
                    <td><span class="badge badge-pill badge-dark"><?php echo $dish['price'] * $dish['dish_qty']; ?></span></td>
                </tr>
                <tr>
                    <td><a href="k.php?dish_id=<?php echo $dish['id']; ?>">update</a></td>
                    <td><a href="cart_delete.php?dish_id=<?php echo $dish['id']; ?>">delete</a></td>
                </tr>

                <?php $total_price+=$dish['price'] * $dish['dish_qty']; ?>
            <?php } endif;?>
        <hr>
    </table>
    <br>
    <?php if( count($cart_dish) != 0):?>
    <div class="container">
        <div class="row">
            <div class="col col-lg-2">
                <span>Deliver fee (USD)</span>
            </div>
            <div class="col col-lg-2">
                <strong><?php echo $tip ?></strong>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col col-lg-2">
                <span>Tax (USD)</span>
            </div>

            <div class="col col-lg-2">
                <?php $tax =  $total_price  * 0.065 ?>
                <strong><?php echo $tax?></strong>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col col-lg-2">
                <span>Total (USD)</span>
            </div>
            <div class="col col-lg-2">
                <strong><?php echo $total_price + $tax?></strong>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <hr>
    <div class="container">
        <div class="row">
            <div class="col">.</div>
            <div class="col"><button type="button" class="btn btn-outline-primary" id="more">more</button></div>
            <div class="col"><button type="button" class="btn btn-outline-danger" id="check_out">check out</button></div>
            <div class="w-100"></div>
        </div>
    </div>
</div>
    <script src="assets/jquery.js"></script>
    <script>
        $(function () {
            $("#more").on('click', function () {
                location.href = "index.php"
            })

            $("#check_out").on('click', function () {
                location.href = "checkout.php"
            })
        })
    </script>

</body>
</html>