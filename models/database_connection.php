
<?php
class dbconnection
{
	private $DB_SERVER;
	private $DB_USERNAME;
	private $DB_PASSWORD;
	private $DB_DATABASE;
	private $DB_PORT;
	private $CHARSET;

	protected function connectDb()
	{


		// local
		// $this->DB_SERVER = 'localhost';
		// $this->DB_USERNAME = 'root';
		// $this->DB_DATABASE = 'churchill_event_tickets';
		// $this->DB_PASSWORD = '';


		// production
		$this->DB_SERVER = 'https://remotemysql.com';
		$this->DB_USERNAME = 'CdEgjh5AXU';
		$this->DB_DATABASE = 'CdEgjh5AXU';
		$this->DB_PASSWORD = 'XoYnRHVRp2';
		$this->DB_PORT = '3306';
		$this->CHARSET = 'utf8mb4';

		try {
			// $dsn = "mysql:host" . $this->DB_SERVER . "port" . $this->DB_PORT . ";dbname" . $this->DB_DATABASE . ";charset" . $this->CHARSET;
			
			
			// $db = new PDO($dsn, $this->DB_USERNAME, $this->DB_PASSWORD);
			$db = new PDO("mysql:host=remotemysql.com;port=3306;dbname=CdEgjh5AXU", "CdEgjh5AXU", "XoYnRHVRp2");
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		} catch (PDOException $e) {
			echo "Connection Failed: " . $e->getMessage();
		}
	}
}


// $conn = new dbconnection();

// $conn->connectDb();