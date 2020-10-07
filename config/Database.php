<?php
class Database {
  private $host = "localhost";
  //only need the port if you have to change from the default 3306
  private $port = "3307";
  private $db_name = "hello_database_world";
  private $username = "root";
  private $password = "";
  private $connection;

  public function connectToDatabase() {
    //first, flush the connection
    $this->connection = null;

    try {
      $this->connection = new PDO(
        "mysql:host=" . $this->host .
          ";port=" . $this->port .
          ";dbname=" . $this->db_name,
        $this->username,
        $this->password
      );

      //get error information, if any, and throw an exception
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $error) {
      echo "Connection Error: " . $error->getMessage();
    }

    return $this->connection;
  }
}
