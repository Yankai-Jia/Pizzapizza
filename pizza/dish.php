<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 11/24/2018
 * Time: 1:32 PM
 */

require 'static/common.php';

$where = '1 = 1';
$search='';

//if (isset($_GET['category']) && $_GET['category']!='all'){
//    $where .= sprintf(" and posts.category_id = %d", $_GET['category']);
//    $search .= ' & category='. $_GET['category'] ;
//}



$size=6;

$page=isset($_GET['page'])? (int)$_GET['page']: 1;


if ($page<1){
    header('Location: dish.php?page=1'. $search);
}


//计算最大页码
$total_count=(int)xiu_fetch_one(sprintf('select count(1) as num from dish WHERE %s', $where))['num'];
$max_page=(int)ceil($total_count/$size);

//if page bigger than max_page
if ($page>$max_page){
    header('Location: dish.php?page='.$max_page. $search);
}


$list_all_dish=xiu_query(sprintf('SELECT *
                                         FROM dish
                                          WHERE %s AND type = 0
                                          LIMIT %d,%d', $where,($page-1)*$size, $size));


?>


<!DOCTYPE html>
<html>
<head>
    <title>Dish</title>
    <meta charset="utf-8">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="css/dish.css">
</head>

<body>
<div class="j02 main clearfix">

    <?php foreach ($list_all_dish as $dish) { ?>
        <div class="product">
            <a href="t.php?dish_id=<?php echo $dish['id']; ?>" target="_blank" class="iwrap">
                <img src="<?php echo $dish['photo']; ?>">
                <?php echo $dish['photo']; ?>
                <p class="f16 line1"><?php echo $dish['name']; ?></p>
                <dl class="line3">
                    <dd class="c2 red"><?php echo $dish['price']; ?></dd>
                    <dd class="c2 red"><span class="rmb"><?php echo $dish['price']; ?></span></dd>
                    <dd class="c3 f16">add to cart</dd>
                </dl>
            </a>
        </div>
    <?php } ?>

</div>
</body>
</html>