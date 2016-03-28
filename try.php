<?php 
session_start();
//include_once("Faculty.html");
require_once 'include/DB_Functions.php';
require_once 'include/listedItems.php';
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
<title>quantity</title>
</head>

<body>

<div id="header">
Stores and Purchase Management

</div>
<div>
<div id="sidebar">

</div>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div>
<form action="/tpa/try.php" method="post" name="frm">
<B>Items:</B>
<br>
Quantity needed to be returned:<br>
<input name="quantity" type="number" min = "1" />
<br>
<input name="sub" type="submit" value="submit"/><br>
<?php
//echo "item: ".$_SESSION['item1'];
//echo "status: ".$_SESSION['status'];
?>

</form>
</div>


  <?php 
  if(isset($_POST['quantity'])&&isset($_POST['sub']))
  {//echo "All is Well";
    $login_user = $_SESSION['login_user'];
    if ($_SESSION['status'] == 'return') {
      $_SESSION['return_quantity'] = $_POST['quantity'];
      $db->Return_item();
    }
    else if ($_SESSION['status'] == 'repair') {
      echo "Will be sent to repair     ";
    }
    else if ($_SESSION['status'] == 'nrepair') {
      $_SESSION['return_quantity'] = $_POST['quantity'];
      $db->Repair_nl_item();
    }
    
   // echo $_SESSION['return_quantity'];
    
    echo "<a href='myord.php'> myorders </a>";
      
?>
      

<p id="demo"></p>


   <?php 


 } ?>


</body>
</html>
