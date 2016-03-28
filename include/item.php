<?php
class item{
    private $conn;

    //constructor

    private $quantity=0;
    private $price;
    public  $name;
    public  $available=0;

 
    function __construct(){
            require_once 'DB_Connect.php';
            $db = new DB_Connect();
            $this->conn = $db->connect();
           // $this->itemID = $inputID; 
            //$query= "SELECT name FROM Inventory_items_DB where itemID = '$this->itemID'";
            //$result=mysql_query($query) or die("query error");
    		//$query_data=mysql_fetch_array($result);
    		//$this->name = $query_data['name'];
    }

    // destructor
    function __destruct() {
         
    }
public function setQuantity($numOrders)
{

	$this->quantity= $numOrders;

}



public function showSuccessMsg()
{
	?>
	<!DOCTYPE html>
	<html>
	<body>
	<button onclick="myFunction()">Confirm</button>
	<script>
	function myFunction() {
	    alert("Order Placed Successfully!!!");
	}
	</script>
	</body>
	</html>
<?php
}


public function showDelayMsg($count)
{
	?>
	<!DOCTYPE html>
	<html>
	<body>
	<button onclick="myFunction()">Confirm</button>
	<script>
	function myFunction() {
	    alert("there will be a delay!!!");
	}
	</script>
	</body>
	</html>
<?php
}




}
?>