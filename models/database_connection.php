
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

		$this->DB_SERVER = 'localhost';
		$this->DB_USERNAME = 'root';
		$this->DB_DATABASE = 'churchill_event_tickets';
		$this->DB_PASSWORD = '';
		$this->DB_PORT = '3306';
		$this->CHARSET = 'utf8mb4';

		try {
			$dsn = "mysql:host" . $this->DB_SERVER . "port" . $this->DB_PORT . ";dbname" . $this->DB_DATABASE . ";charset" . $this->CHARSET;
			$db = new PDO($dsn, $this->DB_USERNAME, $this->DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		} catch (PDOException $e) {
			echo "Connection Failed: " . $e->getMessage();
		}
	}
}
