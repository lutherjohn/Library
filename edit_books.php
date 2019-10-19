<?php require_once 'system/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

	$book_update = new User();	
	$book_id = Input::get('book_id');
	$update_isbn = Input::get('update_isbn');
	$update_title = Input::get('update_title');
	$update_author = Input::get('update_author');
	$update_edition = Input::get('update_edition');
	$update_price = Input::get('update_price');
	$update_cn = Input::get('update_cn');

	
if (Input::exists()) {
	$book_update = DB::getInstance()->query("UPDATE tbl_books SET book_isbn = '{$update_isbn}', book_title = '{$update_title}', book_author ='{$update_author}' , book_edition = '{$update_edition}', book_price ='{$update_price}' , book_call_number = '{$update_cn}' WHERE book_id = {$book_id}");
	Redirect::to('books.php');
}
	





?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Library System | Add Books </title>
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
	<link rel="stylesheet" type="text/css" href="css/librarian_styles.css">
	<script type="text/javascript" src="js/jquery-1.9.1.js"> </script>
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
			<li><a href="books.php">Books</a></li>
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
	<div id="underneath">
		<ul>
			<li><a href="Addbooks.php">Add Books</a></li>
			<li><a href="Addpublisher.php">Add Publisher</a></li>
			<!--<li><a href="Addsupplier.php">Add Supplier</a></li>-->
			<li><a href="Addcategory.php">Add Category</a></li>
		</ul>
	</div>

	<form action = "" method="post" id="register_form" >
		<fieldset>
			<legend>Edit Books Form</legend>
			<?php
			$book_id = Input::get('id');
			$user = DB::getInstance()->query("SELECT book_id,book_isbn,book_title,book_author,book_edition, book_status,book_price,book_call_number FROM tbl_books WHERE book_id = {$book_id} ");
			foreach($user->results() as $user){
			?>
					<p><input type="hidden" name="book_id" value = <?php echo $user->book_id; ?> ></p>
					<p><label for="isbn">ISBN</label><input type="text" name="update_isbn" value = <?php echo $user->book_isbn; ?> ></p>
					<p><label for="title">Title</label><input type="text" name="update_title" value = <?php echo $user->book_title; ?>></p>
					<p><label for="author">Author</label>
					<input type="text" name="update_author" value = <?php echo $user->book_author; ?> ></p>
					<p><label for="edition">Edition</label>
					<input type="text" name="update_edition" value = <?php echo $user->book_edition; ?> ></p>
					<p><label for="price">Price </label>
					<input type="text" name="update_price" value = <?php echo $user->book_price; ?> ></p>
					<p><label for="cn">Call Number</label> 
					<input type="text" name="update_cn" value = <?php echo $user->book_call_number; ?> ></p>
			<?php } ?>
					<p><input type="submit" name="submit" value="Update Changes"></p>
		</fieldset>
	</form>
</body>
</html>