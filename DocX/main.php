<!DOCTYPE html>
<html>
<head>

	<?php

		ob_start();

		include("/xampp/htdocs/DocX/include/DBConnect.php");

		$conn = new DB_Connect();
		$db = $conn->connect();

		$query = "SELECT * FROM `patient` ORDER BY `f_name` ASC";
		$result = mysqli_query($db, $query);

		ob_clean();

	?>

	<title>DocX</title>

	<link href="https://fonts.googleapis.com/css?family=Roboto:100i,300,400,500" rel="stylesheet">
	<link rel="icon" href="fav_icon.png">

	<script type="text/javascript">
		var l_tab = 1;
		var max;

		function tabsOnClick(id){
			var li = document.getElementById(id);
			var div = document.getElementById('tab_'+id);
			var tab_strip = document.getElementById('tab_strip');


			for(var i=1; i<=3; i++){
				document.getElementById(i).className = '';
				document.getElementById("tab_"+i).style.display = "none";
			}
			if(l_tab>id){
				max = l_tab;				
				var displacement = (max - id) * 100;
			}
			else{
				max = id;				
				var displacement = (max - l_tab) * 100;
			}

			tab_strip.style.transform = "translateX("+displacement+"px)";

			li.className += 'current';			
			li.style.className += "ripple";
			div.style.display = "block";			
			c_tab = id;
		}

		function openDialog(p_id, name){
			var dialog = document.getElementById('del_dialog');
			dialog.style.display = "block";
			var title = document.getElementById('del_title');
			title.innerHTML = "Are you sure you want to delete " + name + "'s data?"

			var yes = document.getElementById('yes');
			yes.onclick = patient_delete(p_id);
			var no = document.getElementById('no');
			no.onclick = dialog.style.display = "none";
		}

		function patient_delete(p_id){
			var ajax = new XMLHttpRequest();			

			ajax.open("GET", "http://localhost/DocX/include/delete.php?id="+p_id, true);
			ajax.send();

			deleteHistory(p_id); 

			window.location.reload();
		}

		function deleteHistory(p_id){
			var ajax = new XMLHttpRequest();

			ajax.open("GET", "http://localhost/DocX/include/delete_history.php?id="+p_id, true);
			ajax.send();

			window.location.href = "http://localhost/DocX/main.php";
		}

		function edit(p_id){
			location.href = "http://localhost/DocX/edit.php?id="+p_id;
		}

		function filter(){
			var ajax = new XMLHttpRequest();
			var input = document.getElementById("search");
			console.log(input.value);
			var search = input.value;
			var main_div = document.getElementById("main_div");
			main_div.style.display = "none";

			ajax.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText);
					document.getElementById("search_div").innerHTML = this.responseText;		
				}
			} 

			ajax.open("GET", "http://localhost/DocX/include/search.php?search_txt="+search, true);
			ajax.send();
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
			box-shadow: 0 2px 5px rgba(0,0,0,.26);
			position: fixed;
			width: 100%;
		}

		.nav{
			height: auto;			
			padding: 20px 10px 0px 10px;
			width: 100%;
			max-width: 800px;
			margin: auto;
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
			margin-bottom: 20px;
		}

		ul{
			width: 300px;
		    display: flex;	
		    margin: 0;
		    padding: 0;
		    z-index: -1;
		    margin-bottom: -3px;
		}

		li{
			cursor: pointer;
			width: 50px;
			font-family: 'Roboto', sans-serif;			
			font-size: 14px;
			color: rgba(255,255,255,0.7);
			float: left;
			list-style-type: none;
			padding: 15px 25px 15px 25px;
			text-align: center;
		}

		/*li:hover{
			background-color: #FFD740;
		}*/		

		.current{
			color: #fff;
			padding-bottom: 5px;
			/*border-bottom: 3px solid #fff;*/
		}

		#tab_strip{
			background-color: #fff;
			width: 100px;
			height: 3px;
			transition-duration: 0.3s;
		}

		.container{
			width: 100%;
			max-width: 800px;
			height: auto;
			margin: auto;
			padding-top: 116px; 
		}

		#tab_1{
			display: block;
			padding: 8px;
		}

		#tab_2{
			display: none;
			padding: 8px;
		}

		#tab_3{
			display: none;
			padding: 8px;
		}		

		input{
			border: 0;
			border-bottom: 2px solid rgba(0,0,0,0.25);
			font-size: 16px;
			outline: 0;
			padding: 3px;
			margin-left: 5px;
			transition-duration: 0.3s; 
			background-color: #fafafa 
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

		.patient_card{						
			transition-duration: 0.2s;
			width: auto;			
			height: auto;
			background-color: #fafafa;
			padding: 16px;
			box-shadow: 0 2px 2px 0 rgba(0,0,0,.14);
			display: flex;
			justify-content: space-around;
			align-items: center;
			margin-bottom: 16px;
		}

		.patient_card:hover{
			transition-duration: 0.2s;
			box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.26);
		}

		.pic{
			float: left;
		}

		.fab_edit{
			transition-duration: 0.2s;
			width: 56px;
			height: 56px;
			background-color: #2196F3;
			border-radius: 50%;
			box-shadow: 0px 2px 6px 0px rgba(0,0,0,0.26);
			display: flex;
			justify-content: center;
			align-items: center;
			margin: 16px;
		}

		.fab_edit:hover{
			transform: translateY(-6px);
			transition-duration: 0.2s;
			box-shadow: 0px 4px 12px 0px rgba(0,0,0,0.3);
		}

		.fab_delete{
			transition-duration: 0.2s;
			width: 56px;
			height: 56px;
			background-color: #f44336;
			border-radius: 50%;
			box-shadow: 0px 2px 6px 0px rgba(0,0,0,0.26);
			display: flex;
			justify-content: center;
			align-items: center;
			margin: 16px;
		}

		.fab_delete:hover{
			transform: translateY(-6px);
			transition-duration: 0.2s;
			box-shadow: 0px 4px 12px 0px rgba(0,0,0,0.3);
		}

		.search_icon{
			vertical-align: middle;
			margin-right: 5px;
		}

		.search_txt{
			background-color: transparent;
			border-bottom: 2px solid #fafafa;
			margin-right: 50px; 
			margin-top: 0;		
			color: #fafafa;
		}
		
		.search_txt:focus{
			border-bottom: 2px solid #FFA000;
		}

		.search_txt[type="search"]{
			color: #fafafa;
		}

		#toast{
			display: none;
			background-color: #121212;
			opacity: 0.5;
			width: auto;			
			height: 30px;
			border-radius: 30px;
			color: #fff;
			justify-content: center;
			align-items: center;
		}

		table{
			font-family: 'Roboto', sans-serif;
			background-color: #F5F5F5;
		}

		th{
			font-family: 'Roboto', sans-serif;
			padding: 10px;
			color: #fff;
			background-color: #FFA000;
		}

		td{
			padding: 10px;
		}

		.table{
			width: auto;			
			height: auto;
			background-color: #fafafa;
			box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.2);
		}

		#del_dialog{
			display: none;
		    border-radius: 3px;
		    background-color: var(--200);
		    margin: 7% auto;
		    padding: 20px;
		    width: 300px;		    
		    height: auto;
		    box-shadow: 0 4px 4px 0 rgba(0,0,0,0.2);
		}

		.btn{
			width: 50px;
			height: 30px;
			border-radius: 2px;
			border: none;
			background-color: #E0E0E0;
			color: #fff;
			outline: 0;
		}

		.btn:hover{
			box-shadow: 0px 2px 2px 0px rgba(0,0,0,.2);
		}

		#main_div{
			display: block;
		}


	</style>
</head>
<body>

	<nav>
		<div class="nav">
			<h2>DocX</h2>
			<div style="float: right;">
			<img class="search_icon" src="magnify.png">
			<input onkeyup="filter()" id="search" type="search" name="search" placeholder="Search" class="search_txt">
			</div>
			<ul>
				<li id="1" class="current" onclick="tabsOnClick('1')">VIEW</li>
				<li id="2" onclick="tabsOnClick('2')">CREATE</li>
				<li id="3" onclick="tabsOnClick('3')">HISTORY</li>
			</ul>
			<div id="tab_strip"></div>
		</div>
	</nav>

	<section class="container">

		<div id="del_dialog">
			<h2 id="del_title"></h2>
			<div>
				<button class="btn" id="yes">YES</button>
				<button class="btn" id="no">NO</button>
			</div>
		</div>

		<div id="tab_1">

		<div id="search_div">
			
		</div>

		<div id="main_div">

		<?php

			if (mysqli_num_rows($result)==0) {
				echo "<center><img style=\"margin-top: 100px;\" src=\"fav_icon.png\"><p>No Patients Record.</p></center>";
			}
			
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
						<p><strong>Weight:</strong> ".$data['weight']."kgs <strong>		Height:</strong> ".$data['height']."cms</p>
						<p><strong>Last Diagnosis:</strong> ".$data['diagnosis']."</p>
						<p><strong>Last Prescription:</strong> ".$data['prescription']."</p>
						<p><strong>Last Treated On:</strong> ".$data['last_visited']."</p>
						<p><strong>Mobile No.:</strong> ".$data['mob_no']."</p>
					</div>
					<div>
						<div class=\"fab_edit\" onclick=\"edit('".$data['_id']."')\"><img src=\"border-color.png\"></div>
						<div class=\"fab_delete\" onclick=\"patient_delete('".$data['_id']."')\"><img src=\"delete.png\"></div>
					</div>
				</div>\n";
			}

		?>

		</div>

		</div>

		<div id="tab_2">

			<div class="create_form">
				<center>
				<h1>Create New Patient Record</h1>

				<form id="patient_record_new" method="POST" action="http://localhost/DocX/include/insert_patient.php">

				<p>First Name: <input type="text" name="f_name"></p>
				<p>Last Name: <input type="text" name="l_name"></p>
				<p>Age: <input type="number" name="age"></p>
				<p>Gender: <input type="radio" name="gender" value="Male">Male
				<input type="radio" name="gender" value="Female">Female</p>
				<p>Weight: <input type="number" step="any" name="weight">kgs</p>
				<p>Height: <input type="number" step="any" name="height">cm</p>
				<p>Mobile No.: <input type="number" name="mob_no" ></p>
				<p>Daignosis: <textarea name="diagnosis" ></textarea></p>
				<p>Prescription: <textarea name="prescription"></textarea></p>
				<input class="submit" type="submit" name="Submit" value="CREATE">

				</form>
				</center>
			</div>

		</div>

		<div id="tab_3">
			<div class="table">
			<table width="100%" >				

				<?php

				$query2 = "SELECT * FROM `history` ORDER BY `p_name`";
				$result = mysqli_query($db, $query2);

				if (mysqli_num_rows($result)==0) {
					echo "<center><img style=\"margin-top: 100px;\" src=\"fav_icon.png\"><p>No Patients Record.</p></center>";
				}else{											

					echo "<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Diagnosis</th>
						<th>Prescrition</th>
						<th>LastVisited</th>
						<th>Actions</th>
					</tr>";

				}

				while ($his = mysqli_fetch_assoc($result)) {
					
					echo "<tr>
					<td>".$his['_id']."</td>
					<td>".$his['p_name']."</td>
					<td>".$his['diagnosis']."</td>
					<td>".$his['prescription']."</td>
					<td>".$his['last_visited']."</td>
					<td><center><img onclick=\"deleteHistory('".$his['_id']."')\" src=\"delete_1.png\"></center></td>
				</tr>";

				}				

				?>
				
			</table>

			</div>
		</div>

		<div id="toast">
			<p id="toast_txt"></p>
		</div>
	</section>

</body>
</html>