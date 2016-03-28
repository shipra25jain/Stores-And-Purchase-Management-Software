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

    public function getNumStudentsInSlot($slot){
        
        $stmt = $this->conn->prepare("SELECT Student FROM SlotStudent WHERE SlotName=?");
        $stmt->bind_param("s", $slot);

        if ($stmt->execute()) {

            $stmt->bind_result($numStudent);
            $stmt->fetch();
            return $numStudent;
        } else {
            return NULL;
        }
    }

    //get number of student per slot on a gicen day 
    public function getNumStudentOnDay($day){

        $stmt = $this->conn->prepare("SELECT Slot, Time FROM Academic_Schedule WHERE Day=?");
        $stmt->bind_param("s", $day);

        if ($stmt->execute()) {

            $stmt->bind_result($slot,$time);
            $i=0;
            while($stmt->fetch()){
               $course[$i]["slot"] = $slot;
               $course[$i]["time"] = $time;
               $i++;
            }
            $stmt->close();

            $courselen = count($course);
            $i=0;
            while($courselen--){

                $numStudent = $this->getNumStudentsInSlot($course[$i]["slot"]);
                $studentSlotarray[$i]["time"] = $course[$i]["time"];
                $studentSlotarray[$i]["students"] = $numStudent;

                //echo $studentSlotarray[$i]["time"]."  ".$studentSlotarray[$i]["students"]."<br>";
                $i++;
            }

            return $studentSlotarray;
        } else {
            return NULL;
        }
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
        $result=mysql_query($query) or die("query error");

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
    public function register($SNo, $username, $password, $type, $Security_Question, $security_answer)
{
     $query="SELECT type FROM Login_details WHERE username = '$username' ";
      $result=mysql_query($query) or die("query error");

        $count=mysql_num_rows($result);
        if ($count==0) {
            $query = "INSERT INTO Login_details (SNo, username, password, type, SecurityQuestion, SecurityAnswer)
                    VALUES ('$SNo', '$username', '$password','$type', '$Security_Question', '$security_answer')";
                    // echo "creating problem!!!";
        $result=mysql_query($query) or die("query error");
        // echo "no problem!!!";
            return 1;
        }
        else
        {
            echo "Already registered!!";
            return 0;
        }
    
}

}

?>