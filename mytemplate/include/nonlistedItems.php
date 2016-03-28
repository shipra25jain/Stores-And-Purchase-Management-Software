<?php
//session_start();
require('/opt/lampp/htdocs/tpa/include/item.php');

class nonlistedItems extends item
{

    private $online_store_url;
    private $itemDetails;
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

    public function putInDB()
    {
        
        
    }