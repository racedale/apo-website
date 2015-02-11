<?php
require_once ('session.php');
require_once ('PasswordHash.php');
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

<?php
//page_head();
//echo"<body style=\"background-color:#EBEBEB\" OnLoad=\"document.loginform.username.focus();\">";
//page_header();
echo "<div class='row'>";
function print_login(){
	$error_message = "";
	if (!isset($_GET['continue'])) {
	}
	if(isset($_GET['continue'])){
		session_register('continue');
		$_SESSION['continue'] = $_GET['continue'];}
		$continue = isset($_SESSION['continue']) ? $_SESSION['continue'] : '';
echo <<<END
	<h1>Conference Registration Login</h1><br>
		<form name="loginform" method="post" action="$_SERVER[PHP_SELF]">
			<div class="large-6 medium-6 small-12 large-centered medium-centered columns">
				<label for="username">Email: </label>
				<input type="text" name="username"/>
			</div><br>
			<div class="large-6 medium-6 small-12 large-centered medium-centered columns">
				<label for="password">Password: </label>
				<input type="password" name="password"/>
			</div><br>
			<div class="large-6 medium-6 small-12 large-centered medium-centered columns">
				<input type="submit" value="Login"/>
				<input type="hidden" name="logstate" value="login"/>
			</div><br>
		</form>
        <div class="large-3 medium-3 small-6 large-centered medium-centered columns">
            <a href="register.php" class="button expand">Register</a>
        </div>
        <div class="large-3 medium-3 small-6 large-centered medium-centered columns end">
            <a href="login_forgotpw.php" class="button expand">Forgot Password?</a>
        </div>
END;
	echo(isset($_SESSION['continue']) ? $_SESSION['continue'] : '');
}
function process_login(){
	require_once $_SERVER['DOCUMENT_ROOT'].'/mysql_access.php';
	$username = addslashes($_POST["username"]);
	$password = addslashes($_POST["password"]);
	$hasher = new PasswordHash(8, true);

	//validate operation code
	$op = $_POST['logstate'];
	if ($op !== 'new' && $op !== 'login'){
		fail('Unknown request');}

	if ($op === 'new') {
	$hash = $hasher->HashPassword($password);
	if (strlen($hash) < 20)
		fail('Failed to hash new password');
	unset($hasher);

	$what = 'User created';
	}
	else {
		$r = NULL;
		$hash = '*'; // In case the user is not found
		($stmt = $db->prepare('select password from contact_information where username=?'));
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$stmt->bind_result($hash);
		if (!$stmt->fetch() && $db->errno);

		if ($hasher->CheckPassword($password, $hash)) {
			$what = 'Authentication succeeded';
			$stmt->close();
			$select = "SELECT * FROM conf_contact_information WHERE username='$username'";
			$query = $db->query($select) or die("Unable to get data. $db->error");
			$r = $query->fetch_assoc();
		} else {
			$what = 'Authentication failed.  Please try again.';
		}
		unset($hasher);
	}

	echo "$what\n";

	if (!$r) {
		print_login(1);
	} else {
	extract($r);

	$_SESSION['sessionUsername'] = $username;
	$_SESSION['sessionFirstname'] = $firstname;
	$_SESSION['sessionLastname'] = $lastname;
	$_SESSION['sessionID'] = $id;


	$sql = "SELECT * FROM `conf_contact_information`
			WHERE `lastname` = '".$lastname."'
			AND `firstname` = '".$firstname."'
			AND `username` = '".$username."'";
	$result = $db->query($sql);

		echo "<meta http-equiv='refresh' content='0;url=\"index.php\"'>";

	}
}
function logout(){
      	unset($_SESSION['sessionUsername']);
      	unset($_SESSION['sessionFirstname']);
		unset($_SESSION['sessionLastname']);
		unset($_SESSION['sessionID']);
}
	if (!isset($_SESSION['sessionID']) && isset($_POST['logstate']) && ($_POST['logstate'] == 'login')) {
    	process_login();
	}else if (!isset($_SESSION['sessionID'])){
		print_login();
	}else {
		echo "<h3><a href='./logout.php'>Logout</a></h3>";
	}
echo <<<END
</div>
END;
?>

    <!-- Javascript method to include footer -->
    <div id="footer"><?php include 'footer.php';?></div>
    <!-- PHP method to include footer -->
</body>
</html>
