<?php

if (isset($_POST["delete_button_request"])) {
  include_once "../../config/Database.php";
  include_once "../../models/Post.php";

  // Instantiate DB and connect to it
  $database = new Database();
  $db = $database->connectToDatabase();

  // Instantiate Post object
  $post = new Post($db);

  $post->id = $_POST["delete_button_request"];

  //delete the post
  if ($post->delete()) {

    header("Location: http://localhost/hello_database_world");
  } else {
    echo "<h1>POST NOT DELETED</h1>";
  }
}
