(function () {
    tabs = document.querySelectorAll(".container .panel .labels button");
    for (let i = 0; i < tabs.length; i++){
        tabs[i].addEventListener("click", function () {
            tabs[i].classList.add("active-panel");
            document.querySelectorAll(".container .panel .forms .form")[i].classList.add("active-form");
            tab_break:
            for (let j = 0; j < tabs.length; j++){
                if (i != j && tabs[j].classList.contains("active-panel")) {
                    tabs[j].classList.remove("active-panel");
                    document.querySelectorAll(".container .panel .forms .form")[j].classList.remove("active-form");
                    break tab_break;
                }
            }
        })
    }
})();
let i = 0, j = 0;
let texts = [
    "Enjoy The Latest Songs",
    "Save Your Favorite Playlists",
    "Share Music With Your Friends",
    "And More and More...",
    "Sign Up NOW!"
];

function animateHeader() {
    if (j < texts[i].length) {
        document.getElementById("main_title").innerHTML += texts[i][j];
    }
    j++;
    if (j > texts[i].length + 5) {
        i++; j = 0;
        document.getElementById("main_title").innerHTML = " ";
        if (i === texts.length) {
            i = 0;
        }
    }
}
setInterval(animateHeader, 100);