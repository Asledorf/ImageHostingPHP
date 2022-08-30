<?php
//Header Info
$Title = 'Image Upload';

$user = "UserID_007"; //debug for now, will be stored in session and updated via login via SQL
$MB_FileSizeLimit = 5;
$FOLDER_CountLimit = 10;

require_once('imghelper.php');
?>

<html>
	<?php require_once('header.php'); ?> <!-- Here because contents include <header> markup -->
<body>
	<a href='login.php'>Login</a>
	<a href='register.php'>Register</a>
	
	<form method='post' action='' enctype='multipart/form-data'>
		<input type="file" name="file[]" id="file" multiple>
		<input type='submit' name='submit' value='Upload'>
	</form>

	<?php 
		// Path to store uploaded file
		$imgdir = "./images/";
		$path = $imgdir.$user.'/';

		if(isset($_POST['submit'])) {
			// Iterate through the files
			for($i = 0; $i < count($_FILES['file']['name']); $i++)
			{
				//get file
				$filename    = $_FILES['file']['name']    [$i];
				$filetmpname = $_FILES['file']['tmp_name'][$i];
				$filesize    = $_FILES['file']['size']    [$i];
				
				//type check
				if(!exif_imagetype($filetmpname)) 
					echo "Not A Valid Image Type.";
				
				//size check
				else if($filesize > $MB_FileSizeLimit * 1024)
					echo "Image Is Too Large. ".($filesize*1024).'MB';
				
				//make user folder if nonexistent
				else if (!is_dir($path)) 
					mkdir($path, 0777, true);  
				
				//check folder image count
				else if (count(glob($path.'*')) > $FOLDER_CountLimit -1)
					echo "Too Many Files.";
					
				else
				{
					//move file to folder
					move_uploaded_file($filetmpname, $path.$filename);
					//display image
					display_image($path.$filename);
				}
			}
		} 
		
		if(isset($_POST['delete']))
			unlink($_POST['image']);
		
?>
</body>
</html>
