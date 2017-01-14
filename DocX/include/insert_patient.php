<?php

	include("/xamp/htdocs/DocX/include/DBConnect.php");

	$conn = new DB_Connect();
	$db = $conn->connect();

	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$weight = $_POST['weight'];
	$height = $_POST['height'];
	$diag = $_POST['diagnosis'];
	$pres = $_POST['prescription'];
	$date = date("Y/m/d");

	$query = "INSERT INTO `patient` (`_id`, `f_name`, `l_name`, `age`, `gender`, `weight`, `height`, `diagnosis`, `prescription`, `last_visited`, `created_at`) VALUES (NULL,'".$f_name."', '".$l_name."', '".$age."', '".$gender."', '".$weight."', '".$height."', '".$diag."', '".$pres."', '".$date."', '".$date."')";

	$row = mysqli_query($db, $query);
	header("Location: http://localhost/DocX/main.php");
	exit();

	if ($row==null) {
		echo "Null";
	}


	mysqli_close($db);

?>