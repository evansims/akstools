<? $pageid = 'addrecruit'; include('settings.php'); include('phpheader.php'); include('header.php'); ?>

<?
if (isset($_POST['submitRecruit'])){
	$recruitIGN = addslashes($_POST['IGN']);
	$recruitForum = addslashes($_POST['forumname']);
	$recruitGame = addslashes($_POST['game']);
	$recruitTrialD = $_POST['startdate'];

	$dbR = $db->query("INSERT INTO recruits (name, forumName, trialStart, gameID, status, addedUserID) VALUES ('$recruitIGN', '$recruitForum', '$recruitTrialD', '$recruitGame', 1, '$user->user_id')");
	
	$infomes = 'Recruit Submitted';
}

if (isset($infomes)){
	echo "<div class='infobox'><p>" . $infomes . "</p></div>";
}
?>

<form name='subRecruit' id='subRecruit' class='cmxform' method='POST'>
	<span class='label'>Recruit IGN</span><input type='text' name='IGN'/><br/>
	<span class='label'>Recruit Forum Name</span><input type='text' name='forumname'/><br/>
	<span class='label'>Game</span>
	<select name='game'>
		<?
		// dynamically load games
		$dbR = $db->query("SELECT * FROM games ORDER BY gameName");
		for ($x = 0; $x < $dbR->num_rows; $x++){
			$result = $dbR->fetch_assoc();	
			echo "<option value='" . $result['gameID'] . "'>" . $result['gameName'] . "</option>";
		}
		?>
		</select><br/>
	<span class='label'>Trial Start Date</span><input type='text' name='startdate' id='datepicker'/><br/>
	<input type='submit' value='Submit' name='submitRecruit'/>
</form>

<? include('footer.php'); ?>