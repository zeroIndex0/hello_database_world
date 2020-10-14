<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> This framework is not doing well anymore-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hello Cruddy World</title>
</head>

<body>
  <!-- I still don't know if this should just be an index.html file with php sprinkled about -->

  <!-- <button type="submit">Hiiiiiiiiiiiiiiiiiiiiiiii</button>
  <a class="waves-effect waves-light btn" type="submit">Submit</a>
  <a class="waves-effect waves-light btn"><i class="material-icons left">cloud</i>button</a>
  <a class="waves-effect waves-light btn"><i class="material-icons right">cloud</i>button</a>

  <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a> -->
  <!-- if (isset($_POST["show_posts"])) {
    echo "button clicked";
    include "api/post/read.php";
    <form action="api/post/read.php" method="post">
    <button class="btn waves-effect waves-light" type="submit" name="show_posts">Show Posts
      <i class="material-icons right">send</i>
    </button>
  </form> -->

  <?php include_once "api/post/read.php"; ?>
  <?php $show_posts = false; ?>

  <?php if (isset($_POST["show_posts"])) : ?>
    <?php $show_posts = true; ?>
    <table class="highlight">
      <thead>
        <tr>
          <th>Title</th>
          <th>Body</th>
          <th>Author</th>
        </tr>
      </thead>
      <?php for ($i = 0; $i < sizeof($data_array["data"]); $i++) : ?>
        <tr>
          <td class="left"><?php echo $data_array["data"][$i]["title"] ?></td>
          <td><?php echo $data_array["data"][$i]["body"] ?></td>
          <td class="right"><?php echo $data_array["data"][$i]["author"] ?></td>
        </tr>
      <?php endfor; ?>
    </table>
  <?php endif; ?>


  <!-- hide and show buttons. -->
  <form method="post">
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
  <script>
    console.log("made the include");
  </script>

  <div class="row">
    <form action="api/post/create.php" method="POST">
      <div class="field">
        <div class="control">
          <label for="form_title">Title:</label>
          <input id="form_title" class="input is-primary" type="text" name="form_title" placeholder="Title of Post" required>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <label for="form_body">Body:</label>
          <textarea id="form_body" class="textarea" placeholder="e.g. Today I..." name="form_body" required></textarea>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <label for="form_author">Author:</label>
          <input id="form_author" class="input is-primary" type="text" name="form_author" placeholder="Author of Post" required>
        </div>
      </div>
      <button class="button is-primary" type="submit" name="submit_create_request">
        <span>Submit</span>
        <span class="icon">
          <i class="material-icons prefix">send</i>
        </span>
      </button>
    </form>


    <!-- <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">title</i>
        <input id="icon_prefix" type="text" class="validate" name="form_title" required>
        <label for="icon_prefix">Title</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">chat</i>
        <textarea id="textarea1" class="materialize-textarea" name="form_body" required></textarea>
        <label for="textarea1">Body</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">person</i>
        <input id="icon_prefix" type="tel" class="validate" name="form_author" required>
        <label for="icon_prefix">Author Name</label>
      </div>
    </div>
    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
    </button>
  </div> -->



    <!-- Scripts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script> -->
</body>

</html>