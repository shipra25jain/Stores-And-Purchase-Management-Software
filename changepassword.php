<?php
session_start();
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="slider.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
function goback()
{
	alert("hi");
	history.go(-1);
}
</script>
<title>Change Password</title>
</head>

<body>

<div id="header">
Stores and Purchase Management

</div>
<div>
<div id="sidebar">
<?php
?>
</div>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div>
 <?php
 echo "Username: ".$_SESSION['login_user'];
 $uname = $_SESSION['login_user'];
 //echo "testing: ".$uname;
 ?>
</div>
<form action="changepassword.php" method="post" name="frm">
<table cellpadding="2", cellspacing="3" border="2">
<tr><th>New Password:</th><td><input name="npswrd" type="password" size="6" /></td></tr>
<tr><th>Confirm Password:</th><td><input name="cpswrd" type="password" size="6" /></td></tr>
</table>
<input name="sub" type="submit" value="submit"/><br />
</form>m>
</div>
<?php

  if(isset($_POST['npswrd'])&&isset($_POST['cpswrd'])&&isset($_POST['sub']))
  {
  $npswrd=$_POST['npswrd'];
  $cpswrd=$_POST['cpswrd'];
  if ($npswrd == $cpswrd)
  {
    echo "passwords match!";
      //mysql_select_db("security question");
      $query="UPDATE Login_details SET password = '$npswrd' WHERE username='$uname'";
      $result=mysql_query($query) or die("query error");
      echo "New password has been set";
    # code...
  }
  else
  {
    echo "Both the passwords don't match!!";
  echo "<a href='/tpa/changepassword.php'> Try again </a>";

  }
}

?>
</body>
</html>