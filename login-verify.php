<?php



if(!isset($_GET['email']) || !isset($_GET['pass']) || empty($_GET['email']) || empty($_GET['pass']))
{
	die('You Scripted Kidddie ;)');
}

require 'connectdatabase.php';

$email=mysqli_real_escape_string($con, $_GET['email']);
$pass=mysqli_real_escape_string($con, $_GET['pass']);

$query="SELECT `id` FROM `users` WHERE `email`='$email' AND `password`='$pass'";
$results=mysqli_query($con, $query);

if( mysqli_num_rows($results)==1 )
{
	$row=mysqli_fetch_assoc($results);
	$id=$row['id'];
	session_start();
	$_SESSION['id']=$id;
	$_SESSION['email']=$email;

	echo 'done';
}
else
{
	echo 'false';
}



?>