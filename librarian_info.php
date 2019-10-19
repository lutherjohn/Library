<?php require_once 'system/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}


if (Input::exists()) {
	
}

;?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Library System | Books</title>
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
	<link rel="stylesheet" type="text/css" href="css/librarian_styles.css">
</head>
<body>
	<nav>
		<ul>
			<li><a href="librarian.php">Home</a></li>
			<li><a href="books.php">Books</a></li>
			<li><a href="librarian_account.php">My Account</a></li>
			<li><a href="librarian_reports.php">Reports</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>

	<div id="underneath">
		<ul>
			<li><a href="librarian_info.php">General Information</a></li>
			<li><a href="#">Username and Password</a></li>
			<li><a href="#">Notify</a></li>
			<li><a href="#">&nbsp;</a></li>
		</ul>
	</div>


	<div id = "user">
	<fieldset>
		<legend>General Information</legend>
			<?php
			$user = DB::getInstance()->query("SELECT * FROM tbl_personnel WHERE username = '{$user->data()->username}'");
			foreach($user->results() as $user){
			?>
			<p> <label name = "user_account">
			Name:
			<?php  echo $user->lastname; ?>, 
			<?php  echo $user->firstname; ?> 
			&nbsp; <?php  echo substr($user->middlename,0,1); ?>.</label></p>
			<p> <label name = "user_account2">
			Marital Status: <?php  echo $user->marital_status; ?><br>
			Contact Number: <?php  echo $user->contact_number; ?> <br>
			Gender: <?php  echo $user->gender; ?><br>
			Address: <?php  echo $user->address; ?></label></p>
			<?php } ?>
	</fieldset>
		
	</div>
	

</body>
</html>