<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "unified";
	$port = "3306";
	 
	 $db = mysqli_connect($servername, $username, $password, $dbname);
	 if(!$db)
	 {
		echo mysqli_error();
	 }
	 
	$sql = "SELECT * FROM fb_private_message ORDER BY rowid DESC";
	$result = mysqli_query($db, $sql);
	while($row = mysqli_fetch_assoc($result))
	{
		echo "
			<ul>
				<li>".$row['message']."</li>
			</ul>
			";
	}
?>