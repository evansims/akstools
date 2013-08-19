<? $pageid='managewaves'; include('settings.php'); include('phpheader.php'); include('header.php'); ?>

<h2>Players Wave Eligibile</h2>

<?
$i = 0;


$query = "SELECT r.recruitID, r.name, r.forumName, r.trialStart, sum(vote), count(vote)
FROM recruits r
LEFT JOIN votes v ON r.recruitID = v.recruitID
WHERE r.status = 1
GROUP BY r.recruitID";

$dbR = $db->query($query);
$numrow = $dbR->num_rows;
if ($numrow > 0){
	for ($x = 0; $x < $dbR->num_rows; $x++){
		$result = $dbR->fetch_array(MYSQLI_NUM);
		$recruitBucket = 0;

		// r.recruitID, r.name, r.forumName, r.trialStart, sum(vote), count(vote)
		// Find recruits with all positive votes, and above the threshold
		if ($result[4] == $result[5] && $result[4] >= minForWave){
			$recruitBucket = 1;
		}
		// Find recruits with all positive votes, that do not meet the threshold 
		if ($result[4] == $result[5] && $result[4] < minForWave && $result[4] > 0){
			$recruitBucket = 2;
		}
		// Find recruits with negative votes
		if ($result[4] <> $result[5] && $result[5] > 0) {
			$recruitBucket = 3;
		}

		if($recruitBucket <> 0){
			// if this reqruit is in a bucket, wave em.  If not.  Do nothing.
			$waveOut[$i]['name'] = $result[1];
			$waveOut[$i]['forumName'] = $result[2];
			$waveOut[$i]['trialStart'] = $result[3];
			$waveOut[$i]['voteSum'] = $result[4];
			$waveOut[$i]['voteCount'] = $result[5];
			$waveOut[$i]['bucket'] = $recruitBucket;
			$i++;
		}
	}
}

foreach ($waveOut as $key => $row) {
    $dates[$key]  = $row['bucket']; 
    // of course, replace 0 with whatever is the date field's index
}

array_multisort($dates, SORT_ASC, $waveOut);
?>

<table id='viewrecruits'>
<tr>
	<th>Wave Status</th>
	<th>Reason</th>
	<th>Member IGN</th>
	<th>Member FN</th>
	<th>Trial Date</th>
	<th>Votes</th>
	<th>Score</th>
	<th>Recommendation</th>
</tr>
<?
for ($y = 0; $y < $i; $y++){

	switch($waveOut[$y]['bucket']){
		case 1:
			$light = 'img/greenlight.png';
			$reco = 'Promote';
			break;
		case 2:
			$light = 'img/yellowlight.png';
			$reco = 'Wait';
			break;
		case 3: 
			$light = 'img/redlight.png';
			$reco = 'Discuss ASAP';
			break;
	}

	echo "
	<tr>
		<td><img width=75px src='{$light}'/></td>
		<td>{$waveOut[$y]['bucket']}</td>
		<td>{$waveOut[$y]['name']}</td>
		<td>{$waveOut[$y]['forumName']}</td>
		<td>{$waveOut[$y]['trialStart']}</td>
		<td>{$waveOut[$y]['voteCount']}</td>
		<td>{$waveOut[$y]['voteSum']}</td>
		<td>{$reco}</td>
	</tr>
	";
}
?>
</table> 


<? include('footer.php'); ?>