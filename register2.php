<?php
session_start();
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="s.css">
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
<title>Set Credentials</title>
<style>
select 
{
  width: 20%;
  padding: 6px 5px;
  border-radius: 2px;
  border: none;
  background-color: #f1f1f1;

}
</style>
</head>

<body>

<div id="header">
<!-- Stores and Purchase Management -->

</div>
<div>
<div id="sidebar">
<?php
?>
</div>
<!-- InstanceBeginEditable name="EditRegion1" -->
<!-- <div>
 <?php
 //echo "Username: ".$_SESSION['login_user'];
 //$uname = $_SESSION['login_user'];
 //echo "testing: ".$uname;
 ?>
</div>
<form action="register2.php" method="post" name="frm">
Password<br>
<input name="password" type="password" size="40" /><br>
Security Question<br>
<select id = 'Security_Question' name="Security_Question">
        <option value="dob">Date of birth</option>
    <option value="pob">Place  of birth</option>
</select>
<br>
Answer<br>
<input name="security_answer" type="text" size="40" /><br>
<input name="sub" type="submit" value="submit"/><br />
</form>
</div> -->



 <div class="container">
    <section class="register">
      <h1>
       <?php
             echo $_SESSION['login_user'];
             $uname = $_SESSION['login_user'];
             //echo "testing: ".$uname;
       ?>
     </h1>
      <form action="register2.php" method="post" name="frm">
      <div class="form-group">
      <h3>Password</h3>
       <input name="password" type="password" size="40" class="form-controls" /><br>

    
      <h3>Security Question</h3>
      <select id = 'Security_Question' name="Security_Question">
                <option value="dob">Date of birth</option>
            <option value="pob">Place  of birth</option>
      </select>
      <h3>Answer</h3>
      <input name="security_answer" type="text" size="40" /><br>
      <input name="sub" type="submit" value="submit"/><br />
      <div class="reg_section password">
      </div>

      </form>
    












































<?php

  if(isset($_POST['password'])&&isset($_POST['security_answer'])&&isset($_POST['Security_Question'])&&isset($_POST['sub']))
  {
  $password=$_POST['password'];
  $Security_Question = $_POST['Security_Question'];
  $security_answer = $_POST['security_answer'];
  $type = $_SESSION['utype'];
  $SNo = $_SESSION['serial'];
  $result=$db->register($SNo, $uname, $password, $type, $Security_Question, $security_answer);
    
      if($result==1)
      {
        echo "Registered Successfully!!";
         
?>

         <br><a href="index.php">Login page</a>
<?php
      }
      else
      {
        header("Location:index.php");
      }
  

}

?>
</section>
  </div>
</body>
</html>