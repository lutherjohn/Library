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
<html lang = "en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Refresh" content="5">
	<title>Library System | Librarian</title>
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

	<?php
	$user = DB::getInstance()->query("SELECT lastname, firstname, middlename FROM tbl_personnel WHERE username = '{$cashier_account}'");
	foreach($user->results() as $user){
	?>
	<p>Logged in as: 
	<?php  echo $user->lastname; ?>, 
	<?php  echo $user->firstname; ?> 
	&nbsp; <?php  echo substr($user->middlename,0,1); ?>.</p>
	<?php } ?>
	
	<br>
	<article>
		<section>
			<form action = "" method = "post">
				<table cellspacing='8' cellpadding='10' class='table' width='700'>
					<thead>
						<th>Student Name</th>
						<th>Book ISBN</th>
						<th>Book Title</th>
						<th>Book Price</th>
						<th>Action</th>
					</thead>
					<tr>
					<?php
					$test = '';
					$user = DB::getInstance()->query("SELECT DISTINCT tbl_student.s_id, 
					tbl_student.s_lastname, tbl_student.s_firstname, tbl_student.s_middlename, 
					tbl_books.book_id, tbl_books.book_isbn, tbl_books.book_title, tbl_books.book_price FROM tbl_book_unreturn
					INNER JOIN tbl_student ON tbl_book_unreturn.student_id = tbl_student.s_id
					INNER JOIN tbl_books ON tbl_book_unreturn.book_id = tbl_books.book_id");
					if($user->count() == 0){
						echo '<td colspan = "7">No Notifications for Now.</td>';
					}
					foreach($user->results() as $user){
						$test = $user->s_lastname;
						$test2 = $user->s_firstname;
						$test3 = $user->s_middlename;
					?>
						<td><input type = "hidden" name = "student_id" value = <?php echo $user->s_id;?> ></td>
						<td><input type = "hidden" name = "book_id" value =  ></td>
					</tr>
						<td><?php echo $test;?> &nbsp; <?php echo $test2;?> &nbsp; <?php echo $test3;?></td>
						<td><?php echo $user->book_isbn;?></td>
						<td><?php echo $user->book_title;?></td>
						<td><?php echo $user->book_price;?></td>
						<td><a href=book_unreturn.php?id="<?php echo $user->book_id;?>" class ="btn_paid"> Paid</a></td>
					</tr>
					<?php } ?>			
				</table>
			</form>
		</section>
	</article>
	<div class="clearer"><span></span></div>
	<footer>	
		<div class="copyright">
			Copyright 2015 &#174; All Rights Reserved.
			
		</div>
	</footer>
</body>
</html>