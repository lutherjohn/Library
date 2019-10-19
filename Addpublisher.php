<?php require_once 'system/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}


if (Input::exists()) {

	try{

		$user->create_book_publisher(array(
			'book_publisher' => Input::get('book_publisher'),
			'book_date_publication' => date('Y-m-d')			
		));

	}catch(Exception $e){
		die($e->getMessage());
	}

}

;?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Library System | Add Publisher </title>
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
	<link rel="stylesheet" type="text/css" href="css/librarian_styles.css">
	<link rel='stylesheet' type='text/css' href='css/modal.css' />
	<script type="text/javascript" src="js/jquery-1.9.1.js"> </script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script src = "js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		jQuery(function($) {
		var validation_holder;

		$("form#register_form input[name='submit']").click(function() {

		var validation_holder = 0;

		var book_publisher 	= $("form#register_form input[name='book_publisher']").val();
			
			if(book_publisher == "") {
				$("span.val_book_publisher").html("This field is required.").addClass('validate');
				validation_holder = 1;
			} else {
				$("span.val_book_publisher").html("");
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
			<!-- <li><a href="librarian_reports.php">Reports</a></li> -->
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>
	<br>
	<div id="underneath">
		<ul>
			<li><a href="Addbooks.php">Add Books</a></li>
			<li><a href="Addpublisher.php">Add Publisher</a></li>
			<!--<li><a href="Addsupplier.php">Add Supplier</a></li>-->
			<li><a href="Addcategory.php">Add Category</a></li>
		</ul>
	</div>

	<form action = "" method="post" id="register_form">
		<fieldset>
			<legend>Books Publisher</legend>
						<p class="validate_msg">Please fix the errors below!</p>
						<p><label for="book_publisher">Book Publisher</label>
						<input type="text" name="book_publisher"><span class="val_book_publisher"></span></p>
						<p><input type="submit" name="submit" value="Add Book Publisher"></p>

				<table cellspacing='0' cellpadding='30' class='table' width='700'>
					<thead>
						<th>Publisher</th>
						<th>Date Publish</th>
						<th>Option</th>
					</thead>
					<tr>
					<?php
						$user = DB::getInstance()->query("SELECT bp_id,book_publisher, book_date_publication FROM tbl_book_publisher");
						if ($user->count() == 0) {
							echo "No Publisher Yet!!!";
						}else{
							foreach ($user->results() as $user) {
					?>
						<td><?php echo $user->book_publisher; ?></td>
						<td><?php echo $user->book_date_publication; ?></td>
						<td><a href=Addpublisher.php?id="<?php  echo $user->bp_id;?>" '#myModal'>Edit</a></td>
					</tr>
						<?php } ?>
					<?php } ?>
				</table>
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