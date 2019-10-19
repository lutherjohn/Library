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
	<title>Library System | Books</title>
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
	<link rel="stylesheet" type="text/css" href="css/librarian_styles.css">
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script src = "js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		jQuery(function($) {
		var validation_holder;

		$("form#register_form input[name='submit']").click(function() {

		var validation_holder = 0;

		var password1 		= $("form#register_form input[name='password1']").val();
		var password_new 	= $("form#register_form input[name='password_new']").val();
		var password_new2 	= $("form#register_form input[name='password_new2']").val();
		
		
			if(password1 == "") {
				$("span.val_password").html("This field is required.").addClass('validate');
				validation_holder = 1;
			} else {
				$("span.val_password").html("");
			}
			
			if(password_new == "") {
				$("span.val_password1").html("This field is required.").addClass('validate');
				validation_holder = 1;
			} else {
				$("span.val_password1").html("");
			}
			
			if(password_new2 == "") {
				$("span.val_password2").html("This field is required.").addClass('validate');
				validation_holder = 1;
			} else {
				$("span.val_password2").html("");
			}

			if(validation_holder == 1) {
				$("p.validate_msg").slideDown("fast");
				return false;
			}  validation_holder = 0; 
		});

		});
	</script>
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
	
	$success = '';
	$not_match = '';
	$wrong_password = '';
	

	if(Input::exists()){
		$password = Input::get('password1');
		$password3 = Input::get('password_new2');

		
		if(Input::get('password_new') != Input::get('password_new2')){
			$not_match = 'Password not Match';
		}elseif(Hash::make(Input::get('password1'), $user->data()->salt) !== $user->data()->password){
			$wrong_password = 'Your current password is wrong!';
		}else{
			$salt = Hash::salt(32);
			$pass = Hash::make(Input::get('password_new'),$salt);
			
			$user = DB::getInstance()->query("UPDATE users SET password = '{$pass}' , salt = '{$salt}' WHERE username = '{$user->data()->username}'");
			}
		}
	?>
	
		<form action = "" method = "post" id="register_form">
			<fieldset>
				<legend>Password</legend>
					<p><label>Current</label><input type = "password" name = "password1"><span class="val_password"></span></p>
					<p><label>New</label><input type = "password" name = "password_new"><span class="val_password1"></span></p>
					<p><label>Retype-New</label><input type = "password" name = "password_new2"><span class="val_password2"></span></p>
					<p><input type = "submit" name = "submit" value = "Update Changes"></p>
					<p><?php echo $not_match; ?></p>
					<p><?php echo $wrong_password; ?></p>
			</fieldset>	
		</form>
		<div class="clearer"><span></span></div>
		<footer>	
			<div class="copyright">
				Copyright 2015 &#174; All Rights Reserved.
				
			</div>
		</footer>

</body>
</html>