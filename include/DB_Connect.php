<?php

class DB_connect{
		private $conn;

		public function connect(){
			require_once 'include/Config.php';

			$this->conn  = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
			$db_selected = mysql_select_db('Store_Purchase', $this->conn);
		if (!$db_selected) {
    		die ('Can\'t use Store_Purchase Database: ' . mysql_error());
		}
			return $this->conn;
		}
}
	
?>