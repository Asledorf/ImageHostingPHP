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
	<a href='login.php'>Login</a>
	
	<form method='post' action=''>
		<input  type="text"     name="user_name" placeholder='Username'>
		<br/>
		<input  type="password" name="password"  placeholder='Password'>
		<br/>
		<button type='submit'   name='submit'>Register</button>
	</form>
</body>
</html>


<?php
$User = $Password = $email = "";
$errors = array('User'=>'', 'Password'=>'');

if(isset($_POST['submit']))
{
    if(empty($_POST['User']))
    {
        $errors['User'] = 'Username is required <br>';
    }
    else
    {
        $User = $_POST['User'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $User))
        {
            $errors['User'] = 'Username must contain letters and spaces only';
        }
    }

    if(empty($_POST['Password']))
    {
        $errors['Password'] ='Password <br>';
    }
    else
    {
        $Password = $_POST['Password'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $Password))
        {
            $errors['Password'] = 'Password must contain letters and spaces only';
        }
    }
    if(empty($_POST['email']))
    {
        $errors['email'] ='Email <br>';
    }
    else
    {
        $email = $_POST['email'];
    }


    if(array_filter($errors))
    {
        //echo 'There are errors in the form';
    }
    else{
        //echo 'Form is valid';
        $User = mysqli_real_escape_string($conn, $_POST['User']);
        $Password = mysqli_real_escape_string($conn, $_POST['Password']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $sql = "INSERT INTO Users(username, password, email) VALUES('$User', '$Password', '$email')";
        if(mysqli_query($conn, $sql))
        {
            header('Location: index.php');
        }
        else
        {
            echo 'Query Error' . mysqli_error($conn);
        }


    }

}
?>

