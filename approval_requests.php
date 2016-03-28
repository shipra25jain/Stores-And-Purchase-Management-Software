<?php
session_start();
if(!isset($_SESSION['login_user']))
{
	echo "login first";
}
else
{
  include_once("Admin.html");
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
  		<br><br><br><br><br>
  	<div style="margin-bottom:10px" class="row"></div>
<?php
	if(isset($_POST['approve']) || isset($_POST['deny']))
		{
			$ID = $_POST['ID'];
			$User = $_POST['User'];
			//$Viewer = $_POST['Viewer'];
			$itemName = $_POST['itemName'];
			$quantity = $_POST['quantity'];
			$price= $_POST['price'];
			//$url = $_POST['url'];
			//$itemDetails = $_POST['itemDetails'];

			if(isset($_POST['approve'])){
				$status="approve";
			}
			else{
				$status="deny";
			}
			$Viewer = $_SESSION['login_user'];
			$not1=$notify->approve($ID,$User,$Viewer ,$itemName,$quantity,$price,$status);	
			if($not1!=true){
				$message = "Could not process the request";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}

			
			$notify_req=$notify->notify_requester($User,$Viewer ,$itemName,$quantity,$price,$status);
			if($notify_req!=true){
				$message = "Could notify the requester";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}

		$Ndetails=$notify->fetch_approval_requests();

		if(count($Ndetails)==0){
			$message = "No Approval Requests";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
?>
       <table class="table">
                <tr>
                    <th>
                        Item ID 
                    </th>
                    <th>
                        Item 
                    </th>
                    <th>
                        Requested by 
                    </th>
                    <th>
                        Price 
                    </th>
                    <th>
                        Quantity 
                    </th>
                    <th>
                        Approve 
                    </th>
                    <th>
                    	Deny
                    </th>
                </tr>
       
<?php
		for($i=0;$i<count($Ndetails);$i++)
		{	
?>
		
		<div >
			<form action="" method="post" role="form">
			<div >
			<br>
			
			<tr>
		   <td width =15% > <input class="form-control" name="ID" type="text" value="<?php echo $Ndetails[$i]["ID"]; ?>" size="20" readonly/> </td>
			<td width =15% > <input class="form-control" name="itemName" type="text" value="<?php echo $Ndetails[$i]["itemName"]; ?>" size="20" readonly/> </td>
			<td width =15% > <input class="form-control" name="User" type="text" value="<?php echo $Ndetails[$i]["User"]; ?>" size="20" readonly/> </td>
			<td width =15% > <input class="form-control" name="price" type="text" value="<?php echo $Ndetails[$i]["price"]; ?>" size="20" readonly/> </td>
			<td width =15% > <input class="form-control" name="quantity" type="text" value="<?php echo $Ndetails[$i]["quantity"]; ?>" size="20" readonly/> </td>
		    <td> <button style="width:45%" type="submit" name="approve" class="btn btn-success">Approve</button> </td>
		    <td> <button style="width:45%" type="submit" name="deny" class="btn btn-danger">Deny</button> </td>
			</tr>
			
			
			</div>
			<!-- <div class="row">
			<div class="col-md-offset-1">
			   <button style="width:45%" type="submit" name="approve" class="btn btn-success">Approve</button> 
			   <button style="width:45%" type="submit" name="deny" class="btn btn-danger">Deny</button> 
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