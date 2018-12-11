<?php
/**
 * Created by PhpStorm.
 * User: newworld
 * Date: 11/28/2018
 * Time: 14:42 PM
 */

//Start session
session_start();

require_once 'config.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username=$_POST["username"];
    $email=$_POST["email"];
	$psw = md5($_POST["password"]);
	$image = "assets/img/avatar.jpg";
	$firstname=$_POST['firstname'];
	$lastname = $_POST["lastname"];
	$mobile = $_POST["mobile"];
	$signup_time = date("Y-m-d H:i:s");

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (!$connection) {

        die('<h1>Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error() . '</h1>');
    }

    $result = mysqli_query($connection, sprintf("select * from user where email = '%s' or username = '%s'", $email,$username));

    if($result->num_rows != 0){		//old user
        $message = 'This account is existed. Please login';

    }else{
//        echo "aaa";

        $query = "INSERT INTO user (username, pwd, sign_up_timestamp, mobile, email, status,role, first_name, last_name, img) 
  VALUES ('$username', '$psw', '$signup_time', $mobile, '$email', 1, 0, '$firstname', '$lastname', '$image')";

        echo $query;

        if (mysqli_query($connection, $query)) {
            echo "New user added to cart successfully";

            session_start();
            $result = mysqli_query($connection, sprintf("select * from user where email = '%s' limit 1", $email));
            $user = mysqli_fetch_assoc($result);
            $_SESSION['is_logged_in'] = true;
            $_SESSION['current_login_user'] = $user;

            header("location: index.php");
        }
        else{
            echo "fail to sign up";
        }
    }

    mysqli_close($connection);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up Form</title>
    <meta name="author" content="Yankai">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="signup_check.js" type="text/javascript"></script>

</head>
<body>
<div class="container">
    <div class="head">
        <h2>Sign Up</h2>
        <p>Please fill in this form to create an account!</p>
        <p id="error"></p>
        <hr align="left" width="48%">
    </div>
    <form class=SignUp action="signup.php" method="post">
        <div class="form-row col-sm-6">
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" name='firstname' id="firstname" placeholder="First Name">
                <p></p>
            </div>

            <div class="form-group col-sm-6">
                <input type="text" class="form-control" name='lastname' id="lastname" placeholder="Last Name">
                <p></p>
            </div>
        </div>

        <div class="form-group col-sm-6" >
            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            <p></p>
        </div>

        <div class="form-group col-sm-6" >
            <input type="email" class="form-control" name='email' id="email" placeholder="Email">
            <p></p>
            <?php if (isset($message)) echo '<p class="alert alert-danger">'. $message .'</p>'?>
        </div>

        <div class="form-group col-sm-6" >
            <input type="mobile" class="form-control" name='mobile' id="mobile" placeholder="Phone">
            <p></p>
        </div>

        <div class="form-group col-sm-6">
            <input type="password" class="form-control" name='password' id="password" placeholder="Password">
            <p></p>
        </div>

        <div class="form-group col-sm-6">
            <input type="password" class="form-control" name='ConfirmPassword' id="ConfirmPassword" placeholder="Confirm Password">
            <p></p>
        </div>

        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>

</div>
</body>
</html>

