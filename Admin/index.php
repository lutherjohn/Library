<?php require_once 'system/init.php';


if (Input::exists()) {
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
				
				if(($user->data()->group)=== '1'){
					Redirect::to('admin_page.php');	
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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Library System</title>
</head>
<body>
	<form action="" method="post">
		<label>Username: <input type="text" name="username"></label>
		<label>Password: <input type="password" name="password"></label>
		<label> <input type="submit" name="submit" value="Log In"></label>
	</form>
	
</body>
</html>
