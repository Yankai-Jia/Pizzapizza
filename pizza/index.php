<?php
/**
 * Created by PhpStorm.
 * User: achen
 * Date: 11/24/2018
 * Time: 1:32 PM
 */

require 'static/common.php';
require 'static/user.php';


session_start();
$current_user = user();

$where = '1 = 1';
$search='';


$size=9;

$page=isset($_GET['page'])? (int)$_GET['page']: 1;


if ($page<1){
    header('Location: index.php?page=1'. $search);
}


//max page
$total_count=(int)xiu_fetch_one(sprintf('select count(1) as num from dish WHERE %s', $where))['num'];
$max_page=(int)ceil($total_count/$size);


//if page bigger than max_page
if ($page>$max_page){
    header('Location: index.php?page='.$max_page. $search);
}


$list_all_dish=xiu_query(sprintf('SELECT *
                                         FROM dish
                                          WHERE %s and type = 0
                                          LIMIT %d,%d', $where,($page-1)*$size, $size));
//echo 'SELECT *
//                                         FROM dish
//                                          WHERE %s and type = 0
//                                          LIMIT %d,%d', $where,($page-1)*$size, $size;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Keywords" content="Personal UTD">
    <meta name="description" content="Pizza">

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link id="page_favicon" href="data:image/x-icon;base64,R0lGODlhEAAQAPIAAAAAAL3Cx/zM/////wAAAAAAAAAAAAAAACH5BAlkAAQAIf8LTkVUU0NBUEUyLjADAQAAACwAAAAAEAAQAAAD6khERESEEEIIIYQQQgAgBEEAAEEQBEEQQDAABAEEA0AQBEEQQDAABAIgMAAQCAQCgQAIDAYAwGAwABAIBAKBAAgMBoPBYDAAEAgEAgEwGAwGg8FgMBgACAQCATAADAYDAwMDAAMABAQEAAMCAgMAAwMAAwICAwAEBAADAwMDAwAAAwMDAwMABAQAAQMDAwMDAwMDAwMDAAQEAAEDAwMDAwMDAwMDAwAEBAABAQMDAwMDAwMDAwMABAQEAAEBAQEDAwMDAwMABAQEBAQAAAAAAAAAAAAABAQEBAQEBAQEBAQIECBAgAABAgQSAAAh+QQJZAADACwAAAAAEAAQAIEAAAD8zP////8AAAAC59w2MzMzM8YYY4wxABhjDAAMwzAMwwAIAjAMgCAAwzAMwwAIAjAMgCAADAaDwWAAEAgEAIBAIAAMBoPBYAAQCAQCgUAgAAwGg8EAIBAIBAKBQCAQAAaDwQAgAAgEAoFAACAAMDAwACAQECAAAAAAIBAQIAAwMAAgICAgIAAAICAgICAAMDAAICAgICAgICAgICAgADAwACAgICAgICAgICAgIAAwMAAgICAgICAgICAgICAAMDAwACAgICAgICAgICAAMDAwMDAAAAAAAAAAAAAAMDAwMDAwMDAwMDAwMDAwYMCAAQMKAAAh+QQJZAADACwAAAAAEAAQAIEAAAD8zP////8AAAAC59w2MzMzM8YYY4wxABhjDAAMwzAMwwAIAjAMgCAAwzAMwwAIAjAMgCAADAaDwWAAEAgEAIBAIAAMBoPBYAAQCAQCgUAgAAwGg8EAIBAIBAKBQCAQAAaDwQAgAAgEAoFAACAAMDAwACAQECAAAAAAIBAQIAAwMAAgICAgIAAAICAgICAAMDAAICAgACAAACAAICAgADAwACAgICAAICAAICAgIAAwMAAgICAgICAgICAgICAAMDAwACAgICAgICAgICAAMDAwMDAAAAAAAAAAAAAAMDAwMDAwMDAwMDAwMDAwYMCAAQMKAAAh+QQJCgADACwAAAAAEAAQAIEAAAD8zP////8AAAAC59w2MzMzM8YYY4wxABhjDAAMwzAMwwAIAjAMgCAAwzAMwwAIAjAMgCAADAaDwWAAEAgEAIBAIAAMBoPBYAAQCAQCgUAgAAwGg8EAIBAIBAKBQCAQAAaDwQAgAAgEAoFAACAAMDAwACAQECAAAAAAIBAQIAAwMAAgICAgIAAAICAgICAAMDAAICAgACAAACAAICAgADAwACAgICAAICAAICAgIAAwMAAgICAgICAgICAgICAAMDAwACAgICAgICAgICAAMDAwMDAAAAAAAAAAAAAAMDAwMDAwMDAwMDAwMDAwYMCAAQMKAAAh+QQJCgADACwAAAAAEAAQAIEAAAD8zP////8AAAAC59w2MzMzM8YYY4wxxhhjjDEMwzAMwzAAwDAMAwAMwzAMwwAIAjAMgCAADAaDwWAAEAgAgwFAIAAMBoPBYAAQCAQAgEAgAAwGg8FgABAIBAKBQCAADAaDwQAgEAgEAoFAICAAMDAwMAAgACAgICAgIAAgADAwMAAgEBAgAAAAACAQECAAMDAAICAgICAAACAgICAgADAwACAgIAAgAAAgACAgIAAwMAAgICAgACAgACAgICAAMDAAICAgICAgICAgICAgADAwMAAgICAgICAgICAgADAwMDAwAAAAAAAAAAAAAMCAAQMKAAAh+QQJCgADACwAAAAAEAAQAIEAAAD8zP////8AAAAC59w2MzMzM8YYY4wxABhjDAAMwzAMwwAIAjAMgCAAwzAMwwAIAjAMgCAADAaDwWAAEAgEAIBAIAAMBoPBYAAQCAQCgUAgAAwGg8EAIBAIBAKBQCAQAAaDwQAgAAgEAoFAACAAMDAwACAQECAAAAAAIBAQIAAwMAAgICAgIAAAICAgICAAMDAAICAgACAAACAAICAgADAwACAgICAAICAAICAgIAAwMAAgICAgICAgICAgICAAMDAwACAgICAgICAgICAAMDAwMDAAAAAAAAAAAAAAMDAwMDAwMDAwMDAwMDAwYMCAAQMKAAAh+QQJCgADACwAAAAAEAAQAIEAAAD8zP////8AAAAC59w2ADMzAMYYY4wBhABjACEAwzAMwwAIAjAMgCAAwzAMwwAIggAAgiAADAaDwWAAEAgEAoFAIAAMBoPBACAQCAQCgUAgEAAGg8EAIAAIBAKBQAAQAAaDAUAQCAgAAABAEBAgADAwACAgICAgAAAgICAgIAAwMAAgICAAIAAAIAAgICAAMDAAICAgIAAgIAAgICAgADAwACAgICAgICAgICAgIAAwMDAAICAgICAgICAgIAAwMDAwMAAAAAAAAAAAAAAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwYMCAAQMKAAAh+QQJCgADACwAAAAAEAAQAIEAAAD8zP////8AAAAC59w2MzMzM8YYY4wxABhjDAAMwzAMwwAIAjAMgCAAwzAMwwAIAjAMgCAADAaDwWAAEAgEAIBAIAAMBoPBYAAQCAQCgUAgAAwGg8EAIBAIBAKBQCAQAAaDwQAgAAgEAoFAACAAMDAwACAQECAAAAAAIBAQIAAwMAAgICAgIAAAICAgICAAMDAAICAgACAAACAAICAgADAwACAgICAAICAAICAgIAAwMAAgICAgICAgICAgICAAMDAwACAgICAgICAgICAAMDAwMDAAAAAAAAAAAAAAMDAwMDAwMDAwMDAwMDAwYMCAAQMKAAAh+QQJCgADACwAAAAAEAAQAIEAAAD8zP////8AAAAC59w2MzMzM8YYY4wBwBhjADAMwzAMAyAIwDAAggAMwzAMAyAIwDAAggAYDAaDwQAgEAgAAIFAABgMBoPBACAQCAQCgUAAGAwGgwFAIBAIBAKBQCAADAaDAUAAEAgEAoEAIAAwMDAAIBAQIAAAAAAgEBAgADAwACAgICAgAAAgICAgIAAwMAAgICAAIAAAIAAgICAAMDAAICAgIAAgIAAgICAgADAwACAgICAgICAgICAgIAAwMDAAICAgICAgICAgIAAwMDAwMAAAAAAAAAAAAAAwMDAwMDAwMDAwMDAwMDAwYMCAAQMKAAAh+QQJCgADACwAAAAAEAAQAIEAAAD8zP////8AAAAC59w2MzMzM8YYY4wxABhjDAAMwzAMwwAIAjAMgCAAwzAMwwAIAjAMgCAADAaDwWAAEAgEAIBAIAAMBoPBYAAQCAQCgUAgAAwGg8EAIBAIBAKBQCAQAAaDwQAgAAgEAoFAACAAMDAwACAQECAAAAAAIBAQIAAwMAAgICAgIAAAICAgICAAMDAAICAgACAAACAAICAgADAwACAgICAAICAAICAgIAAwMAAgICAgICAgICAgICAAMDAwACAgICAgICAgICAAMDAwMDAAAAAAAAAAAAAAMDAwMDAwMDAwMDAwMDAwYMCAAQMKAAAh+QQJCgADACwAAAAAEAAQAIEAAAD8zP////8AAAAC59w2MzMzM8YYY4wxBgBjjAEAwzAMwzAAggAMAyAIwDAMwzAAggAMAyAQAAaDwWAwAAgEAgBAIBAABoPBYDAACAQCgUAgEAAGg8FgABAIBAKBQCAQCACDwWAAEAAEAoFAIAAgADAwMAAgEBAgAAAAACAQECAAMDAAICAgICAAACAgICAgADAwACAgIAAgAAAgACAgIAAwMAAgICAgACAgACAgICAAMDAAICAgICAgICAgICAgADAwMAAgICAgICAgICAgADAwMDAwAAAAAAAAAAAAADAwMDAwMDAwMDAwMDAwYMCAAQMKAAAh+QQJCgADACwAAAAAEAAQAIEAAAD8zP////8AAAAC59w2MzMzM8YYY4wxABhjDAAMwzAMwwAIAjAMgCAAwzAMwwAIAjAMgCAADAaDwWAAEAgEAIBAIAAMBoPBYAAQCAQCgUAgAAwGg8EAIBAIBAKBQCAQAAaDwQAgAAgEAoFAACAAMDAwACAQECAAAAAAIBAQIAAwMAAgICAgIAAAICAgICAAMDAAICAgACAAACAAICAgADAwACAgICAAICAAICAgIAAwMAAgICAgICAgICAgICAAMDAwACAgICAgICAgICAAMDAwMDAAAAAAAAAAAAAAMDAwMDAwMDAwMDAwMDAwYMCAAQMKAAAh+QQJCgAEACwAAAAAEAAQAIIAAAAA//v8zP////8AAAAAAAAAAAAAAAAD6khERESEEEIIIYQQQgAgBEEAAEEQBEEQwDAABAEMA0AQBEEQwDAABAJgMAAQCAQCgQAYDAYAwGAwABAIBAKBABgMBoPBYDAAEAgEAgEwGAwGg8FgMBgACAQCATAADAYDAwMDAAMABAQEAAMCAgMAAAAAAQEBAwAEBAADAwMDAwAAAwEBAQMABAQAAwMDAAMAAAEAAwMDAAQEAAMDAwMAAwMAAwMDAwAEBAADAwMDAwMDAwMDAwMABAQEAAMDAwMDAwMDAwMABAQEBAQAAAAAAAAAAAAABAQEBAQEBAQEBAQIECBAgAABAgQSAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCgUAAAAAAAgAAABAAAACAQCAQAAQCgQAgEBAQABAQEBAAEBAQEAAQEBAQABAQEBAAAAAAEAAAAAAQAAAAABAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCgQAAAAAEAAAAIAAAAACBQCAACAQCAUAgEBAAEBAQEAAQEBAQABAQEBAAEBAQEAAAAAAQAAAAABAAAAAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAQAAAAgAAABAAAAAAAKBQAAQCAQCgEAgEAAQEBAQABAQEBAAEBAQEAAQEBAQAAAAABAAAAAAEAAAAAAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAQAAEAAAAIAAAAAABAKBACAQCAQAgUAgABAQEBAAEBAQEAAQEBAQABAQEBAQAAAAEAAAAAAQAAAAABAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAQAgAAAAAAEAAAAIBAIBQCAQCAACgUAAEBAQEBAQEBAQABAQEBAAEBAQEBAQAAAQAAAAABAAAAAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAUAAAAAAAgAAABAIBAKBQCAQAAQCgQAgEBAQEBAQEBAAEBAQEAAQEBAQEBAQABAAAAAAEAAAAAAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCgQAAAAAEAAAAIBAIBAKBQCAACAQCAUAgEBAQEBAQEAAQEBAQABAQEBAQEBAQEAAAAAAQAAAAABAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAQAAAAgAAABAIBAIBAKBQAAQCAQCgEAgEBAQEBAQABAQEBAAEBAQEBAQEBAQAAAAABAAAAAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAQAAEAAAAIBAIBAIBAKBACAQCAQAgUAgEBAQEBAAEBAQEAAQEBAQEBAQEBAQAAAAEAAAAAAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAQAgAAAAAIFAIBAIBAIBQCAQCAACgUAgEBAQEBAQEBAQABAQEBAQEBAQEBAQAAAQAAAAABAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAUAAAAAAAoFAIBAIBAKBQCAQAAQCgUAgEBAQEBAQEBAAEBAQEBAQEBAQEBAQABAAAAAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCgQAAAAAEAoFAIBAIBAKBQCAACAQCgUAgEBAQEBAQEAAQEBAQEBAQEBAQEBAQEAAAAAAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAQAAAAgEAoFAIBAIBAKBQAAQCAQCgUAgEBAQEBAQABAQEBAQEBAQEBAQEBAQAAAAABAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAQAAEAgEAoFAIBAIBAKBACAQCAQCgUAgEBAQEBAAEBAQEBAQEBAQEBAQEBAQAAAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAQAgEAgEAoFAIBAIBAIBQCAQCAQCgUAgEBAQEBAQEBAQEBAQEBAQEBAQEBAQAAAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCAUAgEAgEAoFAIBAIBAKBQCAQCAQCgUAgEBAQEBAQEBAQEBAQEBAQEBAQEBAQABAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCgUAgEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAA7" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/dish.css">
    <title>Personal page</title>
    <style>
        /*.slides{*/
            /*height: 830px;*/
            /*width: 100%;*/
            /*background-color: chartreuse;*/
            /*margin: 0 auto;*/
        /*}*/

    </style>
</head>

<body style="background-color: #f7e1b5">
<!--<div class="show">-->


    <?php include 'header.php'; ?>

    <!--container-->
    <div class="slides">


    </div>
    <div class="container">

            <div class="row">
                <div class="row">
                    <div class="col-2">

<!--                        <div id="searchForm">-->
<!---->
<!--                                <input id="searchInput" class="form-control" type="search" placeholder="Search..." aria-label="Search">-->
<!---->
<!--                        </div>-->
                        <div class="md-form mt-0">
                            <input id="searchInput" class="form-control" type="text" placeholder="Search" aria-label="Search">
                        </div>
                        <br>
                        <ul class="list-group " id="sides">
                            <li class="list-group-item ">meat</li>
                            <li class="list-group-item">chicken</li>
                            <li class="list-group-item">veggie</li>
                            <li class="list-group-item">sides</li>
                            <li class="list-group-item">pasta</li>
                            <li class="list-group-item">desserts</li>
                            <li class="list-group-item">drinks</li>
                        </ul>
                        <br>
                        <button class="btn btn-secondary btn-sm" id ="filter">filter</button>
                        <button class="btn btn-secondary btn-sm" id ="clear">clear</button>
                    </div>


                    <div class="col-10">
                        <br>
                        <br>


                        <div class="j02 main clearfix" id="show">

                        <?php foreach ($list_all_dish as $dish) { ?>
                            <div class="product">
                                <a href="t.php?dish_id=<?php echo $dish['id']; ?>" target="_blank" class="iwrap">
                                    <img src="<?php echo $dish['photo']; ?>">
                                    <p class="f16 line1"><?php echo $dish['name']; ?></p>
                                    <dl class="line3">
                                        <dd class="c2 red"><h4><?php echo $dish['price']; ?></h4></dd>
                                        <dd class="c2 red"><small id="num"><?php echo $dish['inventory']; ?></small><small>left</small></dd>
                                        <dd class="c3 f16">add to cart</dd>
                                    </dl>
                                </a>
                            </div>
                        <?php } ?>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <?php pagination($page, $max_page, '?page=%d' . $search); ?>
                                </ul>
                            </nav>

                        </div>
                        
                    </div>
                </div>
            </div>

    </div>




<div class="toggle">
        <p>
            <a class="btn btn-primary" data-toggle="collapse" href="#qaframe" role="button" aria-expanded="false" aria-controls="collapseExample">
                have question ?
            </a>
        </p>

    <div class="collapse" id="qaframe">
        <div class="card card-body" id="qaplace">

        </div>
        <div>
            <input type="text" placeholder="ask here" id="qatext">
            <button class="btn btn-secondary btn-sm" id="send"> send</button>
        </div>
    </div>
</div>



<!--footer-->
<div>
    <div class="footer">
        <p> Pizzapizza by Ying Zhou, Yankai Jia, Yisu Tian</p>

    </div>
</div>
<script src="assets/jquery.js"></script>
<script src="getTime.js"></script>
<script>

    $(function () {
        // li function
        $("li").on('click', function () {
            $(this).addClass("active");
            $(this).siblings().removeClass("active");

        });


        $("#clear").on('click', function () {
            $("li").removeClass("active");
            $("#searchInput").val('');


            let $category = $(".active").text();
            console.log($category);
            let $search = $("#searchInput").val();
            console.log($search);
            $.ajax({
                url: 'user_select.php',
                data : {data: $search,
                    category: $category,
                    type: 'name'},
                method : 'get',
                // dataType: "json",

                success : function (res) {
                    console.log(res);
                    let json  = $.parseJSON(res);
                    let json_data = json.data;

                    if(json_data==null){
                        $("#show").empty();
                        $("#show").append("<div class='cart-item'>An item unavailable anymore</div>");
                    }
                    else {
                        $("#show").empty();
                        $.each(json_data, function (index, data) {
                            // console.log(data['id']);
                            // console.log(data['name']);
                            $("#show").append(
                                "<div class='product'>" +
                                "   <a href='t.php?dish_id="+data['id']+"' target='_blank' class='iwrap'>" +
                                "        <img src="+data['photo']+">" +
                                "<p class='f16 line1'>"+data['name']+"</p>"+
                                "<dl class='line3'>"+
                                "<dd class='c2 red'><span class='rmb'>"+data['price']+"</span></dd>"+
                                "<dd class='c2 red'><small id='num'>"+data['inventory']+"</small><small>left</small></dd>"+
                                "<dd class='c3 f16'>add to cart</dd>"+
                                "</dl>"+
                                "</a>"+
                                "</div>"
                            );

                        })
                    }

                }
            });


        });


        // filter function
        $("#filter").on('click', function () {
            let $category = $(".active").text();
            console.log($category);
            let $search = $("#searchInput").val();
            console.log($search);
            $.ajax({
                url: 'user_select.php',
                data : {data: $search,
                        category: $category,
                        type: 'name'},
                method : 'get',
                // dataType: "json",

                success : function (res) {
                    console.log(res);
                   let json  = $.parseJSON(res);
                    let json_data = json.data;

                    if(json_data==null){
                        $("#show").empty();
                        $("#show").append("<div class='cart-item'>An item unavailable anymore</div>");
                    }
                    else {
                        $("#show").empty();
                        $.each(json_data, function (index, data) {
                            // console.log(data['id']);
                            // console.log(data['name']);
                            $("#show").append(
                                "<div class='product'>" +
                                "   <a href='t.php?dish_id="+data['id']+"' target='_blank' class='iwrap'>" +
                                "        <img src="+data['photo']+">" +
                                    "<p class='f16 line1'>"+data['name']+"</p>"+
                                    "<dl class='line3'>"+
                                    "<dd class='c2 red'><span class='rmb'>"+data['price']+"</span></dd>"+
                                    "<dd class='c2 red'><small id='num'>"+data['inventory']+"</small><small>left</small></dd>"+

                            "<dd class='c3 f16'>add to cart</dd>"+
                                    "</dl>"+
                                    "</a>"+
                               "</div>"
                            );

                        })
                    }

                }
            });
        });

        $("#send").on('click', function () {
            let txt = $("#qatext").val();
            let date = '';
            $("#qatext").val('');
            if (txt != ''){
                date = getTime();
            }

            $("#qaplace").append("<small>"+ date+"</small>" +"<p>"+ txt+"</p>");
            $("#qaplace")[0].scrollTop = $("#qaplace")[0].scrollHeight;

            if (txt != ''){
                $.ajax({
                    url : 'http://127.0.0.1:5000/question?callback='+txt,
                    dataType: 'json',
                    type : 'GET',
                    success: function (res) {
                        console.log(res.data);
                        txt = '';
                        date = getTime();
                        $("#qaplace").append("<small>"+ date+"</small>" +"<p>"+ res.data+"</p>");
                    }
                });
            }




            // http://127.0.0.1:5000/ingredent

        })

    })

</script>

</body>

</html>
