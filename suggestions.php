<?php
session_start();
require_once 'include/DB_Functions.php';
//require_once 'include/nonlistedItems.php';
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
<title>Suggestions</title>
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
 ?>
</div>


<form action="suggestions.php" method="post" name="frm">
  <fieldset>
    

    Enter your suggestions here<br>
    <input name="itemDetails" type="text" size="100" /><br>
    
    <input  name= "sub" type="submit" value="submit"/>
  </fieldset>
</form>

<?php
  if(isset($_POST['sub']))
  {
  	//echo"testing";
  	$login_user = $_SESSION['login_user'];
  	
    $itemDetails = $_POST['itemDetails'];
    
    $db->Suggestions($login_user, $itemDetails);
    //echo "success out";



  }
 ?>
 </body>
</html>