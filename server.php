<?php
session_start();
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "form";
$errors= array();

$conn = mysqli_connect($servername,$username,$password,$dbname);
if($conn)
{
	if(isset($_POST['register']))
	{
		$un = $_POST['username'];
		$email = $_POST['email'];
		$pass1 = $_POST['password_1'];
		$pass2 = $_POST['password_2'];

		if(empty($un))
		{
			array_push($errors, "username is required");
		}
		if(empty($email))
		{
			array_push($errors, "email is required");
		}
		if(empty($pass1))
		{
			array_push($errors, "password is required");
		}
		if($pass1 != $pass2)
		{
			array_push($errors, "the two passwords do not match");
		}

		if(count($errors)==0){
			$query = "INSERT INTO user(username,email,password) VALUES('$un','$email','$pass1')";
			$data = mysqli_query($conn, $query);
			$_SESSION['username'] = $un;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');

		}

	}
	
	// log user in from login page
	if(isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(empty($username))
		{
			array_push($errors, "username is required");
		}
		if(empty($password))
		{
			array_push($errors, "password is required");
		}
		if(count($errors) == 0)
		{
			$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result) == 1)
			{
				//log user in
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}
			else{
				array_push($errors, "wrong username/password combination");
				
			}
		}

	}
	//logout
	if(isset($_GET['logout']))
	{
		session_destroy();
		unset($_SESSION['username']);
		header('location: login.php');
	}
	
}
else
{
	die("conntion failed because". mysqli_connect_error());
}


?>
