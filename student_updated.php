<?php require_once 'system/init.php';

	$user = new User();

	$user_id = Input::get('user_id');
	$s_id = Input::get('s_id');
	$update_username = Input::get('update_username');
	$update_lastname = Input::get('update_lastname');
	$update_firstname = Input::get('update_firstname');
	$update_middlename = Input::get('update_middlename');
	$update_address = Input::get('update_address');
	$update_cn = Input::get('update_cn');
	$update_gender = Input::get('update_gender');
	
	try{
		$user = DB::getInstance()->query("UPDATE tbl_student SET s_username = '{$update_username}', s_lastname = '{$update_lastname}',s_firstname = '{$update_firstname}', s_middlename = '{$update_middlename}', s_address = '{$update_address}', s_cp = '{$update_cn}', s_gender = '{$update_gender}' WHERE s_id = {$s_id} ");
		$student_user = DB::getInstance()->query("UPDATE users SET username = '{$update_username}' WHERE id = '{$user_id}' ");	
		Redirect::to('student_account.php');
	}catch(Exception $e){
		die ($e->getMessage);
	}