<!DOCTYPE html>
<html>
<head>
	<title>IEEE-VIT Enigma</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name='viewport' content="width=device-width, initial-scale=1">
</head>
<body>

<div class="background">
	<img src="images/Picture.png">
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

	<div class="countdown">
	<img src="images/logo-separate/logo_enigma.png" style="width: 80%;margin-bottom: 40px">
		The Contest has ended

	</div>
	
</div>

<script type="text/javascript">

	var ref=0;
	var transition='-25%';

	if(window.innerWidth < 750)
	{
		ref=1;
		transition='-100%';
	}

	var finalTime=1470394200;
	var currTime=<?php echo time(); ?>;
	var days=document.getElementById('days');
	var hours=document.getElementById('hour');
	var minutes=document.getElementById('minutes');
	var seconds=document.getElementById('seconds');
	var secondsLeft=0;
	var minutesLeft=0;
	var hoursLeft=0;
	var daysLeft=0;

	function internettime()
	{
		if(currTime<finalTime)
		{

			secondsLeft=0;
			minutesLeft=0;
			hoursLeft=0;
			daysLeft=0;

			secondsLeft=finalTime-currTime;

			while(secondsLeft>60)
			{
				secondsLeft-=60;
				minutesLeft++;
			}

			while(minutesLeft>60)
			{
				minutesLeft-=60;
				hoursLeft++;
			}

			while(hoursLeft>24)
			{
				hoursLeft-=24;
				daysLeft++;
			}

			

			days.innerHTML='';
			hours.innerHTML=("0" + hoursLeft).slice(-2) + '<br><span>Hours</span>';
			minutes.innerHTML=("0" + minutesLeft).slice(-2) + '<br><span>Minutes</span>';
			seconds.innerHTML=("0" + parseInt(secondsLeft)).slice(-2) + '<br><span>Seconds</span>';

			currTime+=1;
			setTimeout(internettime, 1000);
		}
		else
		{
			days.innerHTML='';
			hours.innerHTML='00';
			minutes.innerHTML='00';
			seconds.innerHTML='00';
		}
	}

	internettime();



</script>

</body>
</html>
