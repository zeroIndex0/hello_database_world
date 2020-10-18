<?php

//The include doesn't go back two folders, due to the main include being called from the base folder
//so the path for the include chain starts at the base folder.  Therefore if you say to go back two folders
//it jumps two folders before the root folder, or base folder.  I don't know the correct term for the main folder.
include_once "config/Database.php";
include_once "models/Post.php";


// Instantiate DB and Connect to it
$database = new Database();
$db = $database->connectToDatabase();

// Instantiate database object
$post = new Post($db);

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
  //there is no need for a return or header() because I am using the variable created from this file
  //when i include it from index.php.  I could add session variables and a header return on the show_posts
  //button press, but for now this seems to work perfectly fine.
}