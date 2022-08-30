<?php
session_start();

//Header Info
$Title = 'Login';

require_once('imghelper.php');
include_once('dbConnector.php');
?>

<html>
	<?php require_once('header.php'); ?> <!-- Here because contents include <header> markup -->
<body>
	<a href='register.php'>Register</a>
	
	<form method='post' action=''>
		<input  type="text"     name="user_name" placeholder='Username'>
		<br/>
		<input  type="password" name="password"  placeholder='Password'>
		<br/>
		<button type='submit'   name='submit'>Login</button>
	</form>
</body>
</html>

<?php
$message="";
if(count($_POST)>0) {
    $result = mysqli_query($conn,"SELECT * FROM Users WHERE username='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
    $row  = mysqli_fetch_array($result);
    if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['name'];
    } else {
        $message = "Invalid Username or Password!";
    }
}
if(isset($_SESSION["id"])) {
    header("Location:index.php");
}
?>
