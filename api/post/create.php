<?php

if (!isset($_SESSION)) session_start();

//It seems that since this include comes from a file included in the main directory, the two ../../ cause an error
// almost like the include is still pulling from the main directory.  Interesting and I can forsee that being a pain
//This could help with the issue: https://stackoverflow.com/questions/46329782/warning-include-once-lib-database-php-failed-to-open-stream-no-such-file 

//So, i have to make sure none of this happens before I submit the data.
//When the include first hits, i need it to be from the source directory. i.e. config/Database.php 
//But when the submit_create_request happens, it needs to be included from the actual ../../config/Database.php
//So, I'm checking if the submit_create_request is set, if so, then were good
if (isset($_POST["submit_create_request"])) {
  include_once "../../config/Database.php";
  include_once "../../models/Post.php";

  // Instantiate DB and connect to it
  $database = new Database();
  $db = $database->connectToDatabase();

  // Instantiate Post object
  $post = new Post($db);

  //get the input from the user.
  $post->title = isset($_POST["form_title"]) ? $_POST["form_title"] : 'Spam Detected';
  $post->body = isset($_POST["form_body"]) ? $_POST["form_body"] : '';
  $post->author = isset($_POST["form_author"]) ? $_POST["form_author"] : '';

  if ($post->create()) {
    $_SESSION["message"] = "Post has been created";
    $_SESSION["message_type"] = "success";
    header("Location: http://localhost/hello_database_world");
  } else {
    echo "<h1>POST NOT CREATED</h1>";
  }
}
