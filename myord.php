<?php
session_start();
if(!isset($_SESSION['login_user']))
{
  echo "login first";
}
else
{
require_once 'include/DB_Functions.php';
include_once("Faculty.html");
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
<title>My Orders</title>
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
 <?php
    //echo "LISTED PRODUCTS";
    ?>
    <br><br>
    <?php
   $username = $_SESSION['login_user'];
   $query="SELECT * FROM LI_Orders WHERE stakeholder='$username'";

   $result=mysql_query($query) or die("query error");

   $num_rows = mysql_num_rows($result);
   //$query_data=mysql_fetch_array($result);
   if (mysql_num_rows($result) > 0) {
    // output data of each row
    ?>
    <br><br>
    <b>LISTED ITEMS</b><br><br>
    <table  table-layout: fixed; >

        <tr>
          <!-- <td  width= 20% > <?php echo "SNo"; ?> </td> -->
          <td width =2%> </td>

          <td  width= 20% > <b>Item Name </b> </td>
          <td  width= 25% > <b>Consumability </b> </td>
          <td  width= 25% > <b>Quantity </b> </td>
          <!-- <td  width= 25% > <b>Stakeholder </b> </td> -->
          <td  width= 25% > <b>Return</b> </td>
          <td  width= 25% > <b>Repair </b> </td>
        </tr>

     </table>
    <?php
    while($row = mysql_fetch_assoc($result)) {
      //$_SESSION['item1'] = $row['name'];
      $consumability = $row['consumability'];
      ?>
      <form action="" method="post" name="frm">
        <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
        
        <table class="table" >

<tr>
  <td > </td>
  <td  width = 25% > <?php echo $row['name']; ?> </td>
  <td  width = 25% > <?php echo $row['consumability']; ?> </td>
  <td  width = 25% > <?php echo $row['quantity']; ?> </td>

  <td  width = 25% > <button  type = "submit" name="Return" class="btn btn-success">Return</button></td>
  <td  width = 25% > <button name = "Repair" type = "submit" class="btn btn-success">Repair</button></td>
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
 <b>NON-LISTED PRODUCTS</b>
    <br><br>
    <?php
   $username = $_SESSION['login_user'];
   $query="SELECT * FROM NLI_Orders WHERE User='$username'";

   $result=mysql_query($query) or die("query error");

   $num_rows = mysql_num_rows($result);
   //$query_data=mysql_fetch_array($result);
   if (mysql_num_rows($result) > 0) {
    // output data of each row
    ?>
    <table   table-layout: fixed; >

        <tr>
          <!-- <td  width= 20% > <?php echo "SNo"; ?> </td> -->
          <td width = 2%> </td>
          <td  width= 39% > <b>ItemName </b> </td>
          <td  width= 37% > <b>Price </b> </td>
          <td  width= 37% > <b>Quantity </b> </td>
          <td  width= 40% > <b>Repair</b> </td>
        </tr>

     </table>
    <?php
    while($row = mysql_fetch_assoc($result)) {
      //$_SESSION['item1'] = $row['name'];
      //$consumability = $row['consumability'];
      ?>
      <form action="" method="post" name="frm">
        <input type="hidden" name="name" value="<?php echo $row['itemName']; ?>">
       <table class='table'>

<tr>
  <td width =2% > </td>
  <td  width = 40% > <?php echo $row['itemName']; ?> </td>
  <td  width = 40% > <?php echo $row['price']; ?> </td>
  <td  width = 40% > <?php echo $row['quantity']; ?> </td>
  <!-- <td  width = 50% > <button  type = "submit" name="Return" class="btn btn-success">Return</button></td> -->
  <td  width = 40% > <button name = "nRepair" type = "submit" class="btn btn-success">Repair</button></td>
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

 <b>APPROVAL PENDING</b>
    <br><br>
    <?php
   $username = $_SESSION['login_user'];
   $query="SELECT * FROM Approval_requests WHERE User = '$username'";
//echo "1";
   $result=mysql_query($query) or die("query error");
//echo "2";
   $num_rows = mysql_num_rows($result);
   //$query_data=mysql_fetch_array($result);
   if (mysql_num_rows($result) > 0) {
    // output data of each row
    ?>
      
      <b>Item Name</b>
    <?php
    while($row = mysql_fetch_assoc($result)) {
      //$_SESSION['item1'] = $row['name'];
      //$item_1 = $row[''];
      ?>
      <form action="" method="post" name="frm">
        <table>

<tr><td><input  class= "form-control" name="name" type="text" value="<?php echo $row['itemName']; ?>" size="10" readonly/></td></tr>

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
<?php
}
?>