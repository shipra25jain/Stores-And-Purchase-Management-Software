<?php
session_start();
include_once("Faculty.html");
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
<title>Purchase</title>
</head>

<body>

<div id="header">
  <br>
  <br>
  <br>
  <br>
  <br>
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


<form action="purchase_NLItems.php">
 <!--  <fieldset>
    <legend>Item Information</legend>
    Item<br>
    <input type="text" name="itemName" value=" ">
    <br>
    Online Store URL<br>
    <input type="text" name="URL" value=" ">
    <br>
    Item Details<br>
    <input type="text" name="itemDetails" value=" ">
    <br>
    Price<br>
    <input type="float" name="itemPrice" value=" ">
    <br>
    Quantity<br>
    <input type="integer" name="itemQuantity" value=" ">
    <br>
    <br>
    <input type="submit" name= "sub" value="Submit">
  </fieldset> -->
                  <table class="table">
                    <tr>
                        <td>
                            Item :
                        </td>
                        <td>
                            <input type="text" name="itemName" value=" ">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Online Store URL :
                        </td>
                        <td>
                            <input type="text" name="URL" value=" ">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Item Details :
                        </td>
                        <td>
                            <input type="text" name="itemDetails" value=" ">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Price :
                        </td>
                        <td>
                            <input type="float" name="itemPrice" value=" ">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Quantity :
                        </td>
                        <td>
                            <input type="integer" name="itemQuantity" value=" ">
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>
                            <input type="submit" name= "sub" value="Submit">
                        </td>
                    </tr>
                </table>
</form>

</body>
</html>
<?php
  if(isset($_POST['itemName'])&&isset($_POST['itemQuantity'])&&isset($_POST['itemDetails'])&&isset($_POST['itemPrice'])&&isset($_POST['URL'])&&isset($_POST['sub']))
  {
  	$itemName = $_POST['itemName'];
    $quantity = $_POST['itemQuantity'];
    $price = $_POST['itemPrice'];
    $url = $_POST['URL'];
    $itemDetails = $_POST['itemDetails'];
    $nli = new nonlistedItems();
    $nli->setAttributes($itemName,$quantity,$price,$url,$itemDetails);
    $nli->putinDB();



  }
 ?>
