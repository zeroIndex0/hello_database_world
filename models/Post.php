<?php
class Post {
  //Private values
  //we only have one table name, but lets make it a variable anyway.  The ability to expand and be robust, right
  private $table_name = "helloworld";
  private $connection;


  //Database row values
  //We have; id, title, body, author, created_at
  public $id;
  public $title;
  public $body;
  public $author;
  public $created_at;

  //constructor from a passed in Database object
  public function __construct($db) {
    //set our Post connection to the Database object
    $this->connection = $db;
  }

  public function create() {
    //You really have to mind your spacing here
    // if you concat and leave a space out, you could spend a while
    // trying to fix errors you aren't quite sure where they are coming from
    // I had to add a space before 'SET' remove that one space and the execute fails with an error on incorrect syntax
    // yet you wont see any red squiggly lines.  It can be tough to spot, so remember spaces
    $query =
      "INSERT INTO " .
      $this->table_name .
      " SET
      title = :title,
      body = :body,
      author = :author";

    //prepare statement
    $stmt = $this->connection->prepare($query);

    //clean input
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->body = htmlspecialchars($this->body);
    $this->author = htmlspecialchars(strip_tags($this->author));

    //bind input
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":body", $this->body);
    $stmt->bindParam(":author", $this->author);

    //execute the query
    if ($stmt->execute()) {
      return true;
    } else {
      //print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
    }
  }

  public function read() {
    $query =
      "SELECT
      id,
      title,
      body,
      author,
      created_at
    FROM " . $this->table_name;

    //prepare
    $stmt = $this->connection->prepare($query);
    //execute
    $stmt->execute();

    return $stmt;
  }

  public function read_one() {
    $query =
      "SELECT 
      id,
      title,
      body,
      author,
      created_at
    FROM " . $this->table_name . " 
    WHERE 
    id = :id";

    //prepare statement
    $stmt = $this->connection->prepare($query);
    //bind params
    $stmt->bindParam("id", $this->id);
    //execute
    $stmt->execute();

    return $stmt;
  }

  public function update() {
    $query = "UPDATE " . $this->table_name .
      " SET 
      title = :title,
      body = :body,
      author = :author
    WHERE 
      id = :id";

    $stmt = $this->connection->prepare($query);
    //clean input
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->body = htmlspecialchars($this->body);
    $this->author = htmlspecialchars(strip_tags($this->author));
    //bind params
    $stmt->bindParam("id", $this->id);
    $stmt->bindParam("title", $this->title);
    $stmt->bindParam("body", $this->body);
    $stmt->bindParam("author", $this->author);

    //execute the query
    if ($stmt->execute()) {
      return true;
    } else {
      //print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
    }
  }

  public function delete() {
    $query = "DELETE FROM " . $this->table_name .
      " WHERE id = :id";

    $stmt = $this->connection->prepare($query);
    //clean input
    $this->id = htmlspecialchars(strip_tags($this->id));
    //bind params
    $stmt->bindParam("id", $this->id);

    //execute the query
    if ($stmt->execute()) {
      return true;
    } else {
      //print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
    }
  }
}
