<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hello Cruddy World</title>
</head>

<body>

  <?php include_once "api/post/read.php"; ?>
  <?php $show_posts = false; ?>

  <!-- Delete file used on button push with data-update-id and data-delete-id -->
  <?php require_once "api/post/delete.php"; ?>
  <?php require_once "api/post/read_one.php"; ?>

  <?php if (isset($_POST["show_posts"])) : ?>
    <?php $show_posts = true; ?>
    <?php for ($i = 0; $i < sizeof($data_array["data"]); $i++) : ?>
      <div class="column is-four-fifths">
        <div class="box">
          <h1 class="title"><?php echo $data_array["data"][$i]["title"]; ?> </h1>
          <p><?php echo $data_array["data"][$i]["body"] ?></p>
          <br>
          <p class="is-size-5-mobile has-text-dark"><?php echo $data_array["data"][$i]["author"] ?></p>
          <br>
          <div class="field is-grouped">
            <form method="POST" action="api/post/read_one.php">
              <!-- This needs to be a read_one where the single read will be stored into a variable to be used for update -->
              <!-- The value can be accessed from the name via $_POST which is how we get the id to update or delete -->
              <button name="edit_button_request" value="<?php echo $data_array["data"][$i]["id"]; ?>" class="button has-background-info has-text-white" type="submit">Edit</button>
            </form>
            <form method="POST" action="api/post/delete.php">
              <!-- The value can be accessed from the name via $_POST which is how we get the id to update or delete -->
              <button name="delete_button_request" value="<?php echo $data_array["data"][$i]["id"]; ?>" class="button has-background-danger has-text-white" type="submit">Delete</button>
            </form>
          </div>
        </div>
      </div>
      <br>
    <?php endfor; ?>
  <?php endif; ?>






  <!-- hide and show buttons. -->
  <form method="POST">
    <button id="show_posts_button" class="button is-primary" type="submit" name="show_posts">Show Posts
      <i class="material-icons right">more_horiz</i>
    </button>
    <button id="hide_posts_button" class="button is-primary" type="submit" name="hide_posts">Hide Posts
      <i class="material-icons right">undo</i>
    </button>
  </form>
  <!-- script to hide and show the hide and show buttons -->
  <?php if ($show_posts) : ?>
    <script>
      console.log("SHOW IS TRUE");
      document.getElementById("show_posts_button").style.display = "none";
      document.getElementById("hide_posts_button").style.display = "block";
    </script>
  <?php else : ?>
    <script>
      console.log("SHOW IS FALSE");
      document.getElementById("show_posts_button").style.display = "block";
      document.getElementById("hide_posts_button").style.display = "none";
    </script>
  <?php endif; ?>


  <?php require_once "api/post/create.php"; ?>
  <?php require_once "api/post/update.php"; ?>
  <?php
  if (!isset($_SESSION["read_one_entry_flag"])) {
    $_SESSION["read_one_entry_flag"] = false;
  } else {
    echo "<h1>Read One Entry Flag: " . $_SESSION["read_one_entry_flag"] . "</h1>";
    if (isset($_SESSION["read_one_entry"])) {
      echo "Author in index: " . $_SESSION["read_one_entry"]["author"];
    } else {
      echo "No Post Selected";
    }
  }
  ?>

  <?php if ($_SESSION["read_one_entry_flag"] === false) : ?>
    <div class="column is-three-quarters">
      <form action="api/post/create.php" method="POST">
        <div class="field">
          <label class="label">Title:</label>
          <input id="form_title" class="input is-primary" type="text" name="form_title" placeholder="Title of Post" required>
        </div>
        <div class="field">
          <label class="label">Body:</label>
          <textarea id="form_body" class="textarea" placeholder="e.g. Today I..." name="form_body" required></textarea>
        </div>
        <div class="field">
          <label class="label">Author:</label>
          <div class="control has-icons-left">
            <input id="form_author" class="input is-primary" type="text" name="form_author" placeholder="Author of Post" required>
            <span class="icon is-small is-left">
              <i class="material-icons prefix">account_circle</i>
            </span>
          </div>
        </div>
        <button class="button is-primary" type="submit" name="submit_create_request">
          <span>Submit</span>
          <span class="icon">
            <i class="material-icons prefix">send</i>
          </span>
        </button>
      <?php else : ?>
        <div class="column is-three-quarters">
          <form action="api/post/update.php" method="POST">
            <div class="field">
              <label class="label">Title:</label>
              <input id="form_title" class="input is-primary" type="text" name="form_title" value="<?php echo $_SESSION["read_one_entry"]["title"]; ?>" placeholder="Title of Post" required>
            </div>
            <div class="field">
              <label class="label">Body:</label>
              <textarea id="form_body" class="textarea" placeholder="e.g. Today I..." name="form_body" required><?php echo $_SESSION["read_one_entry"]["body"]; ?></textarea>
            </div>
            <div class="field">
              <label class="label">Author:</label>
              <div class="control has-icons-left">
                <input id="form_author" class="input is-primary" type="text" name="form_author" value="<?php echo $_SESSION["read_one_entry"]["author"]; ?>" placeholder="Author of Post" required>
                <span class="icon is-small is-left">
                  <i class="material-icons prefix">account_circle</i>
                </span>
              </div>
            </div>
            <button class="button is-info" type="submit" value="<?php echo $_SESSION["read_one_entry"]["id"]?>" name="submit_update_request">
              <span>Update</span>
              <span class="icon">
                <i class="material-icons prefix">send</i>
              </span>
            </button>
          <?php endif; ?>
          </form>
        </div>

        <!-- Remove the session read one array and reset the flag to false-->
        <?php
        unset($_SESSION["read_one_entry"]);
        $_SESSION["read_one_entry_flag"] = false;
        ?>


        <!-- Scripts -->
        <!-- <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script> -->
</body>

</html>