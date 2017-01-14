<?php
require_once ('session.php');
require_once ('mysql_access.php');
?>
<!doctype html>
<html>
<head>
    <?php require 'head.php';?>
</head>

<body class="slide" data-type="background" data-speed="5">
    <!-- Javascript method to include navigation -->
    <nav id="nav" role="navigation"><?php include 'nav.php';?></nav>
    <!-- PHP method to include navigation -->

    <!-- Javascript method to include header -->
    <div id="header"><?php include 'header.php';?></div>
    <!-- PHP method to include header -->
<div class="row">

<?php
$exec_page = False;
$active_page = True;
$public_page = False;
require_once('permissions.php');

function delete_event($entry) {
  include ('mysql_access.php');
  $sql = "DELETE FROM `events_signup` WHERE `entry_id` = '$entry' LIMIT 1";
  $delete = $db->query($sql) or exit("There was an error, contact Webmaster");
}

function show_active() {
	echo "<h1>Events you are leading:</h1>";

	$user_id = $_SESSION['sessionID'];
   	include('mysql_access.php');

	if (isset($_GET['delete'])) {
		$entry = $_GET['delete'];
		delete_event($entry);
	}

	$response=$db->query("SELECT * FROM events_listing WHERE event_leader_id = $user_id");
	while($result=mysqli_fetch_array($response))
	{
		$eid = $result['event_id'];
		?>
		<table>
		<tr><td colspan="2"><?= $result['event_name'] ?></td><td>Type: <?= $result['event_type'] ?> </td><td> <?= $result['event_time'] ?> </td></tr>
		<tr><th>#</th><th>Name</th><th>Email</th><th>Note</th><th>Delete?</th></tr>
		<?php
		//loop for each participant. Display name, factor, and email!
		$count = 0;
		$aresponse=$db->query("SELECT user_id,factor,entry_id FROM events_signup WHERE event_id = $eid");

		while($aresult=mysqli_fetch_array($aresponse))
		{
			$count++;
			$entry = $aresult['entry_id'];
			$uid = $aresult['user_id'];
			$uresponse=$db->query("SELECT firstname,lastname,email FROM contact_information WHERE id = $uid");
			$uresult=mysqli_fetch_array($uresponse);
			echo "<tr><td>" . $count . "</td><td>" . $uresult['firstname'] . " " . $uresult['lastname'] . "</td><td>" . $uresult['email'] . "<td></td><td><sup><a href='leader_list.php?delete=$entry'>Delete?</a></sup></td>" . "</td>";
			echo "<td>" . $aresult['factor'] . "</td></tr>";
		}
		?>
		</table>
		<?php
	}
}


?>
</div>
    <!-- Javascript method to include footer -->
    <div id="footer"><?php include 'footer.php';?></div>
    <!-- PHP method to include footer -->
</body>
</html>