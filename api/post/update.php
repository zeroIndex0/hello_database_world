<?php

if (!isset($_SESSION)) session_start();

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
  $post->title = isset($_POST["form_title"]) ? $_POST["form_title"] : '';
  $post->body = isset($_POST["form_body"]) ? $_POST["form_body"] : '';
  $post->author = isset($_POST["form_author"]) ? $_POST["form_author"] : '';

  // print_r($post);

  //update the post
  if ($post->update()) {
    $_SESSION["message"] = "Post has been updated";
    $_SESSION["message_type"] = "primary";
    header("Location: ../../index.php");
  } else {
    echo "<h1>POST NOT UPDATED</h1>";
  }
}
