<!DOCTYPE html>
<html>
<head>
	<title>IEEE-VIT Enigma</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<meta name='viewport' content="width=device-width, initial-scale=1">
</head>
<body>

<div class="background" id='main-window'>
	<img src="../images/Picture.png" id='main-window-img'>

	<div class="main-iframe">
		<iframe src="../new.php"></iframe>
	</div>


</div>

<img src="../images/menubutton.png" class="menu-button" onclick="toggleMenu()">

<div class="side-menu-bar" id='side-menu-bar'>

<ul>
	<li>About</li>
	<li>LeaderBoard</li>
	<li>Rules</li>
	<li>Logout</li>
</ul>
	
</div>


<script type="text/javascript">

	var menuShown=0;
	var mainWindow=document.getElementById('main-window');
	var mainWindowImage=document.getElementById('main-window-img');
	var sideMenu=document.getElementById('side-menu-bar');

	
	function toggleMenu()
	{

		if(menuShown)
		{
			sideMenu.style.left='-25%';
			mainWindow.style.left='0';
			mainWindowImage.style.left='0';
			menuShown=0;
		}
		else
		{
			sideMenu.style.left='0';
			mainWindow.style.left='25%';
			mainWindowImage.style.left='25%';
			menuShown=1;
		}


	}

</script>


</body>
</html>
