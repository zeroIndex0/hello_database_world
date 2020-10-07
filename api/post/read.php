<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

// Instantiate DB and Connect to it
$database = new Database();
$db = $database->connectToDatabase();

// Instantiate database object
$post = new Post($db);

//query the database using the read method
$result = $post->read();
//count the rows of the result
$rows = $result->rowCount();

//check if there is any data from the database
//if there are no rows, its an empty set
if ($rows > 0) {
  //create a data array
  $data_array = array();
  $data_array["data"] = array();

  //fetch the data
  // Fetches a row from a result set associated with a PDOStatement object. The fetch_style parameter determines how PDO returns the row. 
  // https://www.php.net/manual/en/pdostatement.fetch
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // extract the data
    // DO NOT use extract() on untrusted data
    // More info can be found on extract here:
    // https://www.php.net/manual/en/function.extract.php
    extract($row);

    //store each section of the row data into a temp array
    $row_item = array(
      "id" => $id,
      "title" => $title,
      "body" => $body,
      "author" => $author,
      "created_at" => $created_at
    );

    //push the item to the data array
    array_push($data_array["data"], $row_item);
  }
  //Turn the data_array result into json, then output
  echo json_encode($data_array);
} else {
  //There were no posts
  echo json_encode(
    array("Message:" => "No posts found")
  );
}
