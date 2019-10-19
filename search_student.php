<?php
include_once 'system/init.php';
$user = new User();

	try{
		$bdd = new PDO("mysql:host=localhost;dbname=librarysystem","root","");
	}catch(Exception $e){
		die("ERROR :" . $e->getMessage());
	}

	if(isset($_POST['search']) && !empty($_POST['search'])){
	$search = $_POST['search'];
?>

<table cellspacing='0' cellpadding='20' class='table' width='600'>
			<thead>
				<th>Lastname</th>
				<th>Firstname</th>
				<th>Middlename</th>
				<th colspan="3">Options</th>
			</thead>

<?php
$y = $bdd->prepare("SELECT * FROM tbl_student
			WHERE s_lastname LIKE :search LIMIT 5");
			$y->execute(array('search' => '%' . $_POST['search'] . '%'));
			if($y->rowCount()==0){
				echo "<tr>";
				echo "<td colspan = '6'>Sorry but that student has not yet in the database!!!</td>";
				echo "</tr>";
			}
			else{
				while($u=$y->fetch()){
			echo "<tr>";
			echo "<td>" .$u['s_lastname'] . "</td>" ;
			echo "<td>" .$u['s_firstname']. "</td>" ;
			echo "<td>" .$u['s_middlename']. "</td>" ;
			echo "<td><a href=student_book_borrow.php?id=" . $u['s_id'] . " class = 'button'><img src = 'png/borrow.png'></a></td>";
			echo "<td><a href=student_book_return.php?id=" . $u['s_id'] . " class = 'button'><img src = 'png/book_return.png'></a></td>";
			echo "<td><a href=student_book_unreturn.php?id=" . $u['s_id'] . " class = 'button'><img src = 'png/un-return.png'></a></td>";
			echo "</tr>";
		}
	
	}
?>
</table>
<?php
}else{
?>
<table cellspacing='0' cellpadding='20' class='table' width='600'>
			<thead>
				<th>Lastname</th>
				<th>Firstname</th>
				<th>Middlename</th>
				<th colspan="3">Options</th>
			</thead>

<?php
$y = $bdd->prepare("SELECT * FROM tbl_student LIMIT 15");

			if($y->rowCount()==0){
				echo "<tr>";
				echo "<td colspan = '6'>Sorry but that student has not yet in the database!!!</td>";
				echo "</tr>";
			}
			else{
				while($u=$y->fetch()){
			echo "<tr>";
			echo "<td>" .$u['s_lastname'] . "</td>" ;
			echo "<td>" .$u['s_firstname']. "</td>" ;
			echo "<td>" .$u['s_middlename']. "</td>" ;
			echo "<td><a href=student_book_borrow.php?id=" . $u['s_id'] . " class = 'button'><img src = 'png/borrow.png'></a></td>";
			echo "<td><a href=student_book_return.php?id=" . $u['s_id'] . " class = 'button'><img src = 'png/book_return.png'></a></td>";
			echo "<td><a href=student_book_unreturn.php?id=" . $u['s_id'] . " class = 'button'><img src = 'png/un-return.png'></a></td>";
			echo "</tr>";
		}
	
	}
?>
</table>
<?php
}
?>