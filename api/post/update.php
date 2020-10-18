<?php

if (isset($_POST["submit_update_request"])) {
  include_once "../../config/Database.php";
  include_once "../../models/Post.php";

  // Instantiate DB and connect to it
  $database = new Database();
  $db = $database->connectToDatabase();

  // Instantiate Post object
  $post = new Post($db);


  //The id comes from the button
  $post->id = $_POST["submit_update_request"];
  //get the input from the user.
  $post->title = isset($_POST["form_title"]) ? $_POST["form_title"] : die();
  $post->body = isset($_POST["form_body"]) ? $_POST["form_body"] : die();
  $post->author = isset($_POST["form_author"]) ? $_POST["form_author"] : die();

  // print_r($post);

  //update the post
  if ($post->update()) {
    header("Location: http://localhost/hello_database_world");
  } else {
    echo "<h1>POST NOT UPDATED</h1>";
  }

}



// // Headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json");
// header("Access-Control-Allow-Methods: PUT");  //PUT request
// header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

// include_once "../../config/Database.php";
// include_once "../../models/Post.php";

// // Instantiate DB and connect to it
// $database = new Database();
// $db = $database->connectToDatabase();

// // Instantiate Post object
// $post = new Post($db);

// //Get the raw post data of what was submitted
// //further reading on this function 'file_get_contents' and the parameter 'php://input' aka wrappers
// //  https://www.php.net/manual/en/function.file-get-contents.php
// //  https://www.php.net/manual/en/wrappers.php.php
// //Just to state again, this pulls the raw data that is being passed in
// //from the request body. And i will be passing in json, so I have to decode the json.
// $data = json_decode(file_get_contents("php://input"));

// $post->id = $data->id;
// $post->title = $data->title;
// $post->body = $data->body;
// $post->author = $data->author;

// //update the post
// if ($post->update()) {
//   echo json_encode(
//     array("message:" => "Post Updated")
//   );
// } else {
//   echo json_encode(
//     array("message:" => "Post Not Updated")
//   );
// }