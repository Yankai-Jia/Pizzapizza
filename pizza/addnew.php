<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 11/26/2018
 * Time: 8:10 PM
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
        || empty($_POST['image'])) {

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
        $type = 0;






        /***

         gjjjjjjjjjjjjjjjjjjjj
         **/

        $sql = sprintf(
            "insert into dish values (null, '%s', '%s', '%d', '%s', '%d', '%s', '%d','%d')",
            $name,
            $description,
            $price,
            $category,
            $calorie,
            $feature,
            $inventory,
            $type
        );


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