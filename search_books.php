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

<table cellspacing='0' cellpadding='10' class='table' width='900'>
	<thead>
		<th>Book ISBN</th>
		<th>Book Title</th>
		<th>Book Author</th>
		<th>Book Edition</th>
		<th>Book Status</th>
		<th>Action</th>
	</thead>

<?php
	$y = $bdd->prepare("SELECT * FROM tbl_books 
				WHERE book_title LIKE :search && book_status = 'Available' LIMIT 5");
				$y->execute(array('search' => '%' . $_POST['search'] . '%'));
				if($y->rowCount()==0){
					echo "<tr>";
					echo "<td colspan = '6'>Sorry but that has not yet in the database!!!</td>";
					echo "</tr>";
				}
				else{
					while($u=$y->fetch()){
				echo "<tr>";
				echo "<td>" .$u['book_isbn'] . "</td>" ;
				echo "<td>" .$u['book_title']. "</td>" ;
				echo "<td>" .$u['book_author']. "</td>" ;
				echo "<td>" .$u['book_edition']. "</td>" ;
				echo "<td>" .$u['book_status']. "</td>" ;
				echo "<td><a href=book_reserved.php?id=" . $u['book_id'] . " class = 'button'>reserved</a></td>";
				echo "</tr>";
			}
		
		}
?>
</table>
<?php
}else{
?>
<table cellspacing='0' cellpadding='10' class='table' width='900'>
	<thead>
		<th>Book ISBN</th>
		<th>Book Title</th>
		<th>Book Author</th>
		<th>Book Edition</th>
		<th>Book Status</th>
		<th>Action</th>
	</thead>
<?php
	$y = $bdd->prepare("SELECT * FROM tbl_books 
				WHERE book_status = 'Available' LIMIT 15");
				if($y->rowCount()==0){
					echo "<tr>";
					echo "<td colspan = '6'>Sorry but that has not yet in the database!!!</td>";
					echo "</tr>";
				}
				else{
					while($u=$y->fetch()){
				echo "<tr>";
				echo "<td>" .$u['book_isbn'] . "</td>" ;
				echo "<td>" .$u['book_title']. "</td>" ;
				echo "<td>" .$u['book_author']. "</td>" ;
				echo "<td>" .$u['book_edition']. "</td>" ;
				echo "<td>" .$u['book_status']. "</td>" ;
				echo "<td><a href=book_reserved.php?id=" . $u['book_id'] . " class = 'button'>reserved</a></td>";
				echo "</tr>";
			}
		
		}
?>
</table>	
<?php } ?>