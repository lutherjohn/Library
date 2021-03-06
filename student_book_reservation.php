<?php require_once 'system/init.php';
$user = new User();

if(Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
}

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

$user = DB::getInstance()->query("SELECT id, username FROM users WHERE username = '{$user->data()->username}' ");
foreach($user->results() as $user){
	$s_id = $user->id;
	$student_account = $user->username;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>ALS Corpus Christi School - Student Registration</title>
	<link rel="stylesheet" type="text/css" href="css/librarian_styles.css">
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
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
			<li><a href="student.php">Dashboard</a></li>
			<li id="notification_li">
				<!-- <span id="notification_count">3</span> -->
				<a href="student_notifications.php">Notifications</a>
				<!--
				<div id="notificationContainer">
					<div id="notificationTitle">Notifications</div>
					<div id="notificationsBody" class="notifications">
					</div>
					<div id="notificationFooter"><a href="#">See All</a></div>
				</div>
				-->
			</li>
			<li><a href="student_account.php">My Account</a></li>
			<?php
			$user = DB::getInstance()->query("SELECT s_lastname, s_firstname, s_middlename FROM tbl_student WHERE s_username = '{$student_account}'");
			foreach($user->results() as $user){
			?>
			<li>
				<?php  echo $user->s_firstname; ?> &nbsp; <?php  echo substr($user->s_middlename,0,1); ?>
			</li>
			<?php } ?>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>	
	<br>
	
	<p><label>Book Successfully Reserved. You have 3 Days to go to Librarian to borrow it</label></p>
</body>
</html>