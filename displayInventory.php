<?php
session_start();
include_once("Admin.html");
require_once 'include/DB_Functions.php';
require_once 'include/nonlistedItems.php';
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
<title>Display Listed Items</title>
</head>

<body>

<div id="header">
<!-- Stores and Purchase Management -->

</div>
<div>
<div id="sidebar">

</div>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div>
  <p>Reached </p>
 <?php
    echo "LISTED PRODUCT ORDERS";
    ?>
    <br><br><br><br>
    <?php
   $username = $_SESSION['login_user'];
   $query="SELECT * FROM Inventory_items_DB";

   $result=mysql_query($query) or die("query error");

   $num_rows = mysql_num_rows($result);
   //$query_data=mysql_fetch_array($result);
   if (mysql_num_rows($result) > 0) {
    // output data of each row

    ?>

<br><br><br><br>
    <table  table-layout: fixed; >

<tr>
  <!-- <td  width= 20% > <?php echo "SNo"; ?> </td> -->
  <td  width= 25% > ItemId</td>
  <td  width= 25% > Item Name </td>
  <td  width= 25% > Consumability </td>
  <td  width= 25% > Quantity </td>
  <td  width= 25% > Price </td>
</tr>

</table>
    
    <?php
    while($row = mysql_fetch_assoc($result)) {
  
      ?>
      <form action="" method="post" name="frm">
        <table class="table">

<tr>
  <!-- <td width= 20% > <?php echo $row['SNo']; ?> </td> -->
  <td width= 23%> <?php echo $row['itemID']; ?> </td>
  <td width= 23%> <?php echo $row['name']; ?> </td>
  <td width= 23%> <?php echo $row['consumability']; ?> </td>
  <td width= 23%> <?php echo $row['quantity']; ?> </td>
  <td width= 23%> <?php echo $row['price']; ?> </td>
</tr>

</table>
</form>

        <?php } ?>
        <br>

    <?php
    }
 else {
    echo "0 results";
}?>

</div>
 <!-- <button style="width:10%" type="submit" name="approve" onClick="window.location='addItem.php'">Add Item</button> -->
 </body>
</html>







