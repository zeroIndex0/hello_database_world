<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");  //DELETE request
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

// Instantiate DB and connect to it
$database = new Database();
$db = $database->connectToDatabase();

// Instantiate Post object
$post = new Post($db);

$post->id = isset($_GET["id"]) ? $_GET["id"] : die();

//delete the post
if ($post->delete()) {
  echo json_encode(
    array("message:" => "Post Deleted")
  );
} else {
  echo json_encode(
    array("message:" => "Post Not Deleted")
  );
}