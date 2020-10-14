<?php

//It seems that since this include comes from a file included in the main directory, the two ../../ cause an error
// almost like the include is still pulling from the main directory.  Interesting and I can forsee that being a pain
//This could help with the issue: https://stackoverflow.com/questions/46329782/warning-include-once-lib-database-php-failed-to-open-stream-no-such-file 

//So, i have to make sure none of this happens before I submit the data.  Which seems like it shouldn't be that way.
//But when the include first hits, i need it to be from the source directory. i.e. config/Database.php 
//But when the submit happens, it needs to be included from the actual ../../config/Database.php
// Its possible i should create a HOME_DIR like the link above suggests.
if (isset($_POST["submit_create_request"])) {
  include_once "../../config/Database.php";
  include_once "../../models/Post.php";

  // Instantiate DB and connect to it
  $database = new Database();
  $db = $database->connectToDatabase();

  // Instantiate Post object
  $post = new Post($db);

  //get the input from the user.
  $post->title = isset($_POST["form_title"]) ? $_POST["form_title"] : die();
  $post->body = isset($_POST["form_body"]) ? $_POST["form_body"] : die();
  $post->author = isset($_POST["form_author"]) ? $_POST["form_author"] : die();

  if ($post->create()) {
    header("Location: http://localhost/hello_database_world");
  } else {
    echo "<h1>POST NOT CREATED</h1>";
  }
  
}



//These headers only throw errors when trying to use them from an html file.  So i have removed them
// Headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json");
// header("Access-Control-Allow-Methods: POST");  //POST request
// header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

// include_once "../../config/Database.php";
// include_once "../../models/Post.php";


  //Get the raw post data of what was submitted
  //further reading on this function 'file_get_contents' and the parameter 'php://input' aka wrappers
  //  https://www.php.net/manual/en/function.file-get-contents.php
  //  https://www.php.net/manual/en/wrappers.php.php
  //Just to state again, this pulls the raw data that is being passed in
  //from the request body. And i will be passing in json, so I have to decode the json.
  // $data = json_decode(file_get_contents("php://input"));

  // $post->title = $data->title;
  // $post->body = $data->body;
  // $post->author = $data->author;

// //create the post
// if ($post->create()) {
//   echo json_encode(
//     array("message:" => "Post Created")
//   );
// } else {
//   echo json_encode(
//     array("message:" => "Post Not Created")
//   );
// }