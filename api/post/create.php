<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");  //POST request
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

// Instantiate DB and connect to it
$database = new Database();
$db = $database->connectToDatabase();

// Instantiate Post object
$post = new Post($db);

//Get the raw post data of what was submitted
//further reading on this function 'file_get_contents' and the parameter 'php://input' aka wrappers
//  https://www.php.net/manual/en/function.file-get-contents.php
//  https://www.php.net/manual/en/wrappers.php.php
//Just to state again, this pulls the raw data that is being passed in
//from the request body. And i will be passing in json, so I have to decode the json.
$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;

//create the post
if ($post->create()) {
  echo json_encode(
    array("message:" => "Post Created")
  );
} else {
  echo json_encode(
    array("message:" => "Post Not Created")
  );
}