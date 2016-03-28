<?php
session_start();
if(!isset($_SESSION['login_user']))
{
  echo "login first";
}
else
{
include_once("Faculty.html");
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
<title>Purchase</title>
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


<form action="purchase_NLItems.php" method="post" name="frm">
  <fieldset>
    <legend>Item Information</legend>
    Item<br>
    <input name="itemName" type="text" size="40" /><br>

    Online Store URL<br>
    <input name="URL" type="text" size="40" /><br>
    Item Details<br>
    <input name="itemDetails" type="text" size="40" /><br>
    Price<br>
    <input name="itemPrice" type="float"  size="40" /><br>
    Quantity<br>
    <input name="itemQuantity" type="number" class="form-control"  size="40" /><br>
    <br>
    <input  name= "sub" type="submit" value="submit"/>
  </fieldset>
</form>

<?php
  if(isset($_POST['sub']))
  {
    //echo"testing";
    $login_user = $_SESSION['login_user'];
    $itemName = $_POST['itemName'];
    $quantity = $_POST['itemQuantity'];
    $price = $_POST['itemPrice'];
    $url = $_POST['URL'];
    $itemDetails = $_POST['itemDetails'];
    $nli = new nonlistedItems();
    $nli->setAttributes($itemName,$quantity,$price,$url,$itemDetails);
    $nli->putinDB($quantity,$login_user);
    //echo "success out";



  }
 ?>
 </body>
</html>

<?php
}
?>
