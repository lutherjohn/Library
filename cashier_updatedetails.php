<?php require_once 'system/init.php';

$user = new User();
		
	$librarian_id = Input::get('librarian_id');
	$personnel_id = Input::get('personnel_id');
	$update_username = Input::get('update_username');
	$update_lastname = Input::get('update_lastname');
	$update_firstname = Input::get('update_firstname');
	$update_middlename = Input::get('update_middlename');
	$update_address = Input::get('update_address');
	$update_cn = Input::get('update_cn');
	$update_gender = Input::get('update_gender');
	$update_ms = Input::get('update_ms');



	try{
		$user = DB::getInstance()->query("UPDATE tbl_personnel SET username = '{$update_username}', lastname = '{$update_lastname}', firstname = '{$update_firstname}', middlename ='{$update_middlename}' , address = '{$update_address}', contact_number ='{$update_cn}' ,gender ='{$update_gender}' , marital_status = '{$update_ms}' WHERE p_id = {$personnel_id} ");
		$student_user = DB::getInstance()->query("UPDATE users SET username = '{$update_username}' WHERE id = '{$librarian_id}' ");				
		Redirect::to('cashier_account.php');
	}catch(Exception $e){
		die ($e->getMessage);
	}