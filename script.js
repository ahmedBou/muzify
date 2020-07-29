const musicContainer = document.getElementById("music-container");

const playBtn = document.getElementById("play");
const prevBtn = document.getElementById("prev");
const nextBtn = document.getElementById("next");

const audio = document.getElementById("audio");
const progress = document.getElementById("progress");
const progressContainer = document.getElementById("progress-container");

const title = document.getElementById("title");
const cover = document.getElementById("cover");

// song titles
const songs = ["hey", "summer", "ukulele", "sunny"];

// keep track of song
let songIndex = 1;

// Initially load song details into DOM
loadSong(songs[songIndex]);

// Updade song details
function loadSong(song){
    title.innerText = song;
    audio.src = `assets/music/${song}.mp3`;
    cover.src = `assets/images/${song}.jpg`;
}

// Play song
function playSong(){
    musicContainer.classList.add('play');
    playBtn.querySelector("i.fas").classList.remove('fa-play');
    playBtn.querySelector("i.fas").classList.add('fa-pause');
    audio.play();
}
// Pause song
function pauseSong(){
    musicContainer.classList.remove('play');
    playBtn.querySelector("i.fas").classList.add('fa-play');
    playBtn.querySelector("i.fas").classList.remove('fa-pause');
    audio.pause();
}
// Previous song
function prevSong(){
    songIndex--;
    if(songIndex < 0){
        songIndex = songs.length -1
    }
    loadSong(songs[songIndex]);
    playSong();
}
function nextSong(){
    songIndex++;
    if(songIndex > songs.length-1){
        songIndex = 0;
    }
    loadSong(songs[songIndex]);
    playSong();
}

function updateProgress(e){
    const {duration, currentTime} = e.srcElement;
    // console.log(e.srcElement);
    // console.log(duration, currentTime);
    const progressPercent = (currentTime / duration)*100;
    // console.log(progressPercent);
    progress.style.width = `${progressPercent}%`;
}

// Set progress bar
function setProgress(e){
    const width = this.clientWidth;
    // console.log(width);
    const clickX = e.offsetX;
    // console.log(clickX);
    const duration = audio.duration;
    console.log(duration);
    audio.currentTime = (clickX / width) * duration;

}

// Event listeners
playBtn.addEventListener('click', ()=>{
    const isPlaying = musicContainer.classList.contains('play');
    if(isPlaying){
        pauseSong();
    }
    else{
        playSong();
    }
});

// change song
prevBtn.addEventListener("click", prevSong);
nextBtn.addEventListener("click", nextSong);

// Time/song update
audio.addEventListener('timeupdate', updateProgress);

// click on progress bar
progressContainer.addEventListener('click', setProgress);

// song Ends
audio.addEventListener('ended', nextSong);