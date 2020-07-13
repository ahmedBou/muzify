/*eslint linebreak-style: ["error", "windows"]*/
const audio = {};
audio.canStart = false;
window.addEventListener('load', audioReady);

function audioReady() {
    audio.canStart = true;
    audio.source = document.getElementById('audio_file');
    document.getElementById("final_progress").innerHTML = floatToSec(audio.source.duration);
    audio.currentVolume = audio.source.volume = 0.7;
    document.getElementById("current_progress").innerHTML = "0:00";
    audio.currentVolumeProgess = '70%';
}

//toggle between play and pause
document.getElementById("play").addEventListener('click', function () {
    if (audio.source.paused) {
        audio.source.play();
        document.getElementById("play").innerHTML = "<i class=\"play-pause fa fa-pause-circle\" aria-hidden=\"true\"></i>";
    } else {
        audio.source.pause();
        document.getElementById("play").innerHTML = "<i class=\"play-pause fa fa-play-circle\" aria-hidden=\"true\"></i>";
    }
});
//add volume icon click event
document.querySelector("#volumeIcon").addEventListener('click', function () {
    if (audio.source.volume > 0) {
        audio.source.volume = 0;
        document.querySelector(".volume-top").style.width = '0%';
    } else {
        audio.source.volume = audio.currentVolume;
        document.querySelector(".volume-top").style.width = audio.currentVolumeProgess;
    }
    adjustVolumeIcon();
});

//change the audio position
document.getElementById("seek_bar").addEventListener("click", function (event) {
    let rect = event.target.getBoundingClientRect();
    let seek = event.clientX - rect.left;
    audio.source.currentTime = audio.source.duration * (seek / this.offsetWidth);
    document.querySelector(".progress-top").style.width = `${(seek / this.offsetWidth) * 100}%`;
});

//change the volume from progress bar
document.getElementById("volume").addEventListener("click", function (event) {
    let rect = event.target.getBoundingClientRect();
    let volume = event.clientX - rect.left;
    audio.currentVolume = audio.source.volume = volume / 100;
    document.querySelector(".volume-top").style.width = audio.currentVolumeProgess = `${(volume / this.offsetWidth) * 100}%`;
    adjustVolumeIcon();
});

document.getElementById('audio_file').addEventListener("ended", function () {
    document.getElementById("play").innerHTML = "<i class=\"play-pause fa fa-play-circle\" aria-hidden=\"true\"></i>";
});

setInterval(updateProgress, 100);

function floatToSec(fl) {
    let formatSec = Math.floor(fl) % 60 < 10 ? "0" + Math.floor(fl) % 60 : Math.floor(fl) % 60;
    return `${Math.floor((fl) / 60)}:${formatSec}`;
}

function adjustVolumeIcon() {
    if (audio.source.volume === 0) {
        document.getElementById("volumeIcon").innerHTML = "<i class=\"fa fa-volume-off\" aria-hidden=\"true\"></i>";
    } else if (audio.source.volume <= 0.5) {
        document.getElementById("volumeIcon").innerHTML = "<i class=\"fa fa-volume-down\" aria-hidden=\"true\"></i>";
    } else {
        document.getElementById("volumeIcon").innerHTML = "<i class=\"fa fa-volume-up\" aria-hidden=\"true\"></i>";
    }
}
function updateProgress() {
    if (audio.canStart) {
        if (!audio.source.paused) {
            document.getElementById("current_progress").innerHTML = floatToSec(audio.source.currentTime);
            document.querySelector(".progress-info .progress-top").style.width = `${(audio.source.currentTime / audio.source.duration) * 100}%`;
        }
    }
}
