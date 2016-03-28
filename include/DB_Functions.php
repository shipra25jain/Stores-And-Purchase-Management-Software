<?php

class DB_Functions{
    private $conn;

    //constructor

    function __construct(){
            require_once 'DB_Connect.php';

            $db = new DB_Connect();
            $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
         
    }

    public function removeNotifications($ID)
  {
        $query = "DELETE FROM Notifies WHERE ID='$ID'";
        $result = mysql_query($query) or die(" query error2");
     return true ;
  }

  public function fetchNotifications($Viewer)
 {
    $Ndetails = null;   
        $login_user = $_SESSION['login_user'];
        $query="SELECT * from Notifies where Viewer = '$Viewer'";
        $result=mysql_query($query) or die("query error");
        $num_rows = mysql_num_rows($result);
        $i = 0;
        if (mysql_num_rows($result) > 0) 
        {
           while($row = mysql_fetch_assoc($result)) 
           {
                 $Ndetails[$i]["ID"]=$row["ID"];
                 //$Ndetails[$i]["User"]=$row["User"];
                 $Ndetails[$i]["itemName"] = $row["itemName"];
                 $Ndetails[$i]["quantity"] = $row["quantity"];
                 $Ndetails[$i]["price"] = $row["price"];
                 $Ndetails[$i]["status"] = $row["status"];
                    $i++;
           }      

        }
        return $Ndetails;
}


public function remove_request($id)
    {
        $query = "DELETE FROM Approval_requests WHERE ID='$id'";
        $result = mysql_query($query) or die(" query error2");
     return true ;
    }



 public function convey_requester($User,$Viewer ,$itemName,$quantity,$price,$status)
    {
        //$t = 1;
        $query = "INSERT INTO Notifies(User,itemName,Viewer,quantity,price,status) 
                VALUES('$User','$itemName','$Viewer','$quantity','$price','$status')" ;
        $result = mysql_query($query) or die("query error44") ;
    return true;
    }


 public function get_requests()
    {
        $Ndetails = null;   
        $login_user = $_SESSION['login_user'];
        $query="SELECT ID,User,Viewer,itemName,quantity,price,status from Approval_requests where Viewer = '$login_user'";
        $result=mysql_query($query) or die("query error");
        $num_rows = mysql_num_rows($result);
        $i = 0;
        if (mysql_num_rows($result) > 0) 
        {
             while($row = mysql_fetch_assoc($result)) 
             {
                         $Ndetails[$i]["ID"]=$row["ID"];
                         $Ndetails[$i]["User"]=$row["User"];
                         $Ndetails[$i]["itemName"] = $row["itemName"];
                         $Ndetails[$i]["quantity"] = $row["quantity"];
                         $Ndetails[$i]["price"] = $row["price"];
                         $Ndetails[$i]["status"] = $row["status"];
                         $i++;
            }      

       }
        return $Ndetails;
    }

    public function addNLIorders($User,$itemName,$quantity,$price,$url,$itemDetails)
    {//create database NLI_Orders

        $query = "INSERT INTO NLI_Orders(itemName,User,quantity,price,url, itemDetails)
             VALUES ('$itemName','$User','$quantity','$price','$url','$itemDetails')";
        $result = mysql_query($query) or die("query erroradd_NLI_ORDERs");
    }










    //check credentials 
 /*   public function checkCredentials($username,$password){ 


        echo "username: ".$username."  password ".$password."<br>";
        $stmt = $this->conn->prepare("SELECT type FROM Login_details WHERE username=? and password=?");
        $stmt->bind_param("ss", $username,$password);

        if($stmt->execute()){
            $stmt->bind_result($type);
            $stmt->fetch();
            echo "if in the loop type ".$type."<br> ";
            return $type;

        }else{

            return null;
        } */

    public function checkCredentials($username, $password){
        $query="select type from Login_details where username='$username' and password='$password'";
        $result=mysql_query($query) or die("query error-3");

        $count=mysql_num_rows($result);
    if($count>0)
    {
        echo "login sucess ";
        $_SESSION['login_user']=$username;
        $query_data=mysql_fetch_array($result);
        $_SESSION['utype']=$query_data['type'];
        $usertype = $query_data['type'];
        //echo $_SESSION['utype'];

        return $usertype ;
    }
    else
    {
        echo "<br>";
        
    }

    return 0;

    }

   
    public function getSecurityQuestion($username){
        $query="select SecurityQuestion from Login_details where username='$username'";
        $result=mysql_query($query) or die("query error");
        $query_data=mysql_fetch_array($result);
        $_SESSION['SecQ']=$query_data['SecurityQuestion'];
        $SecQ = $query_data['SecurityQuestion'];
        return $SecQ ;
    }
    public function checkSecurityAnswer($SecA, $username)
    {
        $query="select SecurityAnswer from Login_details where username='$username'";
        $result=mysql_query($query) or die("query error");
        $query_data=mysql_fetch_array($result);
        $_SESSION['SecA']=$query_data['SecurityAnswer'];
        if($_SESSION['SecA']==$SecA)   
           return 1;
        else
           return 0;   
    }
    
  
public function checkUser($username){
    
    $query="SELECT * FROM Login_details WHERE username = '$username' ";
      $result=mysql_query($query) or die("query error");

        $count=mysql_num_rows($result);
        if($count>0)
        {
            echo "already registered!!";
            return 4;
        }

    
       $query="SELECT * FROM Institute_member_DB WHERE username = '$username' ";
      $result=mysql_query($query) or die("query error");
        $count=mysql_num_rows($result);

    if($count>0)
    {
        
        $_SESSION['login_user']=$username;
        $query_data=mysql_fetch_array($result);
        $_SESSION['utype']=$query_data['type'];
        $_SESSION['serial'] = $query_data['SNo'];
        $usertype = $query_data['type'];
        return 1;
        //echo $_SESSION['utype'];
        
    }
    else
    {
        echo "<br>";
        
    }

    return 0;

    }
    public function Register($SNo, $username, $password, $type, $Security_Question, $security_answer)
{
     $query="SELECT type FROM Login_details WHERE username = '$username' ";
      $result=mysql_query($query) or die("query error");

        $count=mysql_num_rows($result);
        if ($count==0) {
            $query = "INSERT INTO Login_details (SNo, username, password, type, SecurityQuestion, SecurityAnswer)
                    VALUES ('$SNo', '$username', '$password','$type', '$Security_Question', '$security_answer')";
                    echo "creating problem!!!";
        $result=mysql_query($query) or die("query error3");
        echo "no problem!!!";
            return 1;
        }
        else
        {
            echo "Already registered!!";
            return 0;
        }
    
}

 public function Return_item()
{
    $username = $_SESSION['login_user'];
  $item = $_SESSION['item1'];
   $query="SELECT quantity FROM LI_Orders WHERE stakeholder='$username' AND name = '$item'";

   $result=mysql_query($query) or die("query error");



//$_SESSION['myid'] = $value->id;

   $num_rows = mysql_num_rows($result);
   //$query_data=mysql_fetch_array($result);
   $row = mysql_fetch_assoc($result);
   $quantity = $row["quantity"];
   //echo $quantity;
   //echo $item."quantity in li ord = ".$quantity."   ";
   $return_quantity = $_SESSION['return_quantity'];
   //echo "quantity to be ret = ".$return_quantity."   ";
   if($quantity == $return_quantity)
   {
    echo "Scuccessful!! Items will be collected soon!";
   $query="DELETE FROM LI_Orders WHERE stakeholder='$username' AND name = '$item'";
    $result=mysql_query($query) or die("query error");
 }
 else if ($quantity > $return_quantity) {
    echo "Scuccessful!! Items will be collected soon!";
    $quantity = $quantity - $return_quantity;
     $query="UPDATE LI_Orders SET quantity = '$quantity' WHERE stakeholder='$username' AND name = '$item'";

   $result=mysql_query($query) or die("query error");
 }
 else
 {
    echo "Invalid!! Quantity being returned is greater than the quantity you have!! Please check!!";
    return;
 }
    $query="SELECT quantity FROM Inventory_items_DB WHERE name = '$item'";

   $result=mysql_query($query) or die("query error");
   $row = mysql_fetch_assoc($result);
   $inv_quantity = $row['quantity'];
   $inv_quantity = $inv_quantity + $return_quantity;
   $query="UPDATE Inventory_items_DB SET quantity = '$inv_quantity' WHERE name = '$item'";

   $result=mysql_query($query) or die("query error");
}



 public function Repair_nl_item()
{
    $username = $_SESSION['login_user'];
  $item = $_SESSION['item1'];
   $query="SELECT quantity FROM NLI_Orders WHERE stakeholder='$username' AND name = '$item'";

   $result=mysql_query($query) or die("query error");



//$_SESSION['myid'] = $value->id;

   $num_rows = mysql_num_rows($result);
   //$query_data=mysql_fetch_array($result);
   $row = mysql_fetch_assoc($result);
   $quantity = $row["quantity"];
   //echo $quantity;
   //echo $item."quantity in li ord = ".$quantity."   ";
   $return_quantity = $_SESSION['return_quantity'];
   //echo "quantity to be ret = ".$return_quantity."   ";
   if($quantity == $return_quantity)
   {
    echo "Scuccessful!! Items will be sent to repair!";
   /*$query="DELETE FROM LI_Orders WHERE stakeholder='$username' AND name = '$item'";
    $result=mysql_query($query) or die("query error");*/
 }
 else if ($quantity > $return_quantity) {
    echo "Scuccessful!! Items will be sent to repair!";
    /*$quantity = $quantity - $return_quantity;
     $query="UPDATE LI_Orders SET quantity = '$quantity' WHERE stakeholder='$username' AND name = '$item'";

   $result=mysql_query($query) or die("query error");*/
 }
 else
 {
    echo "Invalid!! Quantity requested to be sent to repair is greater than the quantity you have!! Please check!!";
    return;
 }
    /*$query="SELECT quantity FROM Inventory_items_DB WHERE name = '$item'";

   $result=mysql_query($query) or die("query error");
   $row = mysql_fetch_assoc($result);
   $inv_quantity = $row['quantity'];
   $inv_quantity = $inv_quantity + $return_quantity;
   $query="UPDATE Inventory_items_DB SET quantity = '$inv_quantity' WHERE name = '$item'";

   $result=mysql_query($query) or die("query error");*/
}

public function Suggestions($login_user, $suggestions)
{
  $query="INSERT INTO Suggestions(username, suggestions) VALUES ('$login_user', '$suggestions')";
  $result=mysql_query($query) or die("query error");
  echo "Thank you for your valuable suggestions!!";
  return;
}


}

?>