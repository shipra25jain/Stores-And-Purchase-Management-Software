<?php
	session_start();
	include_once("login.html");
	
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
 if(isset($_POST['sub'])) {
	if(isset($_POST['uname']) && isset($_POST['pword']))
	{
		//echo "coming to if";
		$username=$_POST['uname'];
		$password=$_POST['pword'];

		$type = $db->checkCredentials($username,$password);

		//echo "type: ".$type."<br>";

		if($type!=null)
		{
			$_SESSION['login_user']=$username;
			$_SESSION['utype']=$type;

			if($type=="admin"){
				//echo "<br>";
				header("Location:Admin.html");
			}
			else if($type=="Faculty"){
				//echo "<br>";
				header("Location:Faculty.html");
			}
			else {
				//echo "<br>";
				header("Location:Student.html");
			}
		}
		else
		{	$_SESSION['login_user']=$username;
			echo "<script type='text/javascript'> alert('wrong password') </script>";
			echo "<br>";
   		 	echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><a href='forgetpassword.php'>   Forget Password </a>" ;
    		echo "<br>";
    		echo "<a href='index.php'> Try Again </a>" ;

		}


	}
}
?>