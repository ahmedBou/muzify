<?php 
  $songQuery = $pdo->query("SELECT track_id FROM track ORDER BY RAND() LIMIT 10");
  $resultArray = array();
  while($row = $songQuery->fetch(PDO::FETCH_ASSOC)){
    array_push($resultArray, $row['track_id']);
  }
  // our playingbar is in js, we can't create it with php because it will rendered as soon as the page loads,
  // before any js is even executed, so we need to convert array into js array with json
  $jsonArray = json_encode($resultArray);
  // include("./handlers/ajax/songJson.php")
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
    $(".progress-container .progressBar").mousedown(function(){
      // alert("hello mouse");
      mouseDown = true;
    });
  
    $(".progress-container .progressBar").mousemove(function(e){
      if(mouseDown ==  true){
        // set time of song, depending on position of mouse
        timeFromOffset(e, this);
      }
    });

    $(".progress-container .progressBar").mouseup(function(e){
        timeFromOffset(e, this);
    });


    $(".volume .progressBar").mousedown(function(){
      // alert("hello mouse");
      mouseDown = true;
    });
  
    $(".volume .progressBar").mousemove(function(e){
      if(mouseDown == true) {
        var percentage = e.offsetX / $(this).width();
        if(percentage >= 0 && percentage <= 1) {
          audioElement.audio.volume = percentage;
        }
      }
    });

    $(".volume .progressBar").mouseup(function(e){
      var percentage = e.offsetX / $(this).width();
      if(percentage >= 0 && percentage <= 1) {
        audioElement.audio.volume = percentage;
      }
    });


    $(document).mouseup(function(){
      mouseDown = false;
    })
  
  });

  function timeFromOffset(mouse, progressBar){
    var percentage = mouse.offsetX / $(progressBar).width() * 100;
    var seconds = audioElement.audio.duration *(percentage /100);
    audioElement.setTime(seconds);
  }
  
  function prevSong() {
	if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
		audioElement.setTime(0);
	}
	else {
		currentIndex = currentIndex - 1;
		setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
	}
}

function nextSong() {
	if(repeat == true) {
		audioElement.setTime(0);
		playSong();
		return;
	}

	if(currentIndex == currentPlaylist.length - 1) {
		currentIndex = 0;
	}
	else {
		currentIndex++;
	}

	var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
	setTrack(trackToPlay, currentPlaylist, true);
}

function setRepeat() {
	repeat = !repeat;
	var colorName = repeat ? "#dfdbdf" : "black";
	$("#repeat").css("color", colorName);
}

// function setMute() {
// 	audioElement.audio.muted = !audioElement.audio.muted;
// 	var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
// 	$(".controlButton.volume img").attr("src", "assets/images/icons/" + imageName);
// }

function setShuffle() {
	shuffle = !shuffle;
	var colorName = shuffle ? "#dfdbdf" : "black";
	$("#random").css("color", colorName);

	if(shuffle == true) {
		//Randomize playlist
		shuffleArray(shufflePlaylist);
		currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
	}
	else {
		//shuffle has been deactivated
		//go back to regular playlist
		currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
	}

}

function shuffleArray(a) {
    var j, x, i;
    for (i = a.length; i; i--) {
        j = Math.floor(Math.random() * i);
        x = a[i - 1];
        a[i - 1] = a[j];
        a[j] = x;
    }
}


  // trackId=>currentPlaylist[0] ...
  function setTrack(trackId, newPlaylist, play){
    // audioElement.setTrack("assets/music/hey.mp3");

    // 1arg,You specify the page you make the ajax call to, 2arg :what value you will pass into ajax call
    // (give me any data you want to send )
    // 3rd arg: what do you want to do whith the results.
    $.post("includes/handlers/ajax/songJson.php", {songId: trackId}, function(data){
      // console.log(data);
      var track = JSON.parse(data);
      $("#title").text(track.title);
      $.post("includes/handlers/ajax/artistJson.php", {artistId: track.artist_id}, function(data){
        var artist = JSON.parse(data);
        console.log(artist.name);
        $("#artistName").text(artist.name);
        $("#artistName").attr("onclick", "openPage('artist.php?id="+ artist.artist_id +"')");
      })
      $.post("includes/handlers/ajax/albumImagePath.php", {albumId: track.album_id}, function(data){
        $albumImage = JSON.parse(data);
        console.log($albumImage.images_path);
        $(".img-container img").attr("src",$albumImage.images_path);
      })
      console.log(track);
      audioElement.setTrack(track);
      playSong();
    })  
    
    if(play){
      audioElement.play();
    }
  }
  
  // the reason i creating the functions here so that we call these function when we press the btn
  const progress = document.getElementById("progress");
  const progressContainer = document.getElementById("progress-container");
  const playBtn = document.getElementById("play");
  
  function playSong(){
    console.log(audioElement.currentlyPlaying);
    if(audioElement.audio.currentTime == 0){
      // console.log("Update Time");
      $.post("includes/handlers/ajax/updatePlays.php", {songId: audioElement.currentlyPlaying.track_id});
    }
  
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



<div class="music-container" >
    <div class="leftContainer">
      <div class="image-info">
        <div class="img-container" >
          <img role="link" tabindex="0" src="" alt="music-cover" id="cover" />
        </div>
        <div class="song-info">
          <div id="artistName" role="link" tabindex="0"></div>
          <div id="title" role="link" tabindex="0"></div>
        </div>
      </div>
    </div>

    <div class="centerContainer">
      <div class="navigation" id="navigation">
        <div class="navigationbtn">
          <button id="repeat" class="action-btn" onclick="setRepeat()">
            <i class="fas fa-redo"></i>
          </button>
          <button id="prev" class="action-btn" onclick="prevSong()">
            <i class="fas fa-backward"></i>
          </button>
          <button id="play" class="action-btn action-btn-big" onclick="playSong()">
            <i class="fas fa-play"></i>
          </button>
          <button id="pause" class="action-btn action-btn-big" onclick="pauseSong()" style="display: none;">
            <i class="fas fa-pause"></i>
          </button>
          <button id="next" class="action-btn" onclick="nextSong()">
            <i class="fas fa-forward"></i>
          </button>
          <button id="random" class="action-btn" onclick="setShuffle()">
            <i class="fa fa-random"></i>
          </button>
        </div> 
        <div class="progress-container" id="progress-container">
          <div class="progressTime current">0.00</div>
            <div class="progressBar">
              <div class="innerprogressBar">
                <div class="progress" id="progress"></div>
              </div>
            </div>
          <div class="progressTime remaining">0.00</div>
        </div>
      </div>
    </div>

    
    <div class="rightContainer">
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
          <div class="progressBar">
              <div class="innerprogressBar">
                <div class="progress" id="progress"></div>
              </div>
            </div>
      </div>
      </div>
    </div>
</div>