<!DOCTYPE HTML>
<html>
<head>
	<title>Aureus Knights .:. Current Recruits</title>
	<meta name='description' content='Aureus Knights Recruit Management Tool'/>
	<link href='embed.css' rel='stylesheet' type='text/css' />
	<link rel="icon" type="image/x-icon" href="favicon.ico" />
</head>

<body>
<?
// Database params
$database_host = '205.186.145.205';
$database_user = 'rynetdbuser';
$database_pass = 'db user PASS09';
$database_name = 'akstools';

// Admin contact email
$contactemail = 'rjo@rynet.com';

// start up a database connection
$db = new mysqli($database_host, $database_user, $database_pass, $database_name);
// confirm database connected
if($db->connect_errno){ 
	$site_message = 'The site appears to be having database issues.  It is likely there will be problems loading some content, try refreshing the site';
	die('Connection to database server failed.  Please contact ' . $contactemail . ' Error number: ' . $db->connect_error); 
}?>

<h2>Current Recruits</h2>

<table id='viewrecruits'>
<tr>
	<th>Recruit Name</th>
	<th>Forum Name</th>
</tr>
<? 
// Fill table with currently active recruits
// grab active recruits from DB
if ($dbR = $db->query("SELECT * FROM recruits ORDER BY name")){
	if ($dbR->num_rows > 0){
		for($i = 0; $i < $dbR->num_rows; $i++){
			$result = $dbR->fetch_assoc();
			
			// display recruit info in a table
			echo "<tr>
			<td>{$result['name']}</td>
			<td>{$result['forumName']}</td></tr>";	
		}
	}
}	
?>	
</table>
</body>
</html>