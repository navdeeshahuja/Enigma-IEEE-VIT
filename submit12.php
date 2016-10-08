<?php

session_start();
$id=$_SESSION['id'];

require 'connectdatabase.php';

$query="SELECT `questions`.`id` FROM `users`, `questions` WHERE `questions`.`id`=`users`.`prevquesattempted`+1 AND `users`.`id`=$id AND `users`.`prevquesattempted`>0";
$results=mysqli_query($con, $query);

if(mysqli_num_rows($results)==0)
{
	die('2You Scripted Kiddie ;');
}

$que=mysqli_fetch_assoc($results)['id'];

if(!($que==12))
{
	die('1You Scripted Kiddie ;)');
}

if(isset($_POST['answer']) && !empty($_POST['answer']))
{
	if(strtolower(mysqli_real_escape_string($con, $_POST['answer']))=='file hosting services')
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
			$query="UPDATE `users` SET `prevquesattempted`=`prevquesattempted`+1 , `lastmodified`='$date' , `hintShown`=0 , `time`='$time' , `score`=`score`+110 WHERE `id`=$id";
		}
		else
		{
			$query="UPDATE `users` SET `prevquesattempted`=`prevquesattempted`+1 , `lastmodified`='$date' , `hintShown`=0 , `time`='$time' , `score`=`score`+100 WHERE `id`=$id";
		}

		mysqli_query($con, $query);
		header('Location: questions.php?justanswered=1');
	}
	else
	{
		header('Location: questions.php?wrong=1');
	}
}

if(isset($_POST['email']))
{
	$query="SELECT `email` FROM `users` WHERE `id`=$id";
	$results=mysqli_query($con, $query);
	if($row=mysqli_fetch_assoc($results))
	{
		$email=$row['email'];
		if($email==mysqli_real_escape_string($con, $_POST['email']))
		{
			mail($email, 'This is the Answer', 'File Hosting Services');
			header('Location: questions.php?mailed=1');
		}
	}
	else
	{
		header('Location: questions.php?wrong=2');
	}
}
else
{
	header('Location: questions.php?wrong=3');
}



?>