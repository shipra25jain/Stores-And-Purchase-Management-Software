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
<?php
if(isset($_POST['Repair']) || isset($_POST['Return']) || isset($_POST['nRepair']))
{
  $_SESSION['item1']=$_POST['name'];
  if(isset($_POST['Return']))
  {
    $_SESSION["status"] = "return";
  }
  else if(isset($_POST['Repair']))
  {
    $_SESSION["status"] = "repair";
  }
  else if(isset($_POST['nRepair']))
  {
    $_SESSION["status"] = "nrepair";
  }
  header("Location:try.php");
}


?>
</div>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div>
 <br><br><br><br><br>

 <?php
    echo "LISTED PRODUCT ORDERS";
    ?>
    <br><br>
    <?php
   $username = $_SESSION['login_user'];
   $query="SELECT * FROM LI_Orders";

   $result=mysql_query($query) or die("query error");

   $num_rows = mysql_num_rows($result);
   //$query_data=mysql_fetch_array($result);
   if (mysql_num_rows($result) > 0) {
    // output data of each row

    ?>


    <table  table-layout: fixed; >

<tr>
  <!-- <td  width= 20% > <?php echo "SNo"; ?> </td> -->
  <td  width= 25% > <?php echo "Item ID"; ?> </td>
  <td  width= 25% > <?php echo "Item Name"; ?> </td>
  <td  width= 25% > <?php echo "Consumability"; ?> </td>
  <td  width= 25% > <?php echo "Quantity"; ?> </td>
  <td  width= 25% > <?php echo "Stakeholder"; ?> </td>
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
  <td width= 23%> <?php echo $row['stakeholder']; ?> </td>
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
   
 <br><br>
 <div>
 <?php
    echo "NON LISTED PRODUCT ORDERS";
    ?>
    <br><br>
    <?php
   $username = $_SESSION['login_user'];
   $query="SELECT * FROM NLI_Orders";

   $result=mysql_query($query) or die("query error");

   $num_rows = mysql_num_rows($result);
   //$query_data=mysql_fetch_array($result);
   if (mysql_num_rows($result) > 0) {
    // output data of each row

    ?>
    <table>

<tr>

  <!-- <td><?php echo "SNo"; ?></td> -->
  <td td  width= 20%><?php echo "Stakeholder"; ?></td>
  <td td  width= 20%><?php echo "Item Name"; ?></td>
  <td td  width= 20%><?php echo "Quantity"; ?></td>
  <td td  width= 20%><?php echo "Price"; ?></td>
  <td td  width= 20%><?php echo "URL"; ?></td>
  <td td  width= 20%><?php echo "Details"; ?></td>

</tr>

</table>
    
    <?php
    while($row = mysql_fetch_assoc($result)) {
    
      ?>
      <form action="" method="post" name="frm">
        <table class="table">

<tr>
  <!-- <td><?php echo $row['SNo']; ?></td> -->
  <td td  width= 20%><?php echo $row['User']; ?></td>
  <td td  width= 20%><?php echo $row['itemName']; ?></td>
  <td td  width= 20%><?php echo $row['quantity']; ?></td>
  <td td  width= 20%><?php echo $row['price']; ?></td>
  <td td  width= 20%><?php echo $row['url']; ?></td>
  <td td  width= 20%><?php echo $row['itemDetails']; ?></td>
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


 </body>
</html>