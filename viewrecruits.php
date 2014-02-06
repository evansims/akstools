<? $pageid='viewrecruits'; include('settings.php'); include('phpheader.php'); include('header.php'); ?>

<h2>View All Recruits</h2>

<table id='viewrecruits'>
<tr>
	<th>Vote</th>
	<th>Recruit Name</th>
	<th>Forum Name</th>
	<th>Status</th>
	<th>Game</th>
	<th>Trial Date</th>
	<th>Trial Days</th>
	<th>Comments</th>
	<th>O.Score</th>
	<th>M.Score</th>
	<th>Added by</th>
</tr>
<? 
// Fill table with currently active recruits
// grab active recruits from DB
if ($dbR = $db->query("SELECT * FROM recruits WHERE status = 1 ORDER BY trialStart, name")){
	if ($dbR->num_rows > 0){
		for($i = 0; $i < $dbR->num_rows; $i++){
			$result = $dbR->fetch_assoc();
			
			// caclulate number of trial days
			$today = time();
			$trialTS = strtotime($result['trialStart']);
			$datediff = $today - $trialTS;
			$datediff = floor($datediff/(60*60*24));

			// format date
			$trialDate = new DateTime($result['trialStart']);
			$trialDate = "{$trialDate->format('Y-m-d')}";

			// get vote counts
			$dbR2 = $db->query("SELECT * FROM votes WHERE recruitID = '{$result['recruitID']}' AND vote > 0 AND userAccessLevel > 1");
			$upOfficerVotes = $dbR2->num_rows;
			$dbR2 = $db->query("SELECT * FROM votes WHERE recruitID = '{$result['recruitID']}' AND vote < 0 AND userAccessLevel > 1");
			$downOfficerVotes = $dbR2->num_rows;
			$dbR2 = $db->query("SELECT * FROM votes WHERE recruitID = '{$result['recruitID']}' AND vote > 0 AND userAccessLevel = 1");
			$upMemberVotes = $dbR2->num_rows;
			$dbR2 = $db->query("SELECT * FROM votes WHERE recruitID = '{$result['recruitID']}' AND vote < 0 AND userAccessLevel = 1");
			$downMemberVotes = $dbR2->num_rows;

			// display recruit info in a table
			$recruitName = stripslashes($result['name']);
			$recruitForum = stripslashes($result['forumName']);
			$submitName = userIDtoName($result['addedUserID']);
			$gameShort = gameIDtoSN($result['gameID']);

			echo "<tr>
			<td><img src='img/thumbsup.png' class='voteUp' alt='voteUp' id='{$result['recruitID']}'/><img src='img/thumbsdown.png' class='voteDown' alt='voteDown' id='{$result['recruitID']}'/></td>
			<td>{$recruitName}</td>
			<td>{$recruitForum}</td>
			<td>{$result['status']}</td>
			<td>{$gameShort}</td>
			<td>{$trialDate}</td>
			<td>{$datediff}</td>
			<td>0 <img src='img/plusbutton.png'/></td>
			<td><img src='img/thumbsup.png'/> {$upOfficerVotes} <img src='img/thumbsdown.png'/> {$downOfficerVotes}</td>
			<td><img src='img/thumbsup.png'/> {$upMemberVotes} <img src='img/thumbsdown.png'/> {$downMemberVotes}</td>
			<td>{$submitName}</tr>";	
		}
	}
}	
?>	
</table>

<? include('footer.php'); ?>