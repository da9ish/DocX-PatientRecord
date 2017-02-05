<!DOCTYPE html>
<html>
<head>
	<title>DocX</title>

	<link href="https://fonts.googleapis.com/css?family=Roboto:100i,300,400,500" rel="stylesheet">
	<link rel="icon" href="fav_icon.png">

	<script type="text/javascript">
		function back(){
			location.href = "http://localhost/DocX/main.php";
		}
	</script>

	<style type="text/css">	
		body{			
			margin: 0;
			padding: 0;	
			background-color: #fafafa;
		}

		nav{
			background-color: #FFC107;			
			box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.2);
			position: fixed;
			width: 100%;
		}

		.nav{
			height: auto;			
			padding: 10px 10px 10px 10px;
			width: 100%;
			max-width: 800px;
			margin: auto;
			display: flex;
			align-items: center;
		}

		p, h1{
			font-family: 'Roboto', sans-serif;
			font-weight: 300;
		}
		
		h2{
			display: inline-block;
			font-family: 'Roboto', sans-serif;
			font-weight: 300;
			color: #fff;
			margin: 0;
			margin-left: 16px;
		}

		.container{
			width: 100%;
			max-width: 800px;
			height: auto;
			margin: auto;
			padding-top: 65px;
		}

		input{
			border: 0;
			border-bottom: 2px solid rgba(0,0,0,0.25);
			font-size: 16px;
			outline: 0;
			padding: 3px;
			margin-left: 5px;
			transition-duration: 0.3s;
		}

		input:focus{
			border-bottom: 2px solid #FFC107;
			transition-duration: 0.3s;
		}

		.submit{
			padding: 10px;
			font-family: 'Roboto', sans-serif;
			background-color: #FFA000;
			color: #fff;
			border-radius: 2px;
		    border: none;
		    width: 100px;
		    height: 40px;
		    font-size: 15px;
		    transition-duration: 0.4s;
		    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2);
		}

		.create_form{
			background-color: #fafafa;
			padding: 16px;
			box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.2);
		}

	</style>
</head>
<body>

	<nav>
		<div class="nav">
			<img onclick="back()" src="arrow-left.png">
			<h2>DocX</h2>
		</div>
	</nav>

	<section class="container">
		<?php

			session_start();

			include("/xamp/htdocs/DocX/include/DBConnect.php");

			$conn = new DB_Connect();
			$db = $conn->connect();

			$id = $_GET['id'];
			$_SESSION['id'] = $id;

			$query = "SELECT * FROM `patient` WHERE `_id` = '".$id."'";
			$result = mysqli_query($db, $query);
			$res = mysqli_fetch_assoc($result);

			$male = null;
			$female = null;

			if($res['gender']=="Male"){
					$male = "checked";
				}else{
					$female = "checked";
			}


			echo "<div class=\"create_form\">
				<center>
				<h1>Update Patient Record</h1>

				<form id=\"patient_record_new\" method=\"POST\" action=\"http://localhost/DocX/include/update_patient.php\">

				<p>First Name: <input type=\"text\" name=\"f_name\" value=\"".$res['f_name']."\" placeholder=\"First Name\"></p>
				<p>Last Name: <input type=\"text\" name=\"l_name\" value=\"".$res['l_name']."\" placeholder=\"Last Name\"></p>
				<p>Age: <input type=\"number\" name=\"age\" value=\"".$res['age']."\" placeholder=\"Age\"></p>
				<p>Gender: <input type=\"radio\" name=\"gender\" value=\"Male\" ".$male.">Male
				<input type=\"radio\" name=\"gender\" value=\"Female\" ".$female.">Female</p>
				<p>Weight: <input type=\"number\" value=\"".$res['weight']."\" step=\"any\" name=\"weight\" placeholder=\"Weight\">kgs</p>
				<p>Height: <input type=\"number\" value=\"".$res['height']."\" step=\"any\" name=\"height\" placeholder=\"Height\">cms</p>
				<p>Mobile No.: <input type=\"number\" value=\"".$res['mob_no']."\" name=\"mob_no\" placeholder=\"Mobile No.\"></p>
				<p>Daignosis: <textarea name=\"diagnosis\" placeholder=\"Daignosis\">".$res['diagnosis']."</textarea></p>
				<p>Prescription: <textarea name=\"prescription\" placeholder=\"Prescription\">".$res['prescription']."</textarea></p>
				<input class=\"submit\" type=\"submit\" name=\"Submit\" value=\"UPDATE\">

				</form>
				</center>
			</div>";

		?>
	</section>

</body>
</html>