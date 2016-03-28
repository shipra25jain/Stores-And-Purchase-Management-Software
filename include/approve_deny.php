<?php

class approve_deny{

	//constructor
	function __construct(){

		require_once 'include/DB_Functions.php';
		$db = new DB_Functions();
		$this->db = $db;
	}

	// destructor
    function __destruct() {
         
    }

    public function approve($SNo,$User,$Viewer ,$itemName,$quantity,$price,$status)
    {
    	//mail needs server
        //mail("ug201213026@iitj.ac.in", "RE:request", $status , "From: ug201213026@iitj.ac.in");
        $query="SELECT * FROM Approval_requests WHERE  ID = '$SNo' ";
      $result=mysql_query($query) or die("query error in approve");
      $query_data=mysql_fetch_array($result);
      $fetch_not = $this->db->remove_request($SNo);
        
        if($status=="approve"){
            $url = $query_data['url'];
            $itemDetails = $query_data['itemDetails'];
            $this->db->addNLIorders($User,$itemName,$quantity,$price,$url,$itemDetails);
        }

    	if($fetch_not==true)
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function remove_notifications($ID)
    {

        $this->db->removeNotifications($ID);
        return true;
    }

    public function fetch_notifications($Viewer)
    {
        $Ndetails = null;
        $Ndetails = $this->db->fetchNotifications($Viewer);
        return $Ndetails;

    }
    public function fetch_approval_requests ()
    {
        $Ndetails=$this->db->get_requests();
        return $Ndetails;
    }

    public function notify_requester($User,$Viewer ,$itemName,$quantity,$price,$status)
    {
        $Viewer = $User;
        $send=$this->db->convey_requester($User,$Viewer ,$itemName,$quantity,$price,$status);
        if($send==true)
            return true;
        else
            return false;
    }
}

?>