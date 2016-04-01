<?php
session_start();
if(!isset($_SESSION['login_user']))
{
  echo "login first";
}
else
{
  include_once("Faculty.html");
  require_once 'include/approve_deny.php';

  $notify = new approve_deny();
  ?>
<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Store and Purchase</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/datepicker.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jquery-1.9.1.min.js"></script>  
      <style type="text/css">
      </style>
    </head>
    <body>
      <br><br><br><br>
    <div style="margin-bottom:10px" class="row"></div>
<?php
$Viewer = $_SESSION['login_user'];  
  if(isset($_POST['seen']))
    {
      $ID = $_POST['ID'];
      //$User = $_POST['User'];
      //$Viewer = $_POST['Viewer'];
      $itemName = $_POST['itemName'];
      $quantity = $_POST['quantity'];
      $price= $_POST['price'];
      //$url = $_POST['url'];
      //$itemDetails = $_POST['itemDetails'];

        $status="seen";
            
      $notify_req=$notify->remove_notifications($ID);
      if($notify_req!=true){
        $message = "Could not remove the notifications";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
    }

    $Ndetails=$notify->fetch_notifications($Viewer);

    if(count($Ndetails)==0){
      $message = "No notifications";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
?>
     <table class="table">
                <tr>
                    <th></th>
                    <th>
                        Item ID 
                    </th>
                    <th>
                        Item 
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Clear
                    </th>
                </tr>
<?php
    for($i=0;$i<count($Ndetails);$i++)
    { 
?>
    
    <div >
      <form action="" method="post" role="form">
      <div class="row">
      
      <table class= 'table'>
      <tr>
        <td width = 2%></td>
      <td width=3%><input class="form-control" name="ID" type="text" value="<?php echo $Ndetails[$i]["ID"]; ?>" size="20" readonly/></td>
      <td width=10%><input class="form-control" name="itemName" type="text" value="<?php echo $Ndetails[$i]["itemName"]; ?>" size="20" readonly/></td>
      
      <td width=10%><input class="form-control" name="price" type="text" value="<?php echo $Ndetails[$i]["price"]; ?>" size="20" readonly/></td>
      <td width=10%><input class="form-control" name="quantity" type="text" value="<?php echo $Ndetails[$i]["quantity"]; ?>" size="20" readonly/></td>
      <td width=10%><input class="form-control" name="status" type="text" value="<?php echo $Ndetails[$i]["status"]; ?>" size="20" readonly/></td>
      <td width=10%> <button style="width:45%" type="submit" name="seen" class="btn btn-success">Clear</button> </td>
      </tr>
     
      
      </div>
      <!-- <div class="row">
      <div class="col-md-offset-1">
        
      </div>
      </div>  -->  
      </form>
    </div>

<?php
  }
?>
 </table>
</body>
</html>
<?php
}
?>