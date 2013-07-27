<? $pageid='index'; include('settings.php'); include('phpheader.php'); include('header.php'); ?>
<? 
// check login form
if(isset($_POST['loginSubmit'])){
	$name = $_POST['name'];
	$password = $_POST['password'];

	if(!$user->login($name, $password)){
		$message = 'Login Name/Password Incorrect, Please Try Again';
	}
}

// check register form
if(isset($_POST['registerSubmit'])){
	$name = $_POST['name'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	if(!$user->registerUser($name, $password, $email)){
		$message = 'Error With Registration - Please Try Again';
	}else{
		$message = 'Registration Successful - Welcome to AKS Tools';
	}
}
// if site message, show message
if (isset($message)){
	echo "<div class='infobox'><p>" . $message . "</p></div>";
}

if(!$user->sessionStatus()){
	include('view_login.php');
}else{
	include('view_dashboard.php');
}
?>

<? include('footer.php'); ?>