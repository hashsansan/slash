<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>TFC API</title>
	</head>
	
	<body>
	
		<?php
			$host = "localhost";
			$username = "root";
			$password = "";
			$db = "unified";
			
			$conn = mysqli_connect($host,$username,$password,$db);
			if(!$conn)
			{
				echo "Cannot connect to database " . mysqli_error();
			}
			
			if(isset($_POST['upload']))
			{
				$screen_name = "Cash Credit";
				$fbid = "1499967966787857";
				$msge = $_POST['msge'];
				$stat = "queue";
				
						//BASE64 IMAGE
				/*$name = addslashes($_FILES['fileToUpload']['name']);
				$target_dir = "uploads/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

				 // Select file type
				 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				 // Valid file extensions
				 $extensions_arr = array("jpg","jpeg","png","gif");

				 // Check extension
				 if( in_array($imageFileType,$extensions_arr) ){
				 
				  // Convert to base64 
				  $image_base64 = base64_encode(file_get_contents($_FILES['fileToUpload']['tmp_name']) );
				  $image = $imageFileType.$image_base64;
				  // Insert record
				 $sql = "INSERT INTO fb_sent(screen_name, fbid, stat, attachment, msg_type)
								VALUES('" . $screen_name . "','" . $fbid . "','" . $stat . "','" . $image . "','IMAGE')";
						$result = mysqli_query($conn, $sql);
						if($result)
						{
							echo "Save Success";
						}
						else
						{
							echo "Failed to save " . mysql_error();
						}
				  
				  // Upload file
				  move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_dir.$name);
				 }*/
				if($_FILES['fileToUpload']['name'] <> "" && $msge == "")
				{
					$target_dir = "uploads/";
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$file = $_FILES['fileToUpload']['tmp_name'];
					$target_path = time().$file;
					
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check != false && $_FILES['fileToUpload']['size'] < 500000 && $imageFileType = "jpg" || $imageFileType = "jpeg" || $imageFileType = "png")
					{
						if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file))
							$sql = "INSERT INTO fb_sent(screen_name, fbid, stat, attachment, msg_type)
									VALUES('" . $screen_name . "','" . $fbid . "','" . $stat . "','" . $target_file . "','IMAGE')";
							$result = mysqli_query($conn, $sql);
							if($result)
							{
								echo "<div style = 'color:green;'>Save Success</div>";
							}
							else
							{
								echo "<div style = 'color:red;'>Failed to save " . mysqli_error($conn) . "</div>";
							}
					} 
					elseif($check != false && $imageFileType = "mp4")
					{
						if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file))
							$sql = "INSERT INTO fb_sent(screen_name, fbid, stat, attachment, msg_type)
									VALUES('" . $screen_name . "','" . $fbid . "','" . $stat . "','" . $target_file . "','FILE')";
							$result = mysqli_query($conn, $sql);
							if($result)
							{
								echo "<div style = 'color:green;'>Save Success</div>";
							}
							else
							{
								echo "<div style = 'color:red;'>Failed to save " . mysqli_error($conn) . "</div>";
							}
					}
				}
				elseif($msge <> "" && $_FILES['fileToUpload']['name'] == "")
				{
					$sql = "INSERT INTO fb_sent(screen_name, fbid, msge, stat, msg_type)
							VALUES('" . $screen_name . "','" . $fbid . "','" . $msge . "','" . $stat . "','TEXT')";
					$result = mysqli_query($conn, $sql);
					if($result)
					{
						echo "<div style = 'color:green;'>Save Success</div>";
					}
					else
					{
						echo "<div style = 'color:red;'>Save Failed " . mysqli_error($conn) . "</div>";
					}
				}
			}
				
		?>
		
		
		<form method = "POST" enctype="multipart/form-data">
				<textarea name = "msge" placeholder = "Message goes here"></textarea><br>
				<input type = "file" name = "fileToUpload" id = "fileToUpload"><br>
				<input type = "submit" name = "upload" value = "Send">
		</form>
	</body>
</html>