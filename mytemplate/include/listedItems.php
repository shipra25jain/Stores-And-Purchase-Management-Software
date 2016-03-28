<?php
//session_start();
require('/opt/lampp/htdocs/tpa/include/item.php');

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
	    $result=mysql_query($query) or die("query error");
	    //echo "Riteek";
	    $available = 1;
	    $this->setQuantity($numOrders);
	    $this->showSuccessMsg();
	}
	else 
	{
		$available = 0;
		$query="UPDATE Inventory_items_DB SET quantity = '0' WHERE itemID='$this->itemID'";
	    echo "Quantity not enough";
	    $result=mysql_query($query) or die("query error");	
	    $this->setQuantity($numOrders);
	    $this->showDelayMsg($count);	
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
	$this->consumability = $this->getConsumability();
	$this->price = $this->getPrice();
	$this->updateQuantity($numOrders);
}

public function putinDB($Login_user, $myQuantity)
{
	//add timestamp also
	$query = "INSERT INTO LI_Orders(SNo, itemID, name, consumability,quantity, stakeholder)
              VALUES ('$SNo', '$this->itemID', '$this->name','$this->consumability', '$myQuantity','$Login_user')";
    $SNo = $SNo + 1;

              //echo "creating problem!!!";
    $result=mysql_query($query) or die("query error");
       // echo "no problem!!!";

}
}