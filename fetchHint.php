<?php

session_start();

if(isset($_SESSION['id']))
{
	require 'connectdatabase.php';

	$id=$_SESSION['id'];
	$query="SELECT `hintShown` FROM `users` WHERE `id`=$id";
	$results=mysqli_query($con, $query);
	$row=mysqli_fetch_assoc($results);
	$hintShown=$row['hintShown'];
	if(intval($hintShown)==1)
	{
		$query="SELECT `hint` FROM `questions`, `users` WHERE `users`.`id`=$id AND `questions`.`id`=`prevquesattempted`+1";
		$results=mysqli_query($con, $query);
		$row=mysqli_fetch_assoc($results);
		$hint=$row['hint'];
	}
	else
	{
		$query="SELECT `prevquesattempted` FROM `users` WHERE `id`=$id";
		$results=mysqli_query($con, $query);
		$que=intval(mysqli_fetch_assoc($results)['prevquesattempted'])+1;

		if($que<11)
		{
			$penality=100;
		}
		elseif($que<21)
		{
			$penality=200;
		}
		elseif($que<26)
		{
			$penality=300;
		}
		else
		{
			$penality=500;
		}

		$query="SELECT `hint`, `score` FROM `questions`, `users` WHERE `users`.`id`=$id AND `questions`.`id`=`prevquesattempted`+1";
		$results=mysqli_query($con, $query);
		$row=mysqli_fetch_assoc($results);
		$hint=$row['hint'];
		$user_score=$row['score'];

		if($user_score>=$penality)
		{
			$query="UPDATE `users` SET `score`=`score`-$penality, `hintShown`=1 WHERE `id`=$id";
			$results=mysqli_query($con, $query);
		}
		else
		{
			$hint="You dont have enough points";
		}
	}

	echo "<h3>".$hint."</h3>";
}








?>