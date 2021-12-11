let actButton = document.querySelector("#closeMRBtn");
let vidCont = document.querySelector(".mini-reproductor");
let vid = vidCont.children[0];

actButton.addEventListener("click", () => {
    if (vidCont.classList.contains("MRShowing")) {
        vidCont.classList.replace("MRShowing", "MRHidding");
        actButton.textContent = "v"
    }else{
        vidCont.classList.replace("MRHidding","MRShowing");
        actButton.textContent = "x"
    }
})
vid.addEventListener("seeking", () => {
    if (localStorage.getItem("MinutesPointer") === null) {
        return;
    }
    let pointers = localStorage.getItem("MinutesPointer").split(",");
    let step = document.querySelectorAll(".oneStepNewRecipe")[pointers[0]].children[pointers[1]]
    let splitedTime = (new Date(vid.currentTime * 1000).toISOString().substr(14, 5)).split(":");
    step.style.background = "#ff2d29";
    step.children[0].value = splitedTime[0];
    step.children[1].value = splitedTime[1];
})
vid.addEventListener("seeked", () => {
    let pointers = localStorage.getItem("MinutesPointer").split(",");
    let step = document.querySelectorAll(".oneStepNewRecipe")[pointers[0]].children[pointers[1]]
    step.removeAttribute("style");
})