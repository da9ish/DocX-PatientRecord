<?php

	include("/xamp/htdocs/DocX/include/DBConnect.php");

	$conn = new DB_Connect();
	$db = $conn->connect();

	$id = $_GET['id'];

	$query = "DELETE FROM `history` WHERE `_id` = '".$id."'";
	mysqli_query($db, $query);

	echo "Deleted Successfully";

	mysqli_close($db);

?>