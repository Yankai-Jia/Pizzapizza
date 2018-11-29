<?php

require 'static/common.php';
require 'static/user.php';


session_start();

$current_user = user();
$id = $current_user['user_id'];

if (isset($_GET['dish_id'])){
    $id = $_GET['dish_id'];
    $detail_dish = getDishByID($id);
}
//
//
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//
//
////    $qty = (int)$_POST['name'];
//    $price = $_POST['price'];
//    $name = $_POST['name'];
//    $description = $_POST['des'];
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
//        $id, $name, $des, $price, $category, $calorie,$inventory, $id);
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

</head>

<body>

<div class="main">
    <div class="container-fluid">

        <?php if (isset($message)) : ?>
            <div class="alert alert-danger">
                <strong>wrong！</strong><?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form class="form-horizontal"  enctype="multipart/form-data">


            <div class="form-group">
                <label class="col-sm-3 control-label">image</label>
                <div class="col-sm-6">
                    <label class="form-image">
                        <input id="avatar" type="file">
                        <img id="image" src="<?php echo $detail_dish[0]['photo']?>">
                        <input type="hidden" id="avater">
                        <i class="mask fa"></i>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">name</label>
                <div class="col-sm-6">
                    <input id="name" class="form-control" name="name" type="type" placeholder="name" value="<?php echo $detail_dish[0]['name']?>">
                </div>
            </div>

            <div class="form-group">
                <label for="slug" class="col-sm-3 control-label">price</label>
                <div class="col-sm-6">
                    <input id="price" class="form-control" name="price" type="type" placeholder="price" value="<?php echo $detail_dish[0]['price']?>">
                </div>
            </div>

            <div class="form-group">
                <label for="nickname" class="col-sm-3 control-label">category</label>
                <div class="col-sm-6">
                    <input id="category" class="form-control" name="category" type="type" placeholder="category" value="<?php echo $detail_dish[0]['category']?>">
                </div>
            </div>

            <div class="form-group">
                <label for="bio" class="col-sm-3 control-label">description</label>
                <div class="col-sm-6">
                    <textarea id="description" class="form-control" placeholder="description" cols="30" rows="6"><?php echo $detail_dish[0]['description']?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="bio" class="col-sm-3 control-label">calorie</label>
                <div class="col-sm-6">
                    <input id="calorie" class="form-control" name="calorie" type="type" placeholder="calorie" value="<?php echo $detail_dish[0]['calorie']?>">
                </div>
            </div>

            <div class="form-group">
                <label for="bio" class="col-sm-3 control-label">inventory</label>
                <div class="col-sm-6">
                    <input id="inventory" class="form-control" name="inventory" type="type" placeholder="inventory" value="<?php echo $detail_dish[0]['inventory']?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary" id="update">update</button>
                    <button type="button" class="btn btn-primary" id="return">return</button>
                </div>
            </div>
        </form>
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


    $('#update').on('click', function (e) {

        e.preventDefault();
        let name = $("#name").val();
        let price = $("#price").val();
        let inventory = $("#inventory").val();
        let category = $("#category").val();
        let description = $("#description").val();
        let calorie = $("#calorie").val();
        let image = $("#image").attr("src");
        let search = window.location.search.substr(9);
        console.log(search);
        console.log(price);
        console.log(inventory);
        console.log(description);
        console.log(calorie);
        console.log(image);
        console.log(name);



        $.ajax({
            url: 'dish_update.php',
            data: {
                name: name,
                price: price,
                inventory: inventory,
                category: category,
                description: description,
                image: image,
                calorie: calorie,
                search : search

            },
            method: 'POST',
            success: function (res) {
                console.log(res)
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

    $("#return").on('click', function () {
        location.href = "control.php"
    })


</script>
</html>
