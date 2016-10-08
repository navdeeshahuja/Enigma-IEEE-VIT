<?php

session_start();

if(!isset($_SESSION['id']) || !isset($_POST['answer']))
{
	die('1You Scripted Kiddie ;');
}

$id=$_SESSION['id'];

require 'connectdatabase.php';

$query="SELECT `answer`, `pool` FROM `users`, `questions` WHERE `questions`.`id`=`users`.`prevquesattempted`+1 AND `users`.`id`=$id AND `users`.`prevquesattempted`>0";
$results=mysqli_query($con, $query);

if(mysqli_num_rows($results)==0)
{
	die('2You Scripted Kiddie ;');
}

$row=mysqli_fetch_assoc($results);
$answer=$row['answer'];
$pool=$row['pool'];
$pool=explode(',', $pool);


if($answer==strtolower(mysqli_real_escape_string($con, $_POST['answer'])))
{
	$date=date('Y-m-d');
	$time=date("H:i:s", time());

	$query="SELECT `prevquesattempted` FROM `users` WHERE `id`=$id";
	$results=mysqli_query($con, $query);
	$ques=mysqli_fetch_assoc($results)['prevquesattempted'];
	$query="SELECT `id` FROM `users` WHERE `prevquesattempted`>$ques";
	$results=mysqli_query($con, $query);
	if(mysqli_num_rows($results)==0)
	{
		$query="UPDATE `users` SET `prevquesattempted`=`prevquesattempted`+1 , `hintShown`=0 , `lastmodified`='$date' , `time`='$time' , `score`=`score`+110 WHERE `id`=$id";
	}
	else
	{
		$query="UPDATE `users` SET `prevquesattempted`=`prevquesattempted`+1 , `hintShown`=0 , `lastmodified`='$date' , `time`='$time' , `score`=`score`+100 WHERE `id`=$id";
	}
	mysqli_query($con, $query);
	header('Location: questions.php?justanswered=1');
}
elseif(in_array(strtolower(mysqli_real_escape_string($con, $_POST['answer'])), $pool))
{
	header('Location: questions.php?close=1');
}
else
{
	header('Location: questions.php?wrong=1');
}




?>