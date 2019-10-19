<?php require_once 'system/init.php';


if (Input::exists()) {
	if(Token::check(Input::get('token'))){
			$username = Input::get('username');
			$password = Input::get('password');
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array('required' => true),
				'password' => array('required' => true)
			));
			if($validation->passed()){
				$user = new User();
				
				$remember = (Input::get('remember') === 'on') ? true : false;
				$login = $user->login(Input::get('username'), Input::get('password'), $remember);
				if($login){
					
					if(($user->data()->group)=== '2'){
						Redirect::to('librarian.php');	
					}elseif (($user->data()->group)=== '3') {
						Redirect::to('cashier.php');
					}elseif (($user->data()->group)=== '4') {
						Redirect::to('student.php');
					}
					else{
						Redirect::to('index.php');
					}
				}
				else{
							
				}
			}
			else{
				foreach($validation->errors() as $error){
					echo $error, '<br>';
				}
			}
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>CLS Corpus Christi School - Log In</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
		<style>
			@import url(http://fonts.googleapis.com/css?family=Ubuntu:400,700);
			body {
				background: #563c55 url(images/blurred.jpg) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
		</style>
		<script src="js/modernizr.custom.63321.js"></script>
</head>
<body>
	<div class="container">
		<header>
			<img src = "images/header-cls.png" style ="height:122px; width:915px;">
			<h2><a href="register.php">Don't Have Account Yet? </a></h2>
		</header>
		
		<section class="main">
			<form action="" method="post" class="form-3">
				<p class="clearfix">
					<label for="login">Username</label>
					<input type="text" name="username" id="login" placeholder="Username">
				</p>
				<p class="clearfix">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" placeholder="Password">
				</p>
				<p class="clearfix"> 
					<input type = "checkbox" name = "remember" id="remember">
					<label for="remember">Remember me</label>
				</p>
				<p class="clearfix">
					<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
					<input type="submit" name="submit" value="Log in" class="btnLogin">
				</p>
			</form>
		</section>
	</div>
	
</body>
</html>