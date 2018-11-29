<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 11/25/2018
 * Time: 3:01 PM
 */


require 'static/common.php';
require 'static/user.php';

session_start();
$current_user = user();
$id = $current_user['user_id'];
$dish_arr = [];


if (isset($_GET['data'])){
    $con = getConnection();
//    $data = $_GET['data'];
    $type = $_GET['type'];
    if (isset($_GET['category'])){
        $category = $_GET['category'];
    }

    if (isset($_GET['data'])){
        $data = $_GET['data'];
    }

//    echo $data .'data';
//    echo $data == '';
//    echo $category .'cate';


    if ($data != '' && $category !=''){
        $sql = "SELECT * FROM dish WHERE NAME LIKE '%$data%' and category = '$category'";
//        echo $sql;
    }

//        $sql = "SELECT * FROM dish WHERE NAME LIKE '%$data%'";
    else if ($data == '' && $category != ''){
        $sql = sprintf("SELECT * FROM dish WHERE category = '%s'", $category);
//        echo $sql;
    }
    else if ($data != '' && $category == ''){
        $sql = "SELECT * FROM dish WHERE NAME LIKE '%$data%'";
//        echo $sql;
    }

    else
        $sql = "SELECT * FROM dish ";

    $result = mysqli_query($con,$sql);
    if (!$result){
        exit('wrong') ;
    }

    while($row=mysqli_fetch_assoc($result)){
        array_push($dish_arr, $row);
    }
}

echo json_encode(array(
    'type' => $type,
    'success' => true,
    'data' => $dish_arr
));