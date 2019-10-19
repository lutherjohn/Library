<?php require_once 'system/init.php';
$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Refresh" content="5">
	<title>Library System | Books Report</title>
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
			<li><a href="librarian.php">Home</a></li>
			<li><a href="books.php">Transaction</a></li>
			<li><a href="librarian_account.php">My Account</a></li>
			<li id="notification_li">
				<!-- <span id="notification_count">3</span> -->
				<a href="librarian_notifications.php">Notifications</a>
				<!--
				<div id="notificationContainer">
					<div id="notificationTitle">Notifications</div>
					<div id="notificationsBody" class="notifications">
					</div>
					<div id="notificationFooter"><a href="#">See All</a></div>
				</div>
				-->
			</li>
			<li><a href="librarian_reports.php">Reports</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>
	<br>
	
	<?php
	$user = DB::getInstance()->query("SELECT lastname, firstname, middlename FROM tbl_personnel WHERE username = '{$user->data()->username}'");
	foreach($user->results() as $user){
	?>
	<p>Hello <?php  echo $user->lastname; ?>, 
	<?php  echo $user->firstname; ?> 
	&nbsp; <?php  echo substr($user->middlename,0,1); ?>.</p>
	<?php } ?>
	<div class="clearer"><span></span></div>
	<footer>	
		<div class="copyright">
			Copyright 2015 &#174; All Rights Reserved.
			
		</div>
	</footer>
	
</body>
</html>