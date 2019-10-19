<?php require_once 'system/init.php';
$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}



$student_id = Input::get('id');
if (Input::exists()) {
	
	$book_return = new User();
	$book_id = Input::get('book_id');
	$bb_id = Input::get('bb_id');
	
	$stmt = DB::getInstance()->query("SELECT book_copies FROM tbl_books WHERE book_id = {$book_id} ");
		foreach($stmt->results() as $stmt){
			$book_count = $stmt->book_copies;
		}
		
		$book_copies = $book_count + 1 ;
	
	$book_return = DB::getInstance()->query("UPDATE tbl_books SET book_copies = '{$book_copies}' WHERE book_id = {$book_id}");
	$book_return = DB::getInstance()->query("DELETE FROM tbl_book_borrow WHERE bb_id = {$bb_id} ");




}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Refresh" content="5">
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
	
	<table>
	
		<tr>
		<?php
		
		$user = DB::getInstance()->query("SELECT s_lastname, s_firstname, s_middlename FROM tbl_student WHERE s_id = '{$student_id}'");
		foreach($user->results() as $user){
		?>
			<td>Student Name: &nbsp; <?php  echo $user->s_lastname; ?>,<?php  echo $user->s_firstname; ?> &nbsp; <?php  echo substr($user->s_middlename,0,1); ?></td>
		</tr>
	<?php } ?>	
	</table>
	
	<br>
	<form action = "" method = "post">
		<table>
			<thead>
				<th>Book ISBN</th>
				<th>Book Title</th>
				<th>Book Author</th>
			</thead>
			
			<tr>
			<?php
			$book_re = '';
			$book_test = '';
			$user = DB::getInstance()->query("SELECT tbl_book_borrow.bb_id, tbl_student.s_id,tbl_books.book_id,tbl_books.book_isbn,tbl_books.book_title, tbl_books.book_author FROM tbl_book_borrow
			INNER JOIN tbl_student ON tbl_book_borrow.student = tbl_student.s_id
			INNER JOIN tbl_books ON tbl_book_borrow.book = tbl_books.book_id
			WHERE tbl_student.s_id = '{$student_id}'");
			if($user->count() == 0){
				echo '<td colspan = "6">No book Return for now </td>';
			}
			foreach($user->results() as $user){ 
			?>	
				<td><input type = "hidden" name = "bb_id" value = <?php echo  $user->bb_id;?> >
			</tr>
			<tr>
				<td><input type = "checkbox" name = "book_id" value = <?php echo $user->book_id; ?> >&nbsp;
				<?php echo $user->book_isbn; ?></td>
				<td><?php echo $user->book_title; ?></td>
				<td><?php echo $user->book_author; ?></td>
			</tr>
		
			<tr>
				<td><input type= "submit" name = "submit" value = "Return book"></td>
			</tr>
		<?php } ?>			
		</table>
	</form>
	

	<div class="clearer"><span></span></div>
	<footer>	
		<div class="copyright">
			Copyright 2015 &#174; All Rights Reserved.
			
		</div>
	</footer>
</body>
</html>