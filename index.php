<!DOCTYPE html>
<html>
<head>
	<title>IEEE-VIT Enigma</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name='viewport' content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/circle.css">
</head>
<body>

<div class="background" id='main-window'>
	<img src="images/Picture.png" id='main-window-img'>

	<div class="main-iframe">
		<iframe src="questions.php" id='display-window'></iframe>
	</div>


</div>

<img src="images/menubutton.png" class="menu-button" onclick="toggleMenu()">

<div class="side-menu-bar" id='side-menu-bar'>

<ul>
	<img src="images/logo-separate/white-enigma.png" style="width: 100%;margin-bottom: 100px">
	<li onclick="changesrc('about.php')"><img src="images/about.png">About</li>
	<li onclick="changesrc('leaderboard.php')"><img src="images/leaderboard.png">LeaderBoard</li>
	<li onclick="changesrc('rules.php')"><img src="images/rules.png">Rules</li>
	<li onclick="window.open('https://www.facebook.com/events/1126831407356291/', '_blank')"><img src="images/fb-logo.png">Updates</li>
	<img src="images/white-ieeevit.png" style="width: 50%;position: absolute;bottom: 10px;left:15px">
</ul>

	
</div>


<script type="text/javascript">

	var menuShown=0;
	var mainWindow=document.getElementById('main-window');
	var mainWindowImage=document.getElementById('main-window-img');
	var sideMenu=document.getElementById('side-menu-bar');

	var ref=0;
	var transition='-25%';
	var transition2='25%';

	if(window.innerWidth < 750)
	{
		ref=1;
		transition='-90%';
		transition2='90%';
		mainWindowImage.src='images/Picture2.png';
	}

	
	function toggleMenu()
	{

		if(menuShown)
		{
			sideMenu.style.left=transition;
			mainWindow.style.left='0';
			mainWindowImage.style.left='0';
			menuShown=0;
		}
		else
		{
			sideMenu.style.left='0';
			mainWindow.style.left=transition2;
			mainWindowImage.style.left=transition2;
			menuShown=1;
		}


	}

	function executer()
	{
		console.log('this is it');
	}

	function changesrc(locationString)
	{
		document.getElementById('display-window').src=locationString;
		sideMenu.style.left=transition;
			mainWindow.style.left='0';
			mainWindowImage.style.left='0';
			menuShown=0;
	}

</script>


</body>
</html>
