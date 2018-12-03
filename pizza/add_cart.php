<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 11/24/2018
 * Time: 8:24 PM
 */

require 'static/common.php';
require 'static/user.php';


session_start();

$current_user = user();
//if ($current_user=0){
//    header('Location:login.php');
//}
$id = $current_user['user_id'];

echo "iouoiuo";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    echo "add";
//    if ($user_id=0){
//        header('Location:login.php');
//    }
//    else{

        $qty = (int)$_POST['qty'];
        $fla = $_POST['fla'];
        $dish_id = (int)$_GET['dish_id'];
        $user_id = (int) $id;
        echo var_dump($qty);
        echo var_dump($user_id);
        echo var_dump($dish_id);
        $sql = sprintf(
            "insert into cart values (null, '%d', '%d', '%d', '%s', '%s')",
            $user_id,
            $dish_id,
            $qty,
            'sdf',
            $fla

        );

        $affect_row = execute($sql);
        if($affect_row >0) {
//            echo $sql;
            echo $affect_row;
            header('Location: index.php');
        }
        else{
            echo "fail";
        }

//    }

}
else{
    echo "not post";
}
