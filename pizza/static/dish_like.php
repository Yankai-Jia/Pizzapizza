<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 12/10/2018
 * Time: 7:06 PM
 */

require 'common.php';

if ( $_SERVER['REQUEST_METHOD'] == "POST"){

    $num = $_POST['num'];
    $id = $_POST['id'];


    if ($_POST['type'] == "add"){
        $num = $num +1;
        $res = add_like($id, $num);
        return $res;

    }
}else{
    echo "sdf";
    $num = $num - 1;
    $res = add_like($id, $num);
    return $res;
}