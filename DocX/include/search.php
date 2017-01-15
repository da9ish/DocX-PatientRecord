<?php

	include("/xamp/htdocs/DocX/include/DBConnect.php");

	$conn = new DB_Connect();
	$db = $conn->connect();

	$search = $_GET['search_txt'];

	$query = "SELECT * FROM `patient` WHERE `f_name` LIKE '".$search."' OR `l_name` LIKE '".$search."'";
	$result = mysqli_query($db, $query);

	while($data = mysqli_fetch_assoc($result)){

		if($data['gender']=="Male"){
						$gender = "male.png";
					}else{
						$gender = "female.png";
					}				

		echo "<div class=\"patient_card\">
			<img class=\"pic\" src=\"".$gender."\">				
			<div>
				<p style=\"font-size: 25px; margin-bottom: 0;\"><strong>Name:</strong> ".$data['f_name']." ".$data['l_name']."</p>
				<p><strong>Age:</strong> ".$data['age']."</p>
				<p><strong>Weight:</strong> ".$data['weight']."kgs <strong>		Height:</strong> ".$data['height']."cm</p>
				<p><strong>Last Diagnosis:</strong> ".$data['diagnosis']."</p>
				<p><strong>Last Prescription:</strong> ".$data['prescription']."</p>
				<p><strong>Last Treated On:</strong> ".$data['last_visited']."</p>
			</div>
			<div>
				<div class=\"fab_edit\" onclick=\"edit('".$data['_id']."')\"><img src=\"border-color.png\"></div>
				<div class=\"fab_delete\" onclick=\"patient_delete('".$data['_id']."')\"><img src=\"delete.png\"></div>
			</div>
		</div>";

	}

	mysqli_close($db);

?>