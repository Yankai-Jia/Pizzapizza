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

$wishes = getWishList($id);


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
        <h2> Wish List</h2>
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your wish list</span>
            <span class="badge badge-secondary badge-pill"><?php echo count($wishes) ?></span>
        </h4>

    </div>
    <table class="table table-borderless">

        <?php if(isset($wishes)):
            foreach ($wishes as $wish){ ?>
                <tr><td> * </td></tr>
                <th><?php echo $wish['name'];?></th>

                <tr>
                    <td><a href="wish_delete.php?dish_id=<?php echo $wish['id']; ?>">delete</a></td>
                </tr>

            <?php } endif;?>
        <hr>
    </table>

    <hr>
    <div class="container">
        <div class="row">
            <div class="col">.</div>
            <div class="col"><button type="button" class="btn btn-outline-primary" id="more">more</button></div>
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
    })


</script>

</body>
</html>