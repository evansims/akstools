<? 
include('settings.php');
include('phpheader.php');

if($user->user_accessLevel <= 3){
		echo "Unauthorized access";
		die();
	}
	
if (isset($_GET['recruitID'])){
	$recruitID = $_GET['recruitID'];

	$dbR = $db->query("SELECT * FROM recruits WHERE recruitID = '{$recruitID}'");

	if($dbR->num_rows > 0){
		$db->query("UPDATE recruits SET status=3 WHERE recruitID = '{$recruitID}'");
	}else{
		return false;
	}
	
}else{
	return false;
}
?>