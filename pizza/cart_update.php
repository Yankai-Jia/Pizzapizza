<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 11/25/2018
 * Time: 11:44 AM
 */

require 'static/common.php';
require 'static/user.php';


session_start();

$current_user = user();
$id = $current_user['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $qty = (int)$_POST['qty'];
    $fla = $_POST['fla'];
    $dish_id = (int)$_GET['dish_id'];
    $user_id = (int) $id;
    echo var_dump($qty);
    echo var_dump($user_id);
    echo var_dump($dish_id);
    $sql = sprintf("update cart set dish_qty = '%d', flavor = '%s' where user_id = '%d' and dish_id = '%d'", $qty, $fla, $user_id, $dish_id);

    $affect_row = execute($sql);
    if($affect_row >0) {
        echo $affect_row;
        header('Location: order.php' );
    }
    else{
        echo "fail";
    }
}
else{
    echo "not post";
}
