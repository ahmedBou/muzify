var currentPlaylist = [];
var audioElement;
var mouseDown = false;
var shufflePlaylist = [];
var tempPlaylist = [];
var currentIndex = 0;
var repeat = false;
var shuffle = false;

function formatTime(seconds){
    var time = Math.round(seconds);
    var minutes = Math.floor(time / 60); 
    var seconds = time -(minutes * 60);
    return minutes + ":" + seconds;
}

function updateTimeProgressBar(audio){
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));
    var progress = audio.currentTime / audio.duration * 100;
    $(".progressBar .progress").css("width", `${progress}%`);
}

function updateVolumeProgressBar(audio) {
	var volume = audio.volume * 100;
	$(".volume .progress").css("width", volume + "%");
}


function Audio(){
    // keep track of the that currently playing
    this.currentlyPlaying;
    this.audio = document.createElement('audio');
    
    this.audio.addEventListener("ended", function() {
		nextSong();
    });
    
    // remaininTime events
    this.audio.addEventListener("canplay", function(){
        // "this" refers to the object that the event was called on this.audio.duration
        let duration = formatTime(this.duration);
       $(".progressTime.remaining").text(duration);
    });

    // progressBar events
    this.audio.addEventListener("timeupdate", function(){
        if(this.duration){
            updateTimeProgressBar(this);
        }
    });

    this.audio.addEventListener("volumechange", function() {
		updateVolumeProgressBar(this);
    });
    
    this.setTrack = function(track){
        // "this" refers to the instance of class
        this.currentlyPlaying  = track;
        this.audio.src = track.path;
    }
    // this play() function save us to say audioElement.audio.play or pause
    this.play = function(){
        var musicContainer = document.getElementById("navigation");
        musicContainer.classList.add('play');
        this.audio.play();
    }
    this.pause = function(){
        var musicContainer = document.getElementById("navigation");
        musicContainer.classList.remove('play');
        this.audio.pause();
    }
    this.setTime = function(seconds){
        this.audio.currentTime = seconds
      }
} 


