<?php 

	
	class DBConnect{
		protected $host = "localhost";
		protected $username = "root";
		protected $password = "";
		public $db_name = "citation";		
		public $conn;
		public function getConnection(){
			try {
				$this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
				// set the PDO error mode to exception
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//			echo "Connected successfully";
//				return $conn;
			}
			catch(PDOException $e)
			{
				echo "Connection failed: " . $e->getMessage();
			}
			return $this->conn;
		}
	}
?>