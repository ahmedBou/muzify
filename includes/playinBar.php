<?php 
  $songQuery = $pdo->query("SELECT track_id FROM track ORDER BY RAND() LIMIT 10");
  $resultArray = array();
  while($row = $songQuery->fetch(PDO::FETCH_ASSOC)){
    array_push($resultArray, $row['track_id']);
  }
  // our playingbar is in js, we can't create it with php because it will rendered as soon as the page loads,
  // before any js is even executed, so we need to convert array into js array with json
  $jsonArray = json_encode($resultArray);

?>


 <script>
  
    console.log(<?php echo $jsonArray; ?>); 
    // Code included inside $( document ).ready() will only run once the page Document Object Model (DOM) 
    // is ready for JavaScript code to execute. Code included inside $( window ).on( "load", function() { ... })
    //  will run once the entire page (images or iframes), not just the DOM, is ready.
    $( document ).ready(function() {
      currentPlaylist =  <?php echo $jsonArray; ?>;
      audioElement = new Audio();
      // set the track of this audio element and then it's ready to be played
      setTrack(currentPlaylist[0], currentPlaylist, false);
      // we set to false ,because when the page loads we don't want to play the song staright away 
    });
    function setTrack(trackId, newPlaylist, play){
      // audioElement.setTrack("assets/music/hey.mp3");

      // 1arg,You specify the page you make the ajax call to, 2arg :what value you will pass into ajax call
      // 3rd arg: what do you want to do whith the results.
      $.post("Put Url there", {songId: trackId}, function(data){

      })  
      
      if(play){
        audioElement.play();
      }
    }
    // the reason i creating the functions here so that we call these function when we press the btn
    function playSong(){
      console.log("play");
      $("#play").hide();
      $("#pause").show();

      audioElement.play();
    }
    function pauseSong(){
      $("#play").show();
      $("#pause").hide();
      console.log("pause");
      audioElement.pause();
    }
  </script>

<div id="playingBar">
      <div class="music-container" id="music-container">
        <div class="music-info">
          <h4 id="title"></h4>
          <div class="progress-container" id="progress-container">
            <div class="progress" id="progress"></div>
          </div>
        </div>

        <div class="img-container">
          <img src="assets/images/ukulele.jpg" alt="music-cover" id="cover" />
        </div>

        <div class="navigation">
          <button id="repeat" class="action-btn">
            <i class="fas fa-redo"></i>
          </button>
          <button id="prev" class="action-btn">
            <i class="fas fa-backward"></i>
          </button>
          <button id="play" class="action-btn action-btn-big" onclick="playSong()">
            <i class="fas fa-play"></i>
          </button>
          <button id="pause" class="action-btn action-btn-big" onclick="pauseSong()" style="display: none;">
            <i class="fas fa-pause"></i>
          </button>
          <button id="next" class="action-btn">
            <i class="fas fa-forward"></i>
          </button>
          <button id="random" class="action-btn">
            <i class="fa fa-random"></i>
          </button>
        </div>
        <div class="volume">
        <button class="volumup action-btn">
            <i class="fas fa-volume-up"></i>
          </button>   
          <button class="volumdown action-btn" style="display: none;">
            <i class="fas fa-volume-down"></i>
          </button>   
          <button class="mute action-btn" style="display: none;">
            <i class="fas fa-volume-mute"></i>
          </button>
          <div class="pogressVolume">

          </div>
        </div>
      </div>
    </div>