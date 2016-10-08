<?php

require 'connectdatabase.php';

$query="SELECT `id`, `name`, `score` FROM `users` ORDER BY `prevquesattempted` DESC,  `score` DESC,  `lastmodified` ASC, `time` ASC";
$results=mysqli_query($con, $query);

$i=0;

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script type="text/javascript" src="jquery.sticky.js"></script>
  <script>
    $(window).load(function(){
      $("#header").sticky({ topSpacing: 0 });
    });
  </script>
	
	<style type="text/css">
		body
		{
			padding: 0;
			padding-top: 80px;
			color: white;
			width: 70%;
			margin: 0 auto;
			font-family: sans-serif, geneva, roboto;
		}

		a
		{
			color: white;
			text-decoration: none;
			display: block;
			font-size: 20px;
		}

		a:hover
		{
			text-decoration: underline;
		}

		h2
		{
			font-size: 25px;
			width: 100%;
			text-align: center;
		}

		table
		{
			width: 100%;
			border-collapse: collapse;
			font-size: 20px;
		}

		th, td
		{
			width: 24%;
			text-align: center;
		}

		tr
		{
			border-bottom: solid 2px white;
			height: 35px;
		}

		.is-sticky > div
		{
			background-color: black;
		}

		#header div
		{
			display: inline-block;
			width: 23.7%;
			text-align: center;
			font-size: 20px;
		}

		@media only screen and (max-width: 600px)
		{
			body
			{
				width: 95%;
			}
			#header div
			{
				width: 22%;
				font-size: 18px;
			}
		}
	</style>
</head>
<body>

<a href='#'> The contest has ended</a><br><br>

<h2>Leaderboard</h2>
<table id='list'>
	<div id='header'>
			<div>Rank</div>
			<div>Name</div>
			<div>Score</div>
			<div>Questions Solved</div>
	</div>

</table>

<div id='rotating-div'>
	
	<img src="images/logo.png" class="logooo">

</div>


<script type="text/javascript">


	if(window.ActiveXObject)
	{
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		xhr = new XMLHttpRequest();
	}

	var page=0;
	var prefRef=0;
	var rotDiv=document.getElementById('rotating-div');
	var list=document.getElementById('list');
	
	function getList()
	{
		if(prefRef==0)
		{
			rotDiv.style.display='block';
			page++;
			removeScrollFunction();
			var str='fetchBoard.php?page='+page;
			console.log(str);
			xhr.open('get', str);
			xhr.onreadystatechange=filldiv;
			xhr.send(null);
		}
	}

	function filldiv()
	{
		if(xhr.readyState==4)
		{
			if(xhr.status==200)
			{
				var res=xhr.responseText;
				if(res=='')
				{
					prefRef=1;
				}
				console.log(res);
				rotDiv.style.display='none';
				list.innerHTML = list.innerHTML.concat(res);
				enableScrollFunction();
			}
		}

	}

	getList();

	function removeScrollFunction()
	{
		window.onscroll = function(ev) {}
	}

	function enableScrollFunction()
	{

		window.onscroll = function(ev) {
	    if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
	    	getList();
	    }
		};
	}



</script>

</body>
</html>