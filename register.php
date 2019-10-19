<?php require_once 'system/init.php';

$user = new User();

$check_username = '';
$username_taken = '';
$check_username = Input::get('s_username');
if (Input::exists()){
	
	
	$username_check = DB::getInstance()->query("SELECT username FROM users WHERE username = '{$check_username}' ");
	
	if($username_check->count() < 1){
		
		try{

		$user->create_student(array(
			's_username' => Input::get('s_username'),
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


		$salt = Hash::salt(32);
		$password = Input::get('s_password');
		try{

			$user->create_users(array(
				'username' => Input::get('s_username'),
				'password' => Hash::make($password, $salt),
				'salt' => $salt,
				'joined' => date('Y-m-d'),
				'group' => 4
				
			));
									
		}catch(Exception $e){
				die($e->getMessage());
			}
		
	}else{
		
		$username_taken = 'Username Already taken';
		
	}

	
	
}

;?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>CLS Corpus Christi School - Student Registration</title>
	<link rel="stylesheet" type="text/css" href="css/librarian_styles.css">
	<link href= "images/Corpus-Logo1.png" rel="icon" type="image">
	<script type="text/javascript" src="js/jquery-1.9.1.js"> </script>
	<script type="text/javascript" src="js/script.js"></script>
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
			<li><a href="register.php">Register</a></li>
			<li><a href="index.php">Log in</a></li>
		</ul>
	</nav>
	<br>
	<p class="reg">Registration</p>

	<form action = "" method="post" id="register_form">
		<p class="validate_msg">Please fix the errors below!</p>

		<p>
			<label for="username">Username</label>
			<input type="text" name="s_username" id = "username" ><?php echo $username_taken; ?>
			<span class="val_username"></span>
		</p> 
		
		<p><label for="password">Password</label>
		<input type="password" name="s_password"><span class="val_password"></span></p> 
		
		<p><label for="lastname">Lastname</label>
		<input type="text" name="s_lastname"><span class="val_lname"></span></p> 
		<p><label for="fistname">Fistname</label>
		<input type="text" name="s_firstname"><span class="val_fname"></span></p>
		<p><label for="middlename">Middlename</label>
		<input type="text" name="s_middlename"><span class="val_mname"></span></p>
		<p><label for="grade">Grade / Year Level</label> 
		<input type="text" name="s_gylevel"><span class="val_grade"></span></p>
		<p><label for="email">Email Address</label>
		<input type="text" name="s_email"><span class="val_email"></span></p>
		<p><label for="cp">Contact Number</label> 
		<input type="text" name="s_cp"><span class="val_cp"></span></p>


		<p><label for="gender">Gender</label>
		<input name="s_gender" type="radio" value="Male">Male
		<input name="s_gender" type="radio" value="Female">Female
		<span class="val_gen"></span> </p>

		<p><label for="birth">Birth Date</label>
		<select name="s_month">
		<option value="">Month</option>
		<?php 
			$months = array('1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'June', '7' => 'July ', '8' => 'Aug', '9' => 'Sept', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
			foreach($months as $m => $month){
		?>
		<option value="<?php echo $m; ?>"><?php echo $month; ?></option>
		<?php } ?>
		</select>


		<select name="s_day">
		<option value="">Day</option>
		<?php for($day = 1; $day < 32; $day++){ ?>
		<option value="<?php echo $day; ?>"><?php echo $day; ?></option>
		<?php } ?>
		</select>


		<select name="s_year">
		<option value="">Year</option>
		<?php 
			$year = date("Y");
			for($j = $year; $j > 1980; $j--){ 
		?>
		<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
		<?php } ?>
		</select>
		<span class="val_bday"></span> </p>


		<p><label for="address">Address</label>
		<input type="text" name="s_address"><span class="val_address"></span></p>
		<aside>
			<fieldset>
				<legend>In case of Emergency:</legend>
				<p><label for="pname">Parents Name</label>
				<input type="text" name="s_parent"><br>
				<span class="val_pname"></span></p>
				<p><label for="relationship">Relationship</label>
				<input type="text" name="s_parentRelation"><br>
				<span class="val_relationship"></span></p>
				<p><label for="parent_cp">Parents Contact No</label>
				<input type="text" name="s_parentCp"><br>
				<span class="val_pcp"></span></p>
			</fieldset>
		</aside>
			
		<input type="submit" name="submit" value="Register">
	</form>
</body>
</html>