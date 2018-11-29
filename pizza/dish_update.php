<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 11/26/2018
 * Time: 1:38 PM
 */


require 'static/common.php';
require 'static/user.php';


session_start();

$current_user = user();
$id = $current_user['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['name'])
        || empty($_POST['price'])
        || empty($_POST['category'])
        || empty($_POST['description'])
        || empty($_POST['inventory'])
        || empty($_POST['calorie'])
        || empty($_POST['image'])
        || empty($_POST['search'])) {

        $message = 'please fill the form';

        echo $message;

    } else {



        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $inventory = $_POST['inventory'];
        $calorie = $_POST['calorie'];
        $feature = $_POST['image'];
        $search = $_POST['search'];


        $sql = sprintf("update dish 
                           set id = '%d', name = '%s',  description = '%s', price='%d', category = '%s',  calorie = '%d', inventory = '%d', photo = '%s'
                           where id = '%d'",
            $search, $name, $description, $price, $category, $calorie,$inventory, $feature, $search);

        $affect_row = execute($sql);

        if($affect_row >0) {
            echo $affect_row;
//            header('Location: control.php' );
        }
//        else{
////            echo "try again";
//        }
    }
}

//session_start();
//
//$current_user = user();
//$id = $current_user['user_id'];
//
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//
//
////    $qty = (int)$_POST['name'];
//    $price = $_POST['price'];
//    $name = $_POST['name'];
//    $des = $_POST['des'];
//    $category = $_POST['category'];
//    $inventory = (int)$_POST['inventory'];
//    $calorie = (int)$_POST['calorie'];
//    $id = (int)$_GET['dish_id'];
//    echo $id;
//    echo $calorie;
//
//    $sql = sprintf("update dish
//                           set id = '%d', name = '%s',  description = '%s', price='%d', category = '%s',  calorie = '%d', inventory = '%d'
//                           where id = '%d'",
//                           $id, $name, $des, $price, $category, $calorie,$inventory, $id);
//
//    echo $sql;
//    $affect_row = execute($sql);
//    if($affect_row >0){
//        echo $affect_row;
//        header('Location: control.php' );
//    }
//    else{
//        echo "fail";
//    }
//}
//    else{
//        echo "not post";
//    }
