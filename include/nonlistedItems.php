<?php
//session_start();
require('item.php');

class nonlistedItems extends item
{

    private $online_store_url;
    private $itemDetails;
    //public static $SNo = 1;
    //constructor
    function __construct(){
    	parent::__construct();
    }

    // destructor
    function __destruct() {
         
    }

    public function setAttributes($itemName,$quantity,$price,$url,$itemDetails)
    {
        $this->online_store_url = $url;
        $this->itemDetails = $itemDetails;
        $this->quantity = $quantity;
        $this->price = $price ;
        $this->name =$itemName ;
    }

    public function putInDB($myQuantity ,$Login_user)
    {
        $query = "SELECT * FROM Institute_member_DB WHERE username = '$Login_user' ";
        $result=mysql_query($query) or die("query error");
        $row = mysql_fetch_array($result);
        $grant = $row['grant1'];
       //echo $this->price;
       //echo "hi";
        //echo $grant;
        $myprice = $this->price;
        $qt = $this->quantity;
        $cost = ($myprice * $qt);
        if($cost > $grant)
        {
            echo "Not Enough Grant!!";
            return;
        }


        echo "In function";    
    
        $query = "INSERT INTO Approval_requests( User,  itemName, quantity, price, url, itemDetails) 
        VALUES ('$Login_user','$this->name', '$myQuantity', '$this->price','$this->online_store_url','$this->itemDetails')";
  

      //        echo "creating problem!!!";
    $result=mysql_query($query) or die("query error");

    $remaining = $grant-$cost;
    $query = "UPDATE Institute_member_DB SET grant1= '$remaining' WHERE username='$Login_user' ";
  

      //        echo "creating problem!!!";
    $result=mysql_query($query) or die("query error");
    
        
    }
}