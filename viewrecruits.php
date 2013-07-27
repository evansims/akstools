<? $pageid='viewrecruits'; include('settings.php'); include('phpheader.php'); include('header.php'); ?>

<h2>View Recruits</h2>
<?
$dbR = $db->query("SELECT * FROM users WHERE username = '{$_SESSION['username']}'");
				$result = $dbR->fetch_assoc();
?>

<table id='viewrecruits'>
<tr>
	<th>Vote</th>
	<th>Recruit Name</th>
	<th>Forum Name</th>
	<th>Status</th>
	<th>Wave</th>
	<th>Trial Date</th>
	<th>Trial Day</th>
	<th>Comments</th>
	<th>M.Score</th>
	<th>O.Score</th>
</tr>
<tr>
</tr>
</table>

<? include('footer.php'); ?>