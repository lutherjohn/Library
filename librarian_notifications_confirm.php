<?php require_once 'system/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

$due_date = '';
$due_date = date('m-d-Y', strtotime("+3 days"));

$book_id2 = Input::get('id');
if (Input::exists()) {
	
	
	
	$reserved_id = Input::get('reserved_id');
	$stud = Input::get('student_id');
	

		try{
		
		$user->create_book_borrow(array(
			'issue_date' => date('m-d-Y'),
			'due_date' => $due_date,
			'student' => Input::get('student_id'),
			'book' => $book_id2		
		));
		echo "<script>					
				location.href = 'librarian_notifications.php';
			  </script>";
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

?>