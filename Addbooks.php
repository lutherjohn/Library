<?php require_once 'system/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

$book_status = 'Available';
$empty_fields = '';
if (Input::exists()){
	
	if(Input::get('book_category') == "" || Input::get('book_publisher') == ""){
		
		$empty_fields = 'Neither Category or Publisher is Empty';
		
	}else{
		
		try{

		$user->create_books(array(
			'book_isbn' => Input::get('isbn'),
			'book_title' => Input::get('title'),
			'book_author' => Input::get('author'),
			'book_edition' => Input::get('edition'),
			'book_copies' => Input::get('book_copies'),
			'book_status' => $book_status,
			'book_price' =>Input::get('price') ,
			'book_call_number' => Input::get('cn'),
			'bc_id'=>Input::get('book_category'),
			'bp_id'=>Input::get('book_publisher'),
			'book_date_added' =>date('Y-m-d')			
		));

		}catch(Exception $e){
			die($e->getMessage());
		}
		
	}

	
	
}

;?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Library System | Add Books </title>
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
	<link rel="stylesheet" type="text/css" href="css/librarian_styles.css">
	<script type="text/javascript" src="js/jquery-1.9.1.js"> </script>
	<script type="text/javascript" src="js/book_val.js"> </script>
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

	<form action = "" method="post" id="register_form" >
		<fieldset>
			<legend>Add Books Form</legend>
				<p class="validate_msg">Please fix the errors below!</p>
					<p><label for="isbn">ISBN</label>
					 <input type="text" name="isbn"><span class="val_isbn"></span></p>
					<p><label for="title">Title</label> 
					<input type="text" name="title"><span class="val_title"></span></p>
					<p><label for="author">Author</label>
					<input type="text" name="author"><span class="val_author"></span></p>
					<p><label for="edition">Edition</label>
					<input type="text" name="edition"><span class="val_edition"></span></p>
					
					<p><label for="copies">No. Of Copies</label>
					<input type="text" name="book_copies"><span class="val_copies"></span></p>
					
					<p><label for="price">Price </label>
					<input type="text" name="price"><span class="val_price"></span></p>
					<p><label for="cn">Call Number</label> 
					<input type="text" name="cn"><span class="val_cn"></span></p>
					<p><label for="bc">Book Category</label>
							<select name="book_category">
								<option value=""> Book Category</option>
								<?php $user = DB::getInstance()->query("SELECT bc_id, book_category FROM tbl_book_category");
								foreach ($user->results() as $user) {						
								?>		
								<option value=<?php echo $user->bc_id; ?>><?php echo $user->book_category; ?></option>
								<?php } ?>
							</select>
							<span class="val_category"></span></p>							
					<p><label for="bp">Book Publisher</label>
							<select name="book_publisher">
								<option value=""> Book Publisher</option>
								<?php $user = DB::getInstance()->query("SELECT bp_id, book_publisher FROM tbl_book_publisher");
								foreach ($user->results() as $user) {						
								?>		
								<option value=<?php echo $user->bp_id; ?>><?php echo $user->book_publisher; ?></option>
								<?php } ?>
							</select>
							<span class="val_publisher"></span>	</p>
							<p style = "color:solid red;"><?php echo $empty_fields; ?></p>
					<p><input type="submit" name="submit" value="Save"></p>
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