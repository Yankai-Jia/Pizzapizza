<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 11/25/2018
 * Time: 12:42 PM
 */

require 'static/common.php';
require 'static/user.php';

session_start();
$current_user = user();
$id = $current_user['user_id'];


if (isset($_GET['dish_id'])){
    $dish_id = $_GET['dish_id'];
    $sql = sprintf("delete from cart where user_id = '%d' and dish_id = '%d'", $id, $dish_id);
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