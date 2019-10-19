<?php require_once 'system/init.php';
$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

$success = '';
$due_date = '';
$due_date = date('m-d-Y', strtotime("+3 days"));
$book_exist = '';
$book_id = Input::get('id');
if (Input::exists()) {
	
	//$book_id = Input::get('book_id');
	$reserved_id = Input::get('reserved_id');
	$stud = Input::get('student');
	
	
	$count_books = DB::getInstance()->query("SELECT tbl_book_reserved.br_id,tbl_student.s_id,tbl_books.book_id FROM tbl_book_reserved 
	INNER JOIN tbl_books ON tbl_book_reserved.book_id = tbl_books.book_id 
	INNER JOIN tbl_student ON tbl_book_reserved.student_id = tbl_student.s_id
	WHERE tbl_books.book_id = {$book_id} && tbl_student.s_id = {$stud} ");
	
	if($count_books->count()){
		$book_exist = 'You Already Reserved This Book';
	
	}else{
		
		try{

		$user->create_book_reserved(array(
			'student_id' =>Input::get('student') ,
			'book_id' => Input::get('book_id'),
			'date_reserved' => date('m-d-Y')		
		));
		echo "<script>					
				location.href = 'student_book_reservation.php';
			  </script>";
		
		}catch(Exception $e){
			die($e->getMessage());
		}
	}
	
	
	
}
		
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Library System | Librarian</title>
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
	<link rel="stylesheet" type="text/css" href="css/librarian_styles.css">
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
			$username = '';
			$user = DB::getInstance()->query("SELECT s_username,s_lastname, s_firstname, s_middlename FROM tbl_student WHERE s_username = '{$user->data()->username}'");
			foreach($user->results() as $user){
				$username = $user->s_username;
			?>
			<li>
				<?php  echo $user->s_firstname; ?> &nbsp; <?php  echo substr($user->s_middlename,0,1); ?>
			</li>
			<?php } ?>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>	
	<br>

	<form action = "" method = "post">
		<fieldset>
			<legend>Issue Details</legend>
			<table>
				<tr>
					<td>Issue Date: &nbsp; <?php echo date('m-d-Y') ?></td>
				</tr>
			
				<tr>
					<td>Due Date: &nbsp; <?php echo $due_date; ?> </td>
				</tr>
			</table>
		</fieldset>
		<?php
		
		$user = DB::getInstance()->query("SELECT s_id,s_lastname, s_firstname, s_middlename,s_gradeLevelSection FROM tbl_student WHERE s_username = '{$username}'");
		foreach($user->results() as $user){
		?>
		<fieldset>
			<legend>Student Details</legend>
				<table>
					<tr>
						<td><input type = "hidden" name = "student" value =<?php echo $user->s_id; ?> ></td>
					</tr>
					<tr>
						<td>Student Name: &nbsp; <?php  echo $user->s_lastname; ?>,<?php  echo $user->s_firstname; ?> &nbsp; <?php  echo substr($user->s_middlename,0,1); ?></td>
					</tr>
					<tr>
						<td>Grade Level & Section: &nbsp; <?php echo $user->s_gradeLevelSection;?></td>
					</tr>
					<?php } ?>
				</table>						
		</fieldset>
		
		<fieldset>
			<legend>Book Details</legend>
				<table>
				<?php
				
				$user = DB::getInstance()->query("SELECT book_id, book_isbn,book_title,book_author,book_edition FROM tbl_books WHERE book_id ={$book_id} ");
				foreach($user->results() as $user){
				?>
					<tr>
						<td><input type ="hidden" name = "book_id" value = <?php echo $user->book_id; ?> ></td>
					</tr>
					<tr>
						<td>Book ISBN: &nbsp;<?php echo $user->book_isbn;?></td>
						<td>Book Title: &nbsp;<?php echo $user->book_title;?></td>
						<td>Book Author: &nbsp;<?php echo $user->book_author;?></td>
						<td>Book Edition: &nbsp;<?php echo $user->book_edition;?></td>
				<?php } ?>		
					</tr>
				</table>
		</fieldset>
		<table>
			<tr>
				<td><input type = "submit" name = "submit" value = "RESERVED"></td>
				<td><?php echo $book_exist;?></td>
			</tr>
		</table>
	</form>
	<br>
	<div class="clearer"><span></span></div>
	<footer>	
		<div class="copyright">
			Copyright 2015 &#174; All Rights Reserved.
			
		</div>
	</footer>
</body>
</html>