var currentPlaylist = [];
var audioElement;

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

function Audio(){
    // keep track of the that currently playing
    this.currentlyPlaying;
    this.audio = document.createElement('audio');
    
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
    })
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
} 


// const musicContainer = document.getElementById("music-container");

// const playBtn = document.getElementById("play");
// const prevBtn = document.getElementById("prev");
// const nextBtn = document.getElementById("next");

// const audio = document.getElementById("audio");
// const progress = document.getElementById("progress");
// const progressContainer = document.getElementById("progress-container");

// const title = document.getElementById("title");
// const cover = document.getElementById("cover");

// // song titles
// const songs = ["hey", "summer", "ukulele", "sunny"];

// // keep track of song
// let songIndex = 1;

// // Initially load song details into DOM
// loadSong(songs[songIndex]);

// // Updade song details
// function loadSong(song){
//     title.innerText = song;
//     audio.src = `assets/music/${song}.mp3`;
//     cover.src = `assets/images/${song}.jpg`;
// }

// // Play song
// function playSong(){
//     musicContainer.classList.add('play');
//     playBtn.querySelector("i.fas").classList.remove('fa-play');
//     playBtn.querySelector("i.fas").classList.add('fa-pause');
//     audio.play();
// }

// // Pause song
// function pauseSong(){
//     musicContainer.classList.remove('play');
//     playBtn.querySelector("i.fas").classList.add('fa-play');
//     playBtn.querySelector("i.fas").classList.remove('fa-pause');
//     audio.pause();
// }

// // Previous song
// function prevSong(){
//     songIndex--;
//     if(songIndex < 0){
//         songIndex = songs.length -1
//     }
//     loadSong(songs[songIndex]);
//     playSong();
// }

// function nextSong(){
//     songIndex++;
//     if(songIndex > songs.length-1){
//         songIndex = 0;
//     }
//     loadSong(songs[songIndex]);
//     playSong();
// }

// function updateProgress(e){
//     const {duration, currentTime} = e.srcElement;
//     // console.log(e.srcElement);
//     // console.log(duration, currentTime);
//     const progressPercent = (currentTime / duration)*100;
//     // console.log(progressPercent);
//     progress.style.width = `${progressPercent}%`;
// }

// Set progress bar
// function setProgress(e){
//     const width = this.clientWidth;
//     // console.log(width);
//     const clickX = e.offsetX;
//     // console.log(clickX);
//     const duration = audio.duration;
//     console.log(duration);
//     audio.currentTime = (clickX / width) * duration;
// }

// // Event listeners
// playBtn.addEventListener('click', ()=>{
//     const isPlaying = musicContainer.classList.contains('play');
//     if(isPlaying){
//         pauseSong();
//     }
//     else{
//         playSong();
//     }
// });

// // change song
// prevBtn.addEventListener("click", prevSong);
// nextBtn.addEventListener("click", nextSong);

// // Time/song update
// audio.addEventListener('timeupdate', updateProgress);

// // click on progress bar
// progressContainer.addEventListener('click', setProgress);

// // song Ends
// audio.addEventListener('ended', nextSong);