<?php

$currentime=time();



?>
<!DOCTYPE html>
<html>
<head>
	<title>IEEE-VIT Enigma</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name='viewport' content="width=device-width, initial-scale=1">
</head>
<body>

<div class="background">
	<img src="images/Picture.png" id='main-window-img'>
</div>



<div class="side-door" id='login-window'>
	

	<img class="ieeelogo" src="images/ieeevit.png">
	
	<div class="animated-logo">
		<div>
			<img src="images/logo-separate/logo_e.png">
			<img class="rotateeee clock" src="images/logo-separate/logo_inner_circle.png">
			<img class="rotateeee clock2" src="images/logo-separate/logo_middle_circle.png">
			<img class="rotateeee clock3" src="images/logo-separate/logo_outter_circle.png">
		</div>
	</div>

	<div class="form">

		<form>
		<div id='login-message-window' style="color: red;width: 100%;margin-bottom: 10px;text-align: center;display:none">That did not match our database</div>
		<img src="images/logo-separate/logo_enigma.png" style="width: 100%;margin-bottom: 40px">
			<input type="text" name="email" placeholder="VIT Email" id='email'>
			<input type="password" name="password" placeholder="Password" id='pass'>
			<input onclick="return loginVerify()" type="submit" name="submit" class='submit-button' value="Login">
		</form>

		<a onclick="changewindow(this, 'signup-window')">Sign up</a>
		<a onclick="changewindow(this, 'signup-window')">Forgot Password</a>

	</div>
	
</div>

<div class="side-door" id='signup-window'>
	

	<img class="ieeelogo" src="images/ieeevit.png">

	<div class="animated-logo">
		<div>
			<img src="images/logo-separate/logo_e.png">
			<img class="rotateeee clock" src="images/logo-separate/logo_inner_circle.png">
			<img class="rotateeee clock2" src="images/logo-separate/logo_middle_circle.png">
			<img class="rotateeee clock3" src="images/logo-separate/logo_outter_circle.png">
		</div>
		
	</div>
	<div class="form">

		<form>
			<div id='message-window' style="color: red;width: 100%;margin-bottom: 10px;text-align: center;"></div>
			<img src="images/logo-separate/logo_enigma.png" style="width: 100%;;margin-bottom: 40px">
			<input type="text" name="email" placeholder="VIT Email" id='signup-email'>
			<input type="submit" name="submit" class='submit-button' value="Send Password" onclick=" return signupVerify()">
		</form>

		<a onclick="changewindow(this, 'login-window')">Log me in</a>

	</div>
	
</div>

<script type="text/javascript">

	var ref=0;
	var transition='-25%';
	var mainWindowImage=document.getElementById('main-window-img');

	if(window.innerWidth < 750)
	{
		ref=1;
		transition='-100%';
		mainWindowImage.src='images/Picture2.png'
	}

	function begin()
	{
		document.getElementById('signup-window').style.left=transition;
	}


	function changewindow(ele, idName)
	{
		//(ele.parentNode).style.left=transition;
		(ele.parentNode.parentNode).style.left=transition;
		document.getElementById(idName).style.left='0';
	}

	if(window.ActiveXObject)
		{
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			xhr = new XMLHttpRequest();
		}

	function loginVerify()
	{
		var email=document.getElementById('email').value;
		var pass=document.getElementById('pass').value;
		if(xhr.readyState==0 || xhr.readyState==4)
		{
			xhr.open('get', ('login-verify.php?email='+email+'&pass='+pass));
			xhr.onreadystatechange=fire;
			xhr.send(null);
		}
		else
		{
			setTimeout('loginVerify', 2000);
		}
		return false;
	}

	var response;

	function fire()
	{
		if(xhr.readyState==4 && xhr.status==200)
		{
			response=xhr.responseText;
			if(response=='done')
			{
				window.location='profile.php';
			}
			else
			{
				document.getElementById('login-message-window').style.display='block';
				document.getElementById('email').value='';
				document.getElementById('pass').value='';
			}
		}
		else
		{
			setTimeout('loginVerify', 1000);
		}
	}

	function signupVerify()
	{
		var signupEmail=document.getElementById('signup-email').value;

		if(xhr.readyState==0 || xhr.readyState==4)
		{
			xhr.open('get', ('signup-verify.php?email='+signupEmail));
			xhr.onreadystatechange=fireSignup;
			xhr.send(null);
		}
		else
		{
			setTimeout('signupVerify', 2000);
		}
		return false;
	}

	function fireSignup()
	{
		if(xhr.readyState==4 && xhr.status==200)
		{
			response=xhr.responseText;
			if(response=='yes')
			{
				document.getElementById('message-window').style.color='black';
				document.getElementById('message-window').innerHTML='Password Sent to your mail';
			}
			else
			{
				document.getElementById('message-window').style.color='red';
				document.getElementById('message-window').innerHTML='Not a valid VIT email';
			}
		}
		else
		{
			setTimeout('signupVerify', 1000);
		}
	}

begin();

//setInterval(function() {window.location='index.php';}, 20000);



</script>

</body>
</html>
