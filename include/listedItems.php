<?php
//session_start();
require('include/item.php');

class listedItems extends item
{
    public $itemID;
    private $sharability;
    private $consumability;
    public static $SNo = 1;
    //constructor
    function __construct($myID){
    	parent::__construct();
    	$this->itemID = $myID;
    }

    // destructor
    function __destruct() {
         
    }

public function setItemName_ID($itemName)
{
	$this->name = $itemName;
	//$query="SELECT itemID FROM Inventory_items_DB WHERE name='$itemName'";
	//$result=mysql_query($query) or die("query error");
	//$query_data=mysql_fetch_array($result);
	//$this->itemID = $query_data['itemID'];
}
 public function putinDB_increase($Login_user, $myQuantity)
{
  //add timestamp also
 
   
      $query = "SELECT * FROM Inventory_items_DB WHERE name = '$this->name'";
    $result=mysql_query($query) or die("query error");
    $row = mysql_fetch_assoc($result);
    $number1 = $row['quantity'];
    $number = $number1 + $myQuantity;
    $query = "UPDATE Inventory_items_DB SET quantity = '$number' WHERE name = '$this->name'";
    $result=mysql_query($query) or die("query error");
   
  
}
public function updateQuantity($numOrders)
{
	$query="SELECT quantity FROM Inventory_items_DB WHERE itemID='$this->itemID'";
    $result1=mysql_query($query) or die("query error");
    $query_data1=mysql_fetch_array($result1);
    $quantityInv = $query_data1['quantity'];
	$count= $quantityInv - $numOrders;
	if($count>-1)
	{
		$query="UPDATE Inventory_items_DB SET quantity = '$count' WHERE itemID='$this->itemID'";
		echo "ok";
	    $result=mysql_query($query) or die("query error");
	    $available = 1;
	    $this->setQuantity($numOrders);
	    $this->showSuccessMsg();
	    return 1;
	}
	else 
	{
		$available = 0;
		$query="UPDATE Inventory_items_DB SET quantity = '0' WHERE itemID='$this->itemID'";
		echo "quantity not enough";
	    $result=mysql_query($query) or die("query error");	
	    $this->setQuantity($numOrders);
	    $this->showDelayMsg($count);	
	    return 0;
	    //also add send alert to admin part
	}
}

public function getQuantity()
{	
	$query="SELECT quantity FROM Inventory_items_DB WHERE itemID='$this->itemID'";
    $result=mysql_query($query) or die("query error");
    $query_data=mysql_fetch_array($result);
    return $query_data['quantity'];
}
public function getSharability()
{
	$query="SELECT sharability FROM Inventory_items_DB WHERE itemID='$this->itemID'";
    $result=mysql_query($query) or die("query error");
    $query_data=mysql_fetch_array($result);
    return $query_data['sharability'];
}
public function getConsumability()
{
  	$query="SELECT consumability FROM Inventory_items_DB WHERE itemID='$this->itemID'";
    $result=mysql_query($query) or die("query error");
    $query_data=mysql_fetch_array($result);
    return $query_data['consumability'];

}
public function getPrice()
{
	$query="SELECT price FROM Inventory_items_DB WHERE itemID='$this->itemID'";
    $result=mysql_query($query) or die("query error");
    $query_data=mysql_fetch_array($result);
    return $query_data['price'];
}

public function setAttributes($itemName,$numOrders)
{
	$this->setItemName_ID($itemName);
	$this->sharability = $this->getSharability();
	//echo "2";
	$this->consumability = $this->getConsumability();
	//echo "3";
	//$this->price = $this->getPrice();
	//echo "4";
	$check_min_quant = $this->updateQuantity($numOrders);
	return $check_min_quant;
}

public function putinDB($Login_user, $myQuantity)
{
	//add timestamp also
   $count1 = 0;
   $query = "SELECT * FROM LI_Orders where stakeholder = '$Login_user'";
   $result = mysql_query($query) or die("query error");
   $count1 = mysql_num_rows($result);
   //echo $count1;
  if($count1>0)
	{$query = "SELECT * FROM LI_Orders WHERE name = '$this->name' AND stakeholder = '$Login_user'";
  	$result=mysql_query($query) or die("query error");
  	$count = mysql_num_rows($result);
    //echo $count;
  	if($count>0)
  	{
  	$query = "SELECT quantity FROM LI_Orders WHERE name = '$this->name' AND stakeholder = '$Login_user'";
  	$result=mysql_query($query) or die("query error");
  	$row = mysql_fetch_assoc($result);
  	$number = $row['quantity'];
  	$number = $number + $myQuantity;
  	$query = "UPDATE LI_Orders SET quantity = '$number' WHERE name = '$this->name' AND stakeholder = '$Login_user'";
  	$result=mysql6_query($query) or die("query error1");
  	}
    else
    {
//echo "I am here";
      //echo $this->itemID;
      //echo $this->name;
  $query = "INSERT INTO LI_Orders(itemID, name, consumability,quantity, stakeholder) VALUES ('$this->itemID', '$this->name','$this->consumability', '$myQuantity','$Login_user')";
  $result=mysql_query($query) or die("query error2");
       // echo "no problem!!!";
     }

   } 
  	else
  	{
       //echo $Login_user;
      //echo $myQuantity;

	$query = "INSERT INTO LI_Orders(itemID, name, consumability, quantity, stakeholder) VALUES ('$this->itemID', '$this->name','$this->consumability', '$myQuantity','$Login_user')";

    $result=mysql_query($query) or die("query error3");
       // echo "no problem!!!";
     }
}
}