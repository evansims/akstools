<!DOCTYPE HTML>
<html>
<head>
	<title>Aureus Knights .:. Recruit Management Tool</title>
	<meta name='description' content='Aureus Knights Recruit Management Tool'/>
	<link href='global.css' rel='stylesheet' type='text/css' />
	<link rel="icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="js/vote.js"></script>
	<script src="js/adminrecruits.js"></script>
	<link href='js/jquery-ui-1.10.3.custom.min.css' rel='stylesheet' type='text/css' />
	<? if($pageid == 'addrecruit'){echo "<script src='datepicker.js'></script>";} ?>
</head>

<body>
<div id='mainbox'>
<div id='header'>
	<div id='logoheader'>
		<img src='img/akslogo.png' alt='AKS Logo' id='logo'/>
		<h1>Aureus Knights Recruit Management Tool</h1>
	</div>
	<div class='cleardiv'></div>

	<div id='navbar'>
		<ul>
			<li><a href='index.php'>Home</a></li>	
			<? // check if the user is logged in, if not and not on the index page, dump them
				if($pageid != 'index' && (!$user->sessionStatus())){
					echo 'This site requires users to be logged in';
					die();
				}
				if($pageid != 'index' && $user->user_accessLevel < 1){
					echo 'Your account has not yet been approved.  Contact an officer';
					die();
				}
			?>
			<li><a href='viewrecruits.php'>View Recruits</a></li>
			<li><a href='addrecruit.php'>Add Recruit</a></li>
			<!-- commenting out some unimplemented features -->
			<!--<li><a href='managewave.php'>Manage Waves</a></li>-->
			<!--<li>Manage Games</li>-->
			<!--<? if($user->user_accessLevel >= 3){echo "<li><a href='manageusers.php'>Manage Users</a></li>";}?>-->
			<? if($user->sessionStatus()){echo "<li><a href='logout.php'>Logout</a></li>";}?>
		</ul>
	</div>
</div>
<div id='content'>