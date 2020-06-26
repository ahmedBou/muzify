(function () {
    tabs = document.querySelectorAll(".panel .labels button");
    for (let i = 0; i < tabs.length; i++){
        tabs[i].addEventListener("click", function () {
            tabs[i].classList.add("active-panel");
            document.querySelectorAll(".panel .forms .form")[i].classList.add("active-form");
            for (let j = 0; j < tabs.length; j++){
                if (i !== j && tabs[j].classList.contains("active-panel")) {
                    tabs[j].classList.remove("active-panel");
                    document.querySelectorAll(".panel .forms .form")[j].classList.remove("active-form");
                    break;
                }
            }
        })
    }
})();