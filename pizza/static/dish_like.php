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
    $redis = new Redis();
    $redis->connect('127.0.0.1', '6379');



    if ($_POST['type'] == "add"){

        $res = $redis->incr($id);
        if(!$res)
            return 0;
        else return $res;

    }
}else{
    echo "sdf";
    $res = $redis->get($id);
//    $res = add_like($id, $num);
    return $res;
}