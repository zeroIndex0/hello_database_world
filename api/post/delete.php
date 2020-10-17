<?php


if (isset($_POST["delete_button_request"])) {
  include_once "../../config/Database.php";
  include_once "../../models/Post.php";

  // Instantiate DB and connect to it
  $database = new Database();
  $db = $database->connectToDatabase();

  // Instantiate Post object
  $post = new Post($db);

  // $post->id = $_POST["data-delete-id"];

  // $button_stuffs = $_POST["delete_button_request"];
  // echo $button_stuffs["data-delete-id"];

  // foreach ($_POST as $param_name => $param_val) {
  //   echo "Param: $param_name; Value: $param_val<br />\n";
  // }

  //There should only be one value that exists in this button request
  // echo "<h1> ID to delete: " . $_POST["delete_button_request"];

  // echo "<h1This should be the post id" . $_POST["data-delete-id"] . "</h1>"; 

  $post->id = $_POST["delete_button_request"];

  //delete the post
  if ($post->delete()) {

    header("Location: http://localhost/hello_database_world");
  } else {
    echo "<h1>POST NOT DELETED</h1>";
  }
}





// // Headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json");
// header("Access-Control-Allow-Methods: DELETE");  //DELETE request
// header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

// include_once "../../config/Database.php";
// include_once "../../models/Post.php";

// // Instantiate DB and connect to it
// $database = new Database();
// $db = $database->connectToDatabase();

// // Instantiate Post object
// $post = new Post($db);

// $post->id = isset($_GET["id"]) ? $_GET["id"] : die();

// //delete the post
// if ($post->delete()) {
//   echo json_encode(
//     array("message:" => "Post Deleted")
//   );
// } else {
//   echo json_encode(
//     array("message:" => "Post Not Deleted")
//   );
// }