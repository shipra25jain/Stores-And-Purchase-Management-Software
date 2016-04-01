<?php
session_start();
if(!isset($_SESSION['login_user']))
{
  echo "login first";
}
else
{
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="s.css" rel = "stylesheet" type="text/css">
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

<!-- div id="header">
Stores and Purchase Management
</div> -->
<div>
<div id="sidebar">
<?php
?>
</div>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div>
 <?php
 //echo "Username: ".$_SESSION['login_user'];
 $uname = $_SESSION['login_user'];
 //echo "testing: ".$uname;
 ?>
<!-- </div>
<form action="changepassword.php" method="post" name="frm">
<table cellpadding="2", cellspacing="3" border="2">
<tr><th>New Password:</th><td><input name="npswrd" type="password" size="6" /></td></tr>
<tr><th>Confirm Password:</th><td><input name="cpswrd" type="password" size="6" /></td></tr>
</table>
<input name="sub" type="submit" value="submit"/><br />
</form>
</div> -->



<div class="container">
    <section class="register">
      <h1> <?php echo $uname ?> </h1>
<form action="changepassword.php" method="post" name="frm">
      <div class="form-group">
      <h3>New Password</h3>
      <input required = "required"name="npswrd" type="password" size="6" />
      <h3>Confirm Password</h3>
      <input required = "required" name="cpswrd" type="password" size="6" />
      <div class="reg_section password">
      </div>
     <input name = "sub" type="submit" value="submit"/><br >
      </form>




















<?php

  if(isset($_POST['npswrd'])&&isset($_POST['cpswrd'])&&isset($_POST['sub']))
  {
  $npswrd=$_POST['npswrd'];
  $cpswrd=$_POST['cpswrd'];
  if ($npswrd == $cpswrd)
  {
   // echo "Passwords match!";
      //mysql_select_db("security question");
      $query="UPDATE Login_details SET password = '$npswrd' WHERE username='$uname'";
      $result=mysql_query($query) or die("query error");
      echo "New password has been set";
      header("Location: move.html");
      ?>
        <br><br><br><a href="index.php"><h1>Login</h1></a>
      <?php
    # code...
  }
  else
  {
    echo "Both the passwords don't match!!";
  echo "<br><br><br><a href='/tpa/changepassword.php'> <h1>Try again </h1></a>";

  }
}

?>

</div>
</div>
</body>
</html>

<?php
}
?>