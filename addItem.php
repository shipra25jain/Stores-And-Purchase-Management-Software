<?php
session_start();
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

<div id="header">
Stores and Purchase Management

</div>
<div>
<div id="sidebar">

</div>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div>
 <?php
 ?>
</div>
<form action="/tpa/addItem.php" method="post" name="frm">
  <?php
/*
  $query = "SELECT * FROM Inventory_items_DB"; //You don't need a ; like you do in SQL
$result = mysql_query($query);
  echo "<table>"; // start a table tag in the HTML

while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['name'] . "</td><td>" . $row['quantity'] . "</td></tr>";  //$row['index'] the index here is a field name
}*/

?>

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
<input name="quantity" type="number" min = "1" max = "10" />
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
    $query= "SELECT itemID FROM Inventory_items_DB where name = '$itemName'";
    $result=mysql_query($query) or die("query error");
     $query_data=mysql_fetch_array($result);
    $myID = $query_data['itemID'];
    $li = new listedItems($myID);
    //echo "All Well";
    $check_min_quant = $li->setAttributes($itemName,$myQuantity);
    $li->putinDB_increase($login_user, $myQuantity);
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
?>
function myFunction1() {
    var txt;
    var r = confirm("Confirm ");
    if (r == true) {
        txt = "Item Added";
    } else {
        txt = "Order cancelled";
    }
    document.getElementById("demo").innerHTML = txt;
}


</script>
   <?php 


 } ?>


</body>
</html>