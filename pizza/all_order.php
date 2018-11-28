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
$num = 1;

$orders = getOrderByUserId($id);
$order_ids = getDisDishByUserId($id);
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
        <h2>Orders History</h2>
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Orders</span>
            <span class="badge badge-secondary badge-pill"><?php echo count($orders) ?></span>
        </h4>

    </div>
    <table class="table table-borderless">

        <?php if(isset($orders)):
            foreach ($order_ids as $id){
               $total = 0;
                foreach ($orders as $order){

                    if ($order['order_id'] ==  $id['order_id']):
                    ?>

<!--                        <th>--><?php //echo $num ?><!--</th>-->
                        <th><?php echo $order['name'];?></th>
                        <tr>
                            <td><small><?php echo $order['built_time'] ?></small></td>
                        </tr>
                        <tr>
                            <td>quantity</td>
                            <td><span class="badge badge-pill badge-warning"><?php echo $order['dish_qty'] ?></span></td>
                        </tr>
                        <tr>
                            <td>favor</td>
                            <td><span class="badge badge-dark"><?php echo $order['flavor'] ?></span></td>
                        </tr>
                        <tr>
                            <td>delivery info</td>
                            <td><span class="badge  badge-info"><?php echo $order['delivery_info']; ?></span></td>
                        </tr>
<!--                        <tr>-->
<!--                            <td>Delivery fee</td>-->
<!--                            <td><span class="badge  badge-primary">--><?php //echo $order['delivery_fee']; ?><!--</span></td>-->
<!--                        </tr>-->
                        <tr><td> <td></tr>
                        <?php $total += $order['overall_price']; ?>
                <?php endif; } ?>


                <tr>
                    <th> Total Price </th>
                    <td><span class="badge  badge-primary"><?php echo $total ?></span></td>
                </tr>
                <tr><td> <td></tr>
        <?php  $total = 0; } endif;?>
        <hr>
    </table>
    <br>

<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col col-lg-2">-->
<!--                <span>Tax (USD)</span>-->
<!--            </div>-->
<!--            <div class="col col-lg-2">-->
<!--                --><?php //$tax =  $total_price  * 0.63 ?>
<!--                <strong>--><?php //echo $tax?><!--</strong>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col col-lg-2">-->
<!--                <span>Total (USD)</span>-->
<!--            </div>-->
<!--            <div class="col col-lg-2">-->
<!--                <strong>--><?php //echo $total_price + $tax?><!--</strong>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <hr>
    <div class="container">
        <div class="row">
            <div class="col">.</div>
            <div class="col"><button type="button" class="btn btn-outline-primary" id="more">more</button></div>
            <div class="col"><button type="button" class="btn btn-outline-danger" id="check_out">return</button></div>
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
            location.href = "account.php"
        })
    })
</script>

</body>
</html>