<?php require_once 'system/init.php';
$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

$user = DB::getInstance()->query("SELECT id, username FROM users WHERE username = '{$user->data()->username}' ");
foreach($user->results() as $user){
	$librarian_id = $user->id;
	$librarian_account = $user->username;
}



$success = '';
$due_date = '';
$due_date = date('m-d-Y', strtotime("+3 days"));
$book_exist = '';

$book_id2 = Input::get('book_id');
$reserved_id = Input::get('reserved_id');
$stud = Input::get('student_id');

if (Input::exists()) {
	$count_books = DB::getInstance()->query("SELECT tbl_book_borrow.bb_id,tbl_student.s_id,tbl_books.book_id FROM tbl_book_borrow 
	INNER JOIN tbl_books ON tbl_book_borrow.book = tbl_books.book_id 
	INNER JOIN tbl_student ON tbl_book_borrow.student = tbl_student.s_id
	WHERE tbl_books.book_id = {$book_id2} && tbl_student.s_id = {$stud} ");
	
	if($count_books->count()){
		$book_exist = 'You Already Confirm This Book';
	
	}else{
		
		try{
		$user_update = new User();
		$user_update->create_book_borrow(array(
			'issue_date' => date('m-d-Y'),
			'due_date' => $due_date,
			'student' => Input::get('student_id'),
			'book' => Input::get('book_id')			
		));
		$success = 'Book Successfully Confirm';
		}catch(Exception $e){
			die($e->getMessage());
		}
	
		$stmt = DB::getInstance()->query("SELECT book_copies FROM tbl_books WHERE book_id = {$book_id2} ");
			foreach($stmt->results() as $stmt){
				$book_count = $stmt->book_copies;
			}
			
			$book_copies = $book_count - 1 ;
				
			$user_update = DB::getInstance()->query("UPDATE tbl_books SET book_copies = '{$book_copies}' WHERE book_id = {$book_id2} ");
			$user_update = DB::getInstance()->query("DELETE FROM tbl_book_reserved WHERE br_id = {$reserved_id} ");
		
		if($book_copies == 0){
							
			try{
			$user_update = DB::getInstance()->query("UPDATE tbl_books SET book_status = 'Not Available' WHERE book_id = {$book_id2} ");
		
			}catch(Exception $e){
				die($e->getMessage());
			}
			
		}
		
	}
		
	
}

?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Refresh" content="15">
	<title>Library System | Notifications</title>
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
	<link rel="stylesheet" type="text/css" href="css/librarian_styles.css">
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script src = "js/jquery-1.11.1.min.js"></script>
	<script>
	$(document).ready(function(){
				$("#search").keyup(function(){
					var search = $("#search").val();
					$.ajax({
						type:"POST",
						url:"search_student.php",
						data:{search:search},
						success:function(res){
							$("#student_search").html(res);
						}
						
					});
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
	<?php
	$user = DB::getInstance()->query("SELECT lastname, firstname, middlename FROM tbl_personnel WHERE username = '{$librarian_account}'");
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
				<table cellspacing = "3" cellpadding = "6">
					<thead>
						<th>Name</th>
						<th>ISBN</th>
						<th>Title</th>
					</thead>
					
					<tr>
					<?php
					$user = DB::getInstance()->query("SELECT tbl_book_reserved.br_id, tbl_student.s_id, tbl_student.s_lastname, tbl_student.s_firstname, tbl_student.s_middlename, tbl_books.book_id, tbl_books.book_isbn, tbl_books.book_title FROM tbl_book_reserved
					INNER JOIN tbl_student ON tbl_book_reserved.student_id = tbl_student.s_id
					INNER JOIN tbl_books ON tbl_book_reserved.book_id = tbl_books.book_id");
					if($user->count() == 0){
						echo '<td colspan = "5">No Notifications for now.</td>';
					}
					foreach($user->results() as $user){
					?>					
						<td>
							<input type = "hidden" name = "reserved_id" value = <?php echo $user->br_id; ?> >
							<input type = "hidden" name = "student_id" value = <?php echo $user->s_id; ?> >
						</td>
					</tr>
					<tr>
						<td><input type = "checkbox" name = "book_id" value = <?php echo $user->book_id; ?> >
						<?php echo $user->s_lastname; ?>, <?php echo $user->s_firstname; ?> &nbsp; <?php echo substr($user->s_middlename,0,1); ?></td>
						<td><?php echo $user->book_isbn; ?></td>
						<td><?php echo $user->book_title; ?></td>
					</tr>
					
					
					<?php } ?>
					
					<tr>
						<td><input type = "submit" name = "submit" value = "Confirm"></td>
					</tr>
					<tr>
						<td><?php echo $success; ?></td>
						<td><?php echo $book_exist;?></td>
					</tr>					
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