<?php include("includes/config.php");?>
<?php include("includes/classes/Artist.php");?>
<?php include("includes/classes/Album.php");?>
<?php include("includes/classes/Track.php");?>
<?php 
// session_destroy(); LOGOUT
  if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
    echo $userLoggedIn;
    echo "<script>userLoggedIn = '$userLoggedIn';</script>";
  }
  else {
    header("Location: register.php");
  }

  ?>

  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css"
      />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <link rel="stylesheet" href="style.css">
      <title>Music Legacy</title>
    </head>
    
    <body>
    <div id="mainContainer">
      <div id="topContainer">

        <?php include("./includes/navBarContainer.php");?>
  
        <div id="mainViewContainer">
          
          <div id="mainContent">
