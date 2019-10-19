<?php require_once 'system/init.php';


$user = new User();

if(Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
}

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

$success = '';

$due_date = '';
$due_date = date('m-d-Y', strtotime("+3 days"));
$bb_id = '';
$book_exist = '';
$book = '';
$stud = '';
$copies = '';
$book_copies = '';

if (Input::exists()){
		$book = Input::get('book_borrow');
		$stud = Input::get('student');

				$count_books = DB::getInstance()->query("SELECT tbl_book_borrow.bb_id,tbl_student.s_id,tbl_books.book_id FROM tbl_book_borrow 
				INNER JOIN tbl_books ON tbl_book_borrow.book = tbl_books.book_id 
				INNER JOIN tbl_student ON tbl_book_borrow.student = tbl_student.s_id
				WHERE tbl_books.book_id = {$book} && tbl_student.s_id = {$stud} ");
				
				if($count_books->count()){
					$book_exist = 'Book Already Borrow';
				
				}else{
					try{
						$user->create_book_borrow(array(
							'issue_date' => date('m-d-Y'),
							'due_date' => $due_date,
							'student' => Input::get('student'),
							'book' => Input::get('book_borrow')			
							));
							$success = 'Book Successfully Save';
						}catch(Exception $e){
							die($e->getMessage());
					}
					
					$user_update = DB::getInstance()->query("SELECT book_copies FROM tbl_books WHERE book_id = {$book}");
					foreach($user_update->results() as $user_update){
						$currentstock = $user_update->book_copies;
					}			

					$book_copies = $currentstock - 1 ;

					$user_update = DB::getInstance()->query("UPDATE tbl_books SET book_copies = '{$book_copies}' WHERE book_id = {$book} ");

				
					if($book_copies == 0){
						
						try{
						$user_update = DB::getInstance()->query("UPDATE tbl_books SET book_status = 'Not Available' WHERE book_id = {$book} ");
					
						}catch(Exception $e){
							die($e->getMessage());
						}
						
					}
				
				
				}

				
		
		/**
		
		**/
	
	
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
		$get_id = Input::get('id');
		$user = DB::getInstance()->query("SELECT s_id,s_lastname, s_firstname, s_middlename,s_gradeLevelSection FROM tbl_student WHERE s_id = '{$get_id}'");
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
				<tr>
					<td>Book Title: &nbsp;
					<select name = "book_borrow">
						<option value ="none">Book Title</option>
						<?php
						$user = DB::getInstance()->query("SELECT * FROM tbl_books WHERE book_status = 'Available' ");
						foreach($user->results() as $user){
						?>	
						<option value = <?php echo $user->book_id; ?> ><?php echo $user->book_title;?></option>
						<?php } ?>	
					</select>
					
					</td>
					
				</tr>
				<tr>
					<td>
						<?php echo $book_exist; ?>
						<?php echo $success; ?>
						<?php echo $copies; ?>
					</td>
				</tr>
			</table>
		</fieldset>
		<table>
			<tr>
				<td><p><input type = "submit" name = "submit" value = "SAVE"><p></td>
			</tr>
		</table>
	</form>
</body>
</html>