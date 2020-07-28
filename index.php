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
      <div id="navBarContainer">
        <nav class="navbar">
          
          <a href="index.php" class="logo">
              <img src="images/logo2.png" alt="" >
              <h3>LegacyZik</h3>
          </a>

            <div class="groupOfItems">
              <div class="navItem">
                <a href="search.php" class="navItemLink">Search
                  <img src="images/search.png" class="icon" alt="Search"></a>
              </div>
            </div>

            <div class="groupOfItems">
              <div class="navItem">
                <a href="browse.php" class="navItemLink">Browse</a>
              </div> 
            </div>  

            <div class="groupOfItems">
              <div class="navItem">
                <a href="music.php" class="navItemLink">Your Music</a>
              </div>
            </div>

            <div class="groupOfItems">
              <div class="navItem">
                <a href="profile.php" class="navItemLink">Citizen0x</a>
              </div>
            </div>
        </nav>
      </div>
    </div>
 
    <!-- <h1>Music Player</h1> -->
    <div id="playingBar">
      <div class="music-container" id="music-container">
        <div class="music-info">
          <h4 id="title"></h4>
          <div class="progress-container" id="progress-container">
            <div class="progress" id="progress"></div>
          </div>
        </div>

        <audio src="music/ukulele.mp3" id="audio"></audio>

        <div class="img-container">
          <img src="images/ukulele.jpg" alt="music-cover" id="cover" />
        </div>

        <div class="navigation">
          <button id="prev" class="action-btn">
            <i class="fas fa-backward"></i>
          </button>
          <button id="play" class="action-btn action-btn-big">
            <i class="fas fa-play"></i>
          </button>
          <button id="next" class="action-btn">
            <i class="fas fa-forward"></i>
          </button>
        </div>
      </div>
    </div>
    

  </div>

    <script src="script.js"></script>
  </body>
</html>
