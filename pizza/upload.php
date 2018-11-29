<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 11/26/2018
 * Time: 5:34 PM
 */

if (empty($_FILES['avatar'])){
    exit('must upload file');
}

$avatar = $_FILES['avatar'];
if ($avatar['error']!='UPLOAD_ERO_OK'){
    exit('file upload fail');
}

// file move

$ext=pathinfo($avatar['name'], PATHINFO_EXTENSION);

$target='assets/uploads/'.uniqid(). '.'.$ext;


//var_dump($avatar);
//var_dump($ext);

if (!move_uploaded_file($avatar['tmp_name'], $target)){
    exit('upload fail');
}

echo substr($target, 0);
