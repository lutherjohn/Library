<?php require_once 'system/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

if (Input::exists()) {
	
	

	try{

		$user->create_personnel(array(
			'username' => Input::get('username'),
			'lastname' => Input::get('lname'),
			'firstname' => Input::get('fname'),
			'middlename' => Input::get('mid_name'),
			'address'=> Input::get('address'),
			'contact_number' => Input::get('cp'),
			'gender' => Input::get('gender'),
			'marital_status' => Input::get('m_status')
		));

	}catch(Exception $e){
		die($e->getMessage());
	}


$salt = Hash::salt(32);
	try{

		$user->create_users(array(
			'username' => Input::get('username'),
			'password' => Hash::make(Input::get('password'), $salt),
			'salt' => $salt,
			'joined' => date('Y-m-d'),
			'group' => Input::get('group')
			
		));
								
	}catch(Exception $e){
		die($e->getMessage());
	}
	
}

//echo date('Y-m-d');
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
		<br>
		<label>Lastname: <input type="text" name="lname"></label>
		<label>Firstname: <input type="text" name="fname"></label>
		<label>Middlename: <input type="text" name="mid_name"></label>
		<br>
		<label>Address: <input type="text" name="address"></label>
		<label>Contact Number: <input type="text" name="cp"></label>
		<br>
		<label>Gender:
		<select name="gender">
			<option value="none">&larr; Select</option>
			<option value="Male">Male</option>
			<option value="Female">Female</option>
		</select>
		</label>

		<label>Marital Status:
		<select name="m_status">
			<option value="none">&larr; Select</option>
			<option value="Single">Single</option>
			<option value="Married">Married</option>
			<option value="Widow">Widow</option>
			<option value="Divorced">Divorced</option>
		</select>
		</label>
		<label>Userlevel:
		<select name="group">
			<option value="none">&larr; Select</option>
			<?php
			$userlevel = new User();

			$userlevel = DB::getInstance()->query("SELECT id, name FROM groups");
			foreach ($userlevel->results() as $userlevel) {			
			?>
			<option value="<?php echo $userlevel->id; ?>"><?php echo $userlevel->name; ?></option>
			<?php }?>
		</select>
		</label>
		<label> <input type="submit" name="submit" value="Save"></label>
	</form>
	<a href = "admin_page.php"><p><label>Back</label></p></a>
</body>
</html>
