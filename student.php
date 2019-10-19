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
	<title>CLS Corpus Christi School - Student</title>
	<link rel="stylesheet" type="text/css" href="css/librarian_styles.css">
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
	<script src = "js/jquery-1.11.1.min.js"></script>
	<script>
	$(document).ready(function(){
				$("#search").keyup(function(){
					var search = $("#search").val();
					$.ajax({
						type:"POST",
						url:"search_books.php",
						data:{search:search},
						success:function(res){
							$("#student_search").html(res);
						}
						
					});
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
				<!--
				<div id="notificationContainer">
					<div id="notificationTitle">Notifications</div>
					<div id="notificationsBody" class="notifications">
					</div>
					<div id="notificationFooter"><a href="#">See All</a></div>
				</div>
				
			</li> -->
			<li><a href="student_account.php">My Account</a></li>
			<?php
			$user = DB::getInstance()->query("SELECT s_id,s_lastname, s_firstname, s_middlename FROM tbl_student WHERE s_username = '{$student_account}'");
			foreach($user->results() as $user){
				$student_id = $user->s_id;
			?>
			<li>
				<a href="#"><?php  echo $user->s_firstname; ?> &nbsp; <?php  echo substr($user->s_middlename,0,1); ?></a>
			</li>
			<?php } ?>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>	
	<br>
	<form action = "search_books.php" method="post">
		<label><input type="text" name="search" placeholder = "Search Book Title" id="search" /> </label>
	</form>

	<article>
		<section>
			<div id = "student_search" style = "margin-left:6px; width:99%; backgroud-color:white;">

	
			</div>
		</section>
	</article>
	<br>
	<br>
	<br>
	<div class="clearer">
		<span></span>
	</div>
	
	<br>
	<div class="clearer"><span></span></div>
	<footer>	
		<div class="copyright">
			Copyright 2015 &#174; All Rights Reserved.
			
		</div>
	</footer>
</body>
</html>