<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 12/11/2018
 * Time: 10:36 PM
 */

//echo phpinfo();

$redis = new Redis();
$redis->connect('127.0.0.1', '6379'); //建立redis服务连接
$redis->set('name', 'ysngshuiping'); //设置变量和变量值
echo $redis->get('name'); //获取变量值
var_dump($redis ->get("name"));
$redis ->mset(array("height1"=> 170 , "height2" => 190));
var_dump($redis -> mget(array('height1', 'height2')));

$me = new ReflectionClass("Redis");
var_dump($me ->getMethods());

$redis->close(); //关闭redis连接