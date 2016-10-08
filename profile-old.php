<?php

session_start();

if(!isset($_SESSION['id']) || !isset($_SESSION['email']))
{
	die('You Scripted Kiddie ;)');
}

$email=$_SESSION['email'];
$id=$_SESSION['id'];

require 'connectdatabase.php';

$query="SELECT `prevquesattempted` FROM `users` WHERE `id`=$id";
$results=mysqli_query($con, $query);
$row=mysqli_fetch_assoc($results);
$num=$row['prevquesattempted'];




?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<a href="logout.php">Logout</a>

</body>
</html>