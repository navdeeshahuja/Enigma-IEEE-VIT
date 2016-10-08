<?php

if(!isset($_GET['email']))
{
	die();
}

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

require 'connectdatabase.php';

$email=mysqli_real_escape_string($con, $_GET['email']);

$pos=0;

for($i=0 ; $i<strlen($email) ; $i++)
{
	if($email[$i]=='@')
	{
		$pos=$i;
	}
}

$last=substr($email, $pos, strlen($email));

if($last=='@vit.ac.in' || $last=='@vitstudent.ac.in')
{
	$query="SELECT `password` FROM `users` WHERE `email`='$email'";
	$results=mysqli_query($con, $query);
	if($row=mysqli_fetch_assoc($results))
	{
		$pass=$row['password'];
		mail($email, 'IEEE-VIT Enigma', "Your password is $pass");
		echo 'yes';
	}
	else
	{
		$date=date('Y-m-d');
		$pass=generateRandomString();
		$time=date("H:i:s", time()); 
		$query="INSERT INTO `users` VALUES('', '$email', '$pass', 0, '$date', '$time', 'unknown', 0, 0)";
		mysqli_query($con, $query);
		mail($email, 'IEEE-VIT Enigma', "Your password is $pass");
		echo 'yes';
	}
}
else
{
	echo 'false';
}


?>