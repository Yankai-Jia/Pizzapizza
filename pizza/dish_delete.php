
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
    $sql = sprintf("update dish 
                           set type = 1
                           where id = '%d'",
                            $dish_id);

    $affect_row = execute($sql);
    if($affect_row >0) {
        echo $affect_row;
        header('Location: control.php' );
    }
    else{
        echo "fail";
    }
}