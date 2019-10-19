<?php require_once 'system/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

$user = DB::getInstance()->query("SELECT id, username FROM users WHERE username = '{$user->data()->username}' ");
foreach($user->results() as $user){
	$cashier_id = $user->id;
	$cashier_account = $user->username;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Library System | Accounts</title>
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
	<link rel="stylesheet" type="text/css" href="css/librarian_styles.css">
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script src = "js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" >
		$(document).ready(function(){
			$("#notificationLink").click(function(){
				$("#notificationContainer").fadeToggle(300);
				$("#notification_count").fadeOut("slow");
				return false;
			});

			//Document Click
			$(document).click(function(){
				$("#notificationContainer").hide();
			});
			//Popup Click
			$("#notificationContainer").click(function(){
				return false
			});
		});
	</script>
	<style>
		@import url(http://fonts.googleapis.com/css?family=Ubuntu:400,700);
		body {
			background: #563c55 url(images/blurred.jpg) no-repeat center top;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			background-size: cover;
		}
	</style>
</head>
<body>
	<header><img src = "images/header-cls.png" style ="height:122px; width:1015px;"></header>
	<nav>
		<ul id = "nav">
			<li><a href="cashier.php">Home</a></li>
			<!-- <li><a href="cashier_transaction.php">Transaction</a></li> -->
			<li><a href="cashier_account.php">My Account</a></li>
			<li id="notification_li">
				<!-- <span id="notification_count">3</span> -->
				<a href="cashier_notifications.php">Notifications</a>
				<!--
				<div id="notificationContainer">
					<div id="notificationTitle">Notifications</div>
					<div id="notificationsBody" class="notifications">
					</div>
					<div id="notificationFooter"><a href="#">See All</a></div>
				</div>
				-->
			</li>
			<!-- <li><a href="cashier_reports.php">Reports</a></li> -->
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>
	<br>
	
	<div>	
		<?php
		$user = DB::getInstance()->query("SELECT * FROM tbl_personnel WHERE username = '{$cashier_account}'");
			foreach($user->results() as $user){
		?>
			<p><label>Username: &nbsp;<?php echo $user->username; ?></label></p>
			<p><label>Lastname: &nbsp;<?php echo $user->lastname; ?></label></p>
			<p><label>Firstname: &nbsp;<?php echo $user->firstname; ?></label></p>
			<p><label>Middlename: &nbsp;<?php echo $user->middlename; ?></label></p>
			<p><label>Address: &nbsp;<?php echo $user->address; ?></label></p>
			<p><label>Contact Number:<?php echo $user->contact_number; ?></label></p>
			<p><label>Gender: &nbsp;<?php echo $user->gender; ?></label></p>
			<p><label>Marital Status: &nbsp;<?php echo $user->marital_status; ?></label></p>
		<?php } ?>
	</div>
	<div id = "my_button">
		<p><a href = "cashier_editdetails.php" class = "button"><label>Edit Details</label></a></p>
		<p><a href = "cashier_updatepassword.php" class = "button"><label>Edit Password</label></a></p>
	</div>
	
</body>
</html>