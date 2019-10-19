<?php require_once 'system/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
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
			<li><a href="student.php">Dashboard</a></li>
			<!-- <li id="notification_li">
				<span id="notification_count">3</span> 
				<a href="student_notifications.php">Notifications</a>

				<div id="notificationContainer">
					<div id="notificationTitle">Notifications</div>
					<div id="notificationsBody" class="notifications">
					</div>
					<div id="notificationFooter"><a href="#">See All</a></div>
				</div>
				
			</li>-->
			<li><a href="student_account.php">My Account</a></li>
			<?php
			$user = DB::getInstance()->query("SELECT s_username,s_lastname, s_firstname, s_middlename FROM tbl_student WHERE s_username = '{$user->data()->username}'");
			foreach($user->results() as $user){
				$student = $user->s_username;
			?>
			<li>
				<a href="#"><?php  echo $user->s_firstname; ?> &nbsp; <?php  echo substr($user->s_middlename,0,1); ?></a>
			</li>
			<?php } ?>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>
	<br>
	
	<div>
		<form action = "student_updated.php" method = "post">		
		<?php
		$user = DB::getInstance()->query("SELECT id , username FROM users WHERE username = '{$student}' ");
			foreach($user->results() as $user){
				$id = $user->id;
			
			$user = DB::getInstance()->query("SELECT * FROM tbl_student WHERE s_username = '{$student}'");
				foreach($user->results() as $user){
			?>
				<p><label><input type = "hidden" name = "user_id" value =<?php echo $id; ?>> </label></p>
				<p><label><input type = "hidden" name = "s_id" value =<?php echo $user->s_id; ?>> </label></p>
				<p><label>Username: &nbsp;<input type = "text" name = "update_username" value =<?php echo $user->s_username; ?>> </label></p>
				<p><label>Lastname: &nbsp; <input type = "text" name = "update_lastname" value =<?php echo $user->s_lastname; ?> ></label></p>
				<p><label>Firstname: &nbsp;<input type = "text" name = "update_firstname" value =<?php echo $user->s_firstname; ?> ></label></p>
				<p><label>Middlename: &nbsp;<input type = "text" name = "update_middlename" value =<?php echo $user->s_middlename; ?> ></label></p>
				<p><label>Address: &nbsp; <input type = "text" name = "update_address" value =<?php echo $user->s_address; ?> ></label></p>
				<p><label>Contact Number:<input type = "text" name = "update_cn" &nbsp; value =<?php echo $user->s_cp; ?> ></label></p>
				<p><label>Gender: &nbsp; <input type = "text" name = "update_gender" value =<?php echo $user->s_gender; ?> ></label></p>
			<?php } ?>
		<?php } ?>
			<p><label><input type = "submit" name = "submit" value = "Update Changes"></label></p>
		</form>
	</div>
	<div>
		<p><a href = "student_password.php" class = "button"><label>Update Password</label></a></p>
	</div>
	
</body>
</html>