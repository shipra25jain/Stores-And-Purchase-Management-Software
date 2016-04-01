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
<title>Forget Password</title>
</head>

<body>

<!-- <div id="header">
Stores and Purchase Management

</div>
<div>
<div id="sidebar">
<?php
?>
</div>
<!-- InstanceBeginEditable name="EditRegion1" -->
<!-- <div>
 <?php
 echo "Username: ".$_SESSION['login_user'];
 $uname = $_SESSION['login_user'];
 //echo "testing: ".$uname;
 ?>
</div>
<div id="change_password">
<?php
$SecQ = $db->getSecurityQuestion($uname);
echo $SecQ ;
?>

<form action="changepassword1.php" method="post" name="frm">
<table cellpadding="2", cellspacing="3" border="2">
<tr><td><input name="SecA" type="text" size="40" /></td></tr>
</table>
<input name="sub" type="submit" value="submit"/><br />
</form>
</div> --> 


  <!-- MAIN CODE FOR THE FRONT_END -->

<div class="container">
    <section class="register">
      <h1> <?php echo $_SESSION['login_user'];
            $uname = $_SESSION['login_user'];
           ?> 
     </h1>
<form action="changepassword1.php" method="post" name="frm">
      <div class="form-group">
      <h3><?php
          $SecQ = $db->getSecurityQuestion($uname);
          echo $SecQ ;
          ?>
      </h3>
      <input name="SecA" type="text" size="40" />
      <div class="reg_section password">
      </div>
     <input name = "sub" type="submit" value="submit"/><br >
      </form>


   <!-- CODE FOR CHECKING THE SECURITY QUESTION -->

<?php
  if(isset($_POST['SecA'])&&isset($_POST['sub']))
  {
    //echo "coming to if";
  $SecA=$_POST['SecA'];
  $correct = $db->checkSecurityAnswer($SecA, $uname);
  if($correct==1)
  {
    
    header("Location: /tpa/changepassword.php");
  } 
  else
  {
    echo "Incorrect Answer";
  }
}
?>
</div>
</body>
</html>

   
