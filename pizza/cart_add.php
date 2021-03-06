<?php


require 'static/common.php';
session_start();


if (isset($_GET['dish_id'])){
    $id = $_GET['dish_id'];

    $detail_dish = getDishByID($id);
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
            <button class="btn btn-primary" >cancel</button>
            <button class="btn btn-primary" type="submit">add</button>
        </div>
    </form>

</div>
</body>
<script src="assets/jquery.js"></script>
<script>
    // $(function () {
    //
    //     $('#submit').on('click',function () {
    //         $("#submit").on('click', function () {
    //             let dish_id = window.location.search;
    //             alert(dish_id);
    //             // let qty=$("#qty option:selected");
    //             // alert(qty);
    //         })
    //
    //     });
    //
    // })

</script>
</html>



