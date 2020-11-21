<?php

if (!isset($_SESSION)) session_start();


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

    $_SESSION["message"] = "Post has been deleted";
    $_SESSION["message_type"] = "danger";
    header("Location: ../../index.php");
  } else {
    echo "<h1>POST NOT DELETED</h1>";
  }
}
