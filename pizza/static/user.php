<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 11/24/2018
 * Time: 4:34 PM
 */

function user(){
    if (empty($_SESSION['current_login_user'])){
//        header('Location:login.php');
        echo 'sdf';
    }
    return $_SESSION['current_login_user'];
}
