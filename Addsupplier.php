<?php require_once 'system/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}


if (Input::exists()) {

	try{

		$user->create_student(array(
			's_username' => $def_username,
			's_lastname' => Input::get('s_lastname'),
			's_firstname' => Input::get('s_firstname'),
			's_middlename' => Input::get('s_middlename'),
			's_gradeLevelSection' => Input::get('s_gylevel'),
			's_email' =>Input::get('s_email') ,
			's_cp' => Input::get('s_cp'),
			's_gender' =>Input::get('s_gender') ,
			's_month' => Input::get('s_month'),
			's_day' => Input::get('s_day'),
			's_year' => Input::get('s_year'),
			's_address' => Input::get('s_address'),
			's_parent' => Input::get('s_parent'),
			's_parentRelation' => Input::get('s_parentRelation'),
			's_parentCp' =>Input::get('s_parentCp') 			
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
	<title>Library System | Add Books </title>
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
			<li><a href="Addbooks.php">Add Books</a></li>
			<li><a href="Addpublisher.php">Add Publisher</a></li>
			<li><a href="Addsupplier.php">Add Supplier</a></li>
			<li><a href="Addcategory.php">Add Category</a></li>
		</ul>
	</div>

	<form action = "" method="post">
		
	</form>
</body>
</html>