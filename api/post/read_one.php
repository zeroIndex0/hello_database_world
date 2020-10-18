<?php

session_start();

if(!isset($_SESSION["read_one_entry_flag"])) {
  $_SESSION["read_one_entry_flag"] = false;
}

if (isset($_POST["edit_button_request"])) {

  include_once "../../config/Database.php";
  include_once "../../models/Post.php";

  // Instantiate DB and Connect to it
  $database = new Database();
  $db = $database->connectToDatabase();

  // Instantiate database object
  $post = new Post($db);

  $post->id = $_POST["edit_button_request"];

  //query the database using the read method
  $result = $post->read_one();

  //extract data
  //extract demands an array, if the id passed in the $_GET["id"]
  //doesnt exist, it wont be an array and we shouldnt extract.
  //so were checking if the fetch returns an array, if so then we have a
  //valid id, otherwise print that we didnt find the entry.
  $data = $result->fetch(PDO::FETCH_ASSOC);
  if (gettype($data) == "array") {
    extract($data);

    //create a data array on the extracted fetched result
    $read_one_entry = array(
      "id" => $post->id,
      "title" => $title,
      "body" => $body,
      "author" => $author,
      "created_at" => $created_at
    );

    $_SESSION["read_one_entry_flag"] = true; 

    $_SESSION["read_one_entry"] = $read_one_entry;

    echo "AUTHOR: " . $read_one_entry["author"];

    header("Location: http://localhost/hello_database_world");
  } else {
    echo "<h1>COULD NOT FIND POST</h1>";
    $_SESSION["read_one_entry_flag"] = false; 
  }
}





// // $read_one_entry_flag = false;

// if (isset($_POST["edit_button_request"])) {

//   include_once "../../config/Database.php";
//   include_once "../../models/Post.php";
// } else {
//   include_once "config/Database.php";
//   include_once "models/Post.php";
// }

// // Instantiate DB and Connect to it
// $database = new Database();
// $db = $database->connectToDatabase();

// // Instantiate database object
// $post = new Post($db);
// if(isset($_POST["edit_button_request"])){
//   echo "THE POST IS: " . $_POST["edit_button_request"];
// } else {
//   echo "FOUND NOTHING FOR POST";
// }
// $post->id = isset($_POST["edit_button_request"]) ? $_POST["edit_button_request"] : 'NULL';

// //query the database using the read method
// $result = $post->read_one();

// //extract data
// //extract demands an array, if the id passed in the $_GET["id"]
// //doesnt exist, it wont be an array and we shouldnt extract.
// //so were checking if the fetch returns an array, if so then we have a
// //valid id, otherwise print that we didnt find the entry.
// $data = $result->fetch(PDO::FETCH_ASSOC);
// if (gettype($data) == "array") {
//   extract($data);

//   //create a data array on the extracted fetched result
//   $read_one_entry = array(
//     "id" => $post->id,
//     "title" => $title,
//     "body" => $body,
//     "author" => $author,
//     "created_at" => $created_at
//   );

//   $read_one_entry_flag = true;

//   header("Location: http://localhost/hello_database_world");
// } else {
//   echo "<h1>COULD NOT FIND POST</h1>";
//   $read_one_entry_flag = false;
// }
// // }




// // Headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json");

// include_once "../../config/Database.php";
// include_once "../../models/Post.php";

// // Instantiate DB and Connect to it
// $database = new Database();
// $db = $database->connectToDatabase();

// // Instantiate database object
// $post = new Post($db);

// $post->id = isset($_GET["id"]) ? $_GET["id"] : die();

// //query the database using the read method
// $result = $post->read_one();

// //extract data
// //extract demands an array, if the id passed in the $_GET["id"]
// //doesnt exist, it wont be an array and we shouldnt extract.
// //so were checking if the fetch returns an array, if so then we have a
// //valid id, otherwise print that we didnt find the entry.
// $data = $result->fetch(PDO::FETCH_ASSOC);
// if (gettype($data) == "array") {
//   extract($data);

//   //create a data array on the extracted fetched result
//   $data_array = array(
//     "id" => $post->id,
//     "title" => $title,
//     "body" => $body,
//     "author" => $author,
//     "created_at" => $created_at
//   );
//   //encode to json
//   echo json_encode($data_array);
// } else {
//   echo json_encode(
//     array("Message: " => "Entry Not found")
//   );
// }
