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

if(!($que==17))
{
	die('1You Scripted Kiddie ;)');
}

if(isset($_POST['answer']) && !empty($_POST['answer']))
{
	
}
else
{
	header('Location: questions.php?wrong=4');
}

if(isset($_POST['number']))
{
	
		if('42'==mysqli_real_escape_string($con, $_POST['number']))
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