<?php

session_start();

if(!isset($_SESSION['id']) || !isset($_POST['answer']) || empty($_POST['answer']))
{
	die('1You Scripted Kiddie ;');
}

$id=$_SESSION['id'];

require 'connectdatabase.php';

$query="SELECT `prevquesattempted` FROM `users` WHERE `id`=$id";
$results=mysqli_query($con, $query);

$row=mysqli_fetch_assoc($results);

$prevque=$row['prevquesattempted'];

if($prevque==0)
{
	$name=mysqli_real_escape_string($con, $_POST['answer']);
	$query="UPDATE `users` SET `name`='$name' , `prevquesattempted`=1 , `hintShown`=0 , `score`=200 WHERE `id`=$id";
	mysqli_query($con, $query);
	header('Location: questions.php?justanswered=1');
}
else
{
	die('2You Scripted Kiddie ;)');
}


?>