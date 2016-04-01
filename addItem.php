<?php
session_start();
if(!isset($_SESSION['login_user']))
{
  echo "login first";
}
else
{
include_once("Admin.html");
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
<title>Purchase</title>
</head>

<body>
<br>
<br>
<br>
<br>
<br>

<div id="header">
<!-- Stores and Purchase Management -->

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
<form action="/tpa/addItem.php" method="post" name="frm">
<B>Items:</B> <BR>
<SELECT NAME="item" SIZE="5" MULTIPLE >
<OPTION SELECTED> Chair
<OPTION> table
<OPTION> Keyboard
<OPTION> Monitor
<OPTION> Mouse
<OPTION> Speakers
<OPTION> CPU
</SELECT>
<br>
Quantity needed:<br>
<input name="quantity" type="number" min = "1" />
<br>
<input name="sub" type="submit" value="submit"/><br>


</form>
</div>


  <?php 
  if(isset($_POST['item'])&&isset($_POST['quantity'])&&isset($_POST['sub']))
  {//echo "All is Well";
    $login_user = $_SESSION['login_user'];
    $itemName = $_POST['item'];
    $myQuantity = $_POST['quantity'];
    $query= "SELECT * FROM Inventory_items_DB where name = '$itemName'";
    $result=mysql_query($query) or die("query error");
    $query_data=mysql_fetch_array($result);
    $add = $_POST['quantity'];
    $new_quantity = $add + $query_data['quantity'];
   $query="UPDATE Inventory_items_DB SET quantity = '$new_quantity' WHERE name = '$itemName'";

   $result=mysql_query($query) or die("query error");
   echo "<script>  alert('Item has been sucessfully added in the inventory')</script>";
    //$myID = $query_data['itemID'];
    //$price = $query_data['price'];
    //$li = new listedItems($myID);
    //echo "All Well";
    //$li->setAttributes($itemName,$myQuantity);
    //$li->putinDB($login_user, $myQuantity);
    //$Viewer = "admin";
    //$status = "success";

    //$db->convey_requester($login_user,$Viewer ,$itemName,$myQuantity,$price,$status)
    //$li->storeInDatabase();
   // $shareStatus = $li->getSharability();
   //$quantity=$_POST['quantity'];
      
?>
      

<p id="demo"></p>

<script>
<?php 
if($check_min_quant == 1)
{
?>
myFunction1();
<?php 
}
else
{
  ?>
  myFunction2();
  <?php
}
?>
function myFunction1() {
    var txt;
    var r = confirm("Confirm by clicking on OK");
    if (r == true) {
        txt = "Order confirmed";
    } else {
        txt = "Order cancelled";
    }
    document.getElementById("demo").innerHTML = txt;
}

function myFunction2() {
    var txt;
    var r = confirm("Exceeded quantity present!!");
    
    //document.getElementById("demo").innerHTML = txt;
}
</script>
   <?php 


 } ?>


</body>
</html>

<?php

}
?>
