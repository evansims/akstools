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
</tr>
<? 
// Fill table with currently active recruits
// grab active recruits from DB
if ($dbR = $db->query("SELECT * FROM recruits")){
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

			// display recruit info in a table
			echo "<tr>
			<td><img src='img/thumbsup.png'/><img src='img/thumbsdown.png'/></td>
			<td>{$result['name']}</td>
			<td>{$result['forumName']}</td>
			<td>{$result['status']}</td>
			<td>{$result['gameID']}</td>
			<td>{$trialDate}</td>
			<td>{$datediff}</td>
			<td>Comments</td>
			<td>O.Score</td>
			<td>M.Score</td></tr>";	
		}
	}
}	
?>	
</table>

<? include('footer.php'); ?>