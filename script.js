const musicContainer = document.getElementById("music-container");

const playBtn = document.getElementById("play");
const prevBtn = document.getElementById("prev");
const nexBtn = document.getElementById("nex");

const audio = document.getElementById("audio");
const progress = document.getElementById("progress");
const progressContainer = document.getElementById("progress-container");

const title = document.getElementById("title");
const cover = document.getElementById("cover");

// song titles
const songs = ["hey", "summer","ukulele"];

// keep track of song
let songIndex = 1;

// Initially load song details into DOM
loadSong(songs[songIndex]);

// Updade song details
function loadSong(song){
    title.innerText = song;
    audio.src = `music/${song}.mp3`;
    cover.src = `images/${song}.jpg`;
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