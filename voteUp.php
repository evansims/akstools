<? 
include('settings.php');
include('phpheader.php');

if($user->user_accessLevel < 1){
		echo "Unauthorized access";
		die();
	}
	
if (isset($_GET['recruitID'])){
	$recruitID = $_GET['recruitID'];
	$userID = $user->user_id;
	$userAccess = $user->user_accessLevel;
	
	$dbR = $db->query("SELECT * FROM votes WHERE recruitID = '{$recruitID}' AND userID = '{$userID}'");
	if($dbR->num_rows == 0){
		$dbR = $db->query("INSERT INTO votes (userID, recruitID, vote, userAccessLevel) VALUES ('$userID', '$recruitID', 1, '$userAccess')");
	}else{
		$dbR = $db->query("UPDATE votes SET vote=1 WHERE recruitID = '{$recruitID}' AND userID = '{$userID}'");
	}

}else{
	return false;
}
?>