<?php


require 'static/common.php';
require 'static/user.php';


session_start();

$current_user = user();
//if ($current_user=0){
//    $user_id=0;
//}
$user_id = $current_user['user_id'];



if (isset($_GET['dish_id'])){
    $id = $_GET['dish_id'];

    $detail_dish = getDishByID($id);

    $inv = $detail_dish[0]['inventory'];

    addWishList($id, $user_id);


    if($inv == 0){
        echo '<script language="JavaScript">;alert("this product no longer available and has been added to wishlist");location.href="index.php";</script>;';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Keywords" content="Personal UTD">
    <meta name="description" content="Personal page">
    <title>Personal page</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/admin.css">
    <style>
        form{
            margin-left: 300px;
        }
        .like{ font-size:40px;  color:#ccc; cursor:pointer;}
        .cs{color:#f00;}
        #like{
            position: fixed;
            top: 210px;
            left: 410px;
        }
        .like_text{
            padding-left: 12px;
            margin-top: -7px;
        }
    </style>
</head>

<body>

<div class="main">
    <form class="login-wrap"  action="./add_cart.php?dish_id=<?php echo $id?>" method="post">
        <div class="row">
            <div class="col-4" id="name"><?php echo $detail_dish[0]['name']?></div>
        </div>
        <div class="row">
            <img src= "<?php echo $detail_dish[0]['photo']; ?>" width="460" height="345">
        </div>
        <div class="row">
            <div class="col-8">description</div>
            <p><?php echo $detail_dish[0]['description']; ?></p >
        </div>
        <div class="row">
            <div class="col-8">calorie</div>
            <p><?php echo $detail_dish[0]['calorie'];  ?></p >
        </div>
        <div>
            <label for="qty">quantity</label>
            <select name="qty" id="qty">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div>
            <label for="qty">flavor</label>
            <select name="fla" id="fla">
                <option value="Garlic">Garlic</option>
                <option value="BBQ">BBQ</option>
                <option value="spicy">spicy</option>
                <option value="buffalo">buffalo</option>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" id="cancel">cancel</button>
            <button class="btn btn-primary" type="submit" >add</button>
        </div>

    </form>

    <div id="like">
        <p class="like">&#10084;</p>
        <p class="like_text"><?php
            $num = $detail_dish[0]['dish_like'];
            if ( ! isset($num) )
                echo 0;
            else
                echo $detail_dish[0]['dish_like']?></p>
    </div>

</div>
</body>
<script src="assets/jquery.js"></script>
<script>
    $(function () {
        $("#cancel").on('click', function () {
           window.close();
        });

        $(".like").click(function () {
            $(this).toggleClass('cs');
            let $att = $(this).attr("class").split(" ");
            let url = location.search.substring(1).split("=")[1];
            let num = $(".like_text").text();
            console.log(url);
            if($att.length === 2){
                console.log("add");
                $.ajax({
                    url: "static/dish_like.php",
                    data : {
                        type : "add",
                        num: num,
                        id: url
                    },
                    method : 'post',
                    success: function (res) {
                        let nnum = parseInt(num) + 1;
                        $(".like_text").text(nnum);
                    }
                });
            }
            else{
                console.log("minus");
                $.ajax({
                    url: "static/dish_like.php",
                    data : {
                        type : "minus",
                        num: num,
                        id: url
                    },
                    method : 'post',
                    success: function (res) {
                        let nnum = parseInt(num) - 1;
                        $(".like_text").text(nnum);
                    }
                });
            }
        })
    })
</script>
</html>


