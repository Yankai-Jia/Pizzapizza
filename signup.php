<?php

//Start session
session_start();

//require_once 'config.php';

$username=$firstname=$lastname=$mobile=$email=$psw=$pswrepeat="";   
$db = 'pizzapizza';        ##########################################
$host = 'localhost';
$port = 3306;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username=test_input($_POST["username"]);
    $firstname=test_input($_POST["firstname"]);
    $lastname=test_input($_POST["lastname"]);
    $mobile=test_input($_POST["mobile"]);
    $email=test_input($_POST["email"]);
	$psw=test_input($_POST["psw"]);
	$pswrepeat=test_input($_POST["pswrepeat"]);


	if (empty($username) ||empty($firstname) ||empty($lastname) ||empty($mobile) || empty($email)|| empty($psw)|| empty($pswrepeat)) {

        $message = 'Please refill form';
echo "<script type='text/javascript'>alert('$message');</script>"; #############################################
header("location: signup.html");
			exit();
	}elseif(strlen($mobile)!=10){

        $message = 'Please refill form';
echo "<script type='text/javascript'>alert('$message');</script>";
header("location: signup.html");
			exit();
	}elseif(!preg_match("/[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]{3}$/", $email) ){

        $message = 'Please enter a valid email address';
echo "<script type='text/javascript'>alert('$message');</script>";
header("location: signup.html");
			exit();
	}elseif($psw!=$pswrepeat){

        $message = 'Password does not match. Please enter again';
echo "<script type='text/javascript'>alert('$message');</script>";
header("location: signup.html");
			exit();
	}elseif(strlen($psw)<=5 || !preg_match("/.*[a-z].*$/", $psw) || !preg_match("/.*[A-Z].*$/", $psw) || !preg_match("/.*[0-9].*$/", $psw)){

        $message = 'Your password must be a minimum of 5 characters, and only include numbers and letters.';
echo "<script type='text/javascript'>alert('$message');</script>";
header("location: signup.html");
			exit();
	}else{


		$connection = mysqli_connect($host, 'root','root',$db,$port ); #############################################

        if (!$connection) {

        die('<h1>Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error() . '</h1>');
    }

		$result = mysqli_query($connection, sprintf("select * from user where email = '%u' or name = '%s'", $email,$name));
    
        if($result->num_rows != 0){		//old user
	        $message = 'This count is existed. Please login';
	        echo "<script type='text/javascript'>alert('$message');</script>";
	        header("location: signup.html");
			exit();
		}else{
			
			$query = "INSERT INTO user (username, pwd, mobile, email, status,role, first_name, last_name) VALUES ('$username', '$psw', '$mobile',$email,1,1,'$firstname',$lastname')";

            if ($conn->query($query) === TRUE) {
            echo "New book added to cart successfully";
           }    

           header("location: index.php");
           exit();
		}
	}

}






?>