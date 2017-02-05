<?php

	session_start();

	include("/xampp/htdocs/DocX/include/DBConnect.php");

	$conn = new DB_Connect();
	$db = $conn->connect();

	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$weight = $_POST['weight'];
	$height = $_POST['height'];
	$mob = $_POST['mob_no'];
	$diag = $_POST['diagnosis'];
	$pres = $_POST['prescription'];	
	$date = date("Y/m/d");
	$id = $_SESSION['id'];

	$query = "UPDATE `patient` SET `f_name`='".$f_name."',`l_name`='".$l_name."',`age`='".$age."',`gender`='".$gender."',`weight`='".$weight."',`height`='".$height."', `mob_no`='".$mob."',`diagnosis`='".$diag."',`prescription`='".$pres."' WHERE `_id` = '".$id."'";

	$query2 = "INSERT INTO `history`(`p_name`, `diagnosis`, `prescription`, `last_visited`) VALUES ('".$f_name." ".$l_name."','".$diag."','".$pres."','".$date."')";
	mysqli_query($db, $query2);

	$row = mysqli_query($db, $query);

	$row = mysqli_query($db, $query);
	

	if ($row==null) {
		echo "Null";
	}else{
		header("Location: http://localhost/DocX/main.php");
		exit();
	}


	mysqli_close($db);


?>
