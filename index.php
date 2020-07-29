<!-- <?php 
// session_destroy(); LOGOUT
  // include("includes/config.php");
  // if(isset($_SESSION['userLoggedIn'])){
  //   $userLoggedIn = $_SESSION['userLoggedIn'];
  // }else{
  //   header("Location: register.php")
  // }

?> -->


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
    <link rel="stylesheet" href="style.css">
    <title>Music Player</title>
  </head>
  <body>
  <div id="mainContainer">
    <div id="topContainer">

      <?php include("./includes/navBarContainer.php");?>
      
    </div>
 
    <!-- <h1>Music Player</h1> -->
    <?php include("includes/playinBar.php")?>
    

  </div>

    <script src="script.js"></script>
  </body>
</html>
