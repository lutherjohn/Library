<?php require_once 'system/init.php';
$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Library System | ADMIN</title>
</head>
<body>
	<header>Admin Dashboard</header>
	<nav>
		<ul>
			<li><a href="admin_add_personnel.php">Personnel</li>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>
	
	<?php
	$user = DB::getInstance()->query("SELECT lastname, firstname, middlename FROM tbl_personnel WHERE username = '{$user->data()->username}'");
	foreach($user->results() as $user){
	?>
	<p>Hello <?php  echo $user->lastname; ?>, <?php  echo $user->firstname; ?> &nbsp; <?php  echo substr($user->middlename,0,1); ?>.</p>
	<?php } ?>
</body>
</html>
