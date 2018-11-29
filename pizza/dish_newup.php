<?php

require 'static/common.php';
require 'static/user.php';


session_start();

$current_user = user();
$id = $current_user['user_id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Keywords" content="Personal UTD">
    <meta name="description" content="Personal page">
    <title>add new dish</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/admin.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="assets/img/font-awesome.css">
    <style>
        button{
            float: left;
            margin-left: 15px;
        }
        #add{
            margin-left: 450px;
        }
    </style>

</head>

<body>

<div class="main">
    <div class="container-fluid" ">


        <form class="form-horizontal"  id="con" enctype="multipart/form-data">


            <div class="form-group">
                <label class="col-sm-3 control-label">image</label>
                <div class="col-sm-6">
                    <label class="form-image">
                        <input id="avatar" type="file">
                        <img id="image" src="assets/img/default.png">
                        <input type="hidden" id="avater">
                        <i class="mask fa"></i>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">name</label>
                <div class="col-sm-6">
                    <input id="name" class="form-control" name="name" type="type" placeholder="name">
                </div>
            </div>

            <div class="form-group">
                <label for="slug" class="col-sm-3 control-label">price</label>
                <div class="col-sm-6">
                    <input id="price" class="form-control" name="price" type="type" placeholder="price">
                </div>
            </div>

            <div class="form-group">
                <label for="nickname" class="col-sm-3 control-label">category</label>
                <div class="col-sm-6">
                    <input id="category" class="form-control" name="category" type="type" placeholder="category">
                </div>
            </div>

            <div class="form-group">
                <label for="bio" class="col-sm-3 control-label">description</label>
                <div class="col-sm-6">
                    <textarea id="description" class="form-control" placeholder="description" cols="30" rows="6">MAKE IT BETTER!</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="bio" class="col-sm-3 control-label">calorie</label>
                <div class="col-sm-6">
                    <input id="calorie" class="form-control" name="calorie" type="type" placeholder="calorie">
                </div>
            </div>

            <div class="form-group">
                <label for="bio" class="col-sm-3 control-label">inventory</label>
                <div class="col-sm-6">
                    <input id="inventory" class="form-control" name="inventory" type="type" placeholder="inventory">
                </div>
            </div>

        </form>
    </div>
<div class="container">
    <div class="row">
        <div class="col"> <button type="submit" class="btn btn-primary" id="add">add</button></div>
        
        <div class="col"><button type="submit" class="btn btn-primary" id="return">return</button></div>
    </div>
</div>

</div>


</body>
<script src="assets/jquery.js"></script>
<script>
    $('#avatar').on('change',function () {

        var $file=$(this).prop('files');
        if (!$file) return;
        var file=$file[0];
        var $this=$(this);

        //formdata can be used to send file to server with ajax
        var data= new FormData();
        data.append('avatar',file);
        console.log(data);
        //send ajax
        var xhr = new XMLHttpRequest();
        xhr.open('POST','upload.php');   //files must use post method
        xhr.send(data);
        xhr.onload=function () {
            console.log(this.responseText);
            $this.siblings('img').attr('src', this.responseText);
            $this.siblings('input').val(this.responseText);
        }

    });

    $('#add').on('click', function (e) {

        e.preventDefault();
        let name = $("#name").val();
        let price = $("#price").val();
        let inventory = $("#inventory").val();
        let category = $("#category").val();
        let description = $("#description").val();
        let calorie = $("#calorie").val();
        let image = $("#image").attr("src");

        $.ajax({
            url: 'addnew.php',
            data: {
                name: name,
                price: price,
                inventory: inventory,
                category: category,
                description: description,
                image: image,
                calorie: calorie

            },
            method: 'POST',
            success: function (res) {
                console.log(res);
                if (parseInt(res) === 1){
                    location.href = "control.php"
                }
                else if(res === 'please fill the form'){
                   $("#con").before(" <div class='alert alert-danger'>" +
                       "              <strong> please fill the form</strong>" +
                       "            </div>")
                }
                else {

                    $("#con").before(" <div class='alert alert-danger'>" +
                        "              <strong> please try again</strong>" +
                        "            </div>")

                }

            }

        });
    });
    $("return").on('click', function () {
        location.href = "control.php"
    })



</script>
</html>

