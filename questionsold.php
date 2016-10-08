<?php

session_start();

if(!isset($_SESSION['id']) || !isset($_SESSION['email']))
{
	die('You Scripted Kiddie ;)');
}

$email=$_SESSION['email'];
$id=$_SESSION['id'];

require 'connectdatabase.php';

$query="SELECT `score`, `prevquesattempted` FROM `users` WHERE `id`=$id";
$results=mysqli_query($con, $query);
$row=mysqli_fetch_assoc($results);
$num=$row['prevquesattempted']+1;
$score=$row['score'];

if($num==1)
{
	$submitForm='submitOne.php';
}
elseif($num==5)
{
	$jigsaw='<br><center><a href="http://www.flash-gear.com/index.php?puz"><img src="http://www.flash-gear.com/puz1.gif"></a><br><EMBED allowScriptAccess="always" allowNetworking="all" src="http://five.flash-gear.com/npuz/puz.php?c=f&o=1&id=4615548&k=25513263&s=150&w=600&h=600" quality=high wmode=transparent scale=noscale salign=LT bgcolor="FFFFFF" WIDTH="750" HEIGHT="750" NAME="puz348150" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" /><BR><a href="http://www.flash-gear.com/index.php?puz"><img src="http://www.flash-gear.com/puz2.gif"><br><b><font face="Verdana"><h5>provided by flash-gear.com</h5></font></b></a><br></center><br>';
	$submitForm='submitAnswer.php';
}
elseif ($num==10) 
{
	$jigsaw='<a style="color: white;font-size: 50px;" href="quesImages/song.mp3">&#9835;</a>';
	$submitForm='submitAnswer.php';
}
elseif ($num==12) 
{
	$emailques='<input type="text" style="font-size: 17px;width: 200px;background-color: white;color: black" name="email" value="someone@example.com"><br>';
	$submitForm='submit12.php';
}
elseif ($num==17) 
{
	$playyy="onclick='return setStr(startStr)'";
	$stoppp="onclick='return setStr(stopStr)'";
	$emailques="<button $playyy>&#9654;</button><input type='text' style='font-size: 25px;width: 50px;text-align:center;border:0' name='number' value='100' id='numText'><button style='font-size:15px' $stoppp>&#9632;</button><br>";

	$submitForm='submit17.php';
}
elseif ($num==22) 
{
	$jigsaw='<a style="color: white;font-size: 50px;" href="quesImages/song2.mp3">&#9835;</a>';
	$submitForm='submitAnswer.php';
}
else
{
	$submitForm='submitAnswer.php';
}

$query="SELECT * FROM `questions` WHERE `id`=$num";
$results=mysqli_query($con, $query);

if($row=mysqli_fetch_assoc($results))
{
	$question=$row['question'];
	$image1=$row['image1'];
	$image2=$row['image2'];
	$image3=$row['image3'];

	if($image1=='0')
	{
		unset($image1);
	}

	if($image2=='0')
	{
		unset($image2);
	}

	if($image3=='0')
	{
		unset($image3);
	}


}
else
{
	$question="Congratulations, You have finished the contest !";
	$noAnswer='yes';
}



?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/circle.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
		var stopStr='stop';
		var startStr='start';
	</script>
</head>
<body class="iframe-body">

<br>

<div class="score-bar" id='scoreShow'>
    <span>Score</span><br><?php echo $score; ?>
</div>

<br><br><br>

<?php

if(isset($_GET['wrong']))
{
	echo "<h3 style='color:red;text-align:center'>Oops! Wrong Answer</h3>";
}
if(isset($_GET['close']))
{
	echo "<h3 style='color:green;text-align:center'>You are close</h3>";
}
if(isset($_GET['justanswered']))
{
	echo "<h3 style='color:green;text-align:center'>Woahhh! Lets see if you can solve this one</h3>";
}

?>

<h1 style="width: 95%;margin-left:2.5%;"><?php echo $question; ?></h1>

<div class="questions-images">

<?php 

if(isset($image1))
{
	echo "<img src='$image1'>";
}
if(isset($image2))
{
	echo "<img src='$image2'>";
}
if(isset($image3))
{
	echo "<img src='$image3'>";
}

if(isset($jigsaw))
{
	echo $jigsaw;
}

?>
	
</div>

<?php

if(!isset($noAnswer))
{
 	echo "<form style='margin-top: 30px' action='$submitForm' method='POST' class='answerForm'>"; 
 	if(isset($emailques)) {echo $emailques;}
 	echo "<span>Ans.</span> <input type='text' name='answer'>";
 	echo "<input type='submit' name='submit' value='&rarr;' class='subButt'>";
 	if($num!=1)
 	{
 		echo "<input type='submit' name='submi' value='&#128161;' class='subButt' ondblclick='return getHint()' onclick='return false;'>";
 	}
 	echo "</form>";
}




?>


	
</form>

<div class="hint" style="text-align: center;width:95%;margin-left:2.5%" id='hint'>

<img src="images/logo.png" class="logooo" style="position:static;width: 250px;margin:0">

<h3>The hint is over here and you are gonna loose 100 points.</h3>

</div>


<?php

if(isset($playyy))
{
	echo "<script type='text/javascript'>
		var num=document.getElementById('numText');
		var str='start';

		function setStr(st)
		{
			str=st;
			return false;
		}

		function play()
		{
			if(str=='start')
			{
				var val=num.value;
				val=parseInt(val)-1;
				if(val==0)
				{
					val=100;
				}
				num.value=val;
			}
			else
			{

			}

			setTimeout(play, 1000);

		}

	play();
	</script>";
}

?>

<script type="text/javascript">

	var hintDiv=document.getElementById('hint');
	var scoreDiv=document.getElementById('scoreShow');

	hintDiv.innerHTML='';

	var shown=0;
	
	if(window.ActiveXObject)
	{
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		xhr = new XMLHttpRequest();
	}

	function getHint()
	{
		if(xhr.readyState==0 || xhr.readyState==4)
		{
			if(shown==0)
			{
				hintDiv.innerHTML='<img src="images/logo.png" class="logooo" style="position:static;width: 250px;margin:0">';
				xhr.open('get', 'fetchHint.php');
				xhr.onreadystatechange=fillHintDiv;
				xhr.send(null);
			}
		}
		else
		{
			setTimeout('getHint', 1000);
		}

		return false;
	}

	function fillHintDiv()
	{
		if(xhr.readyState==4 && xhr.status==200)
		{
			hintDiv.innerHTML=xhr.responseText;
			shown=1;
		}
		else
		{
			setTimeout('fillHintDiv', 1000);
		}
	}


</script>


</body>
</html>