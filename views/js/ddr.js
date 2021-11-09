let timeDivisions = "01:52 - 02:50/2:51 - 8:54/08:55 - 9:20";
timeDivisions = timeDivisions.split("/")
console.log(timeDivisions)


// Reproductor de video -------------------------------------------------

// Variables xd

const mediaPlayer = document.querySelector(".makefs-media-player")
const video = document.querySelector("#source_video");
const play = document.querySelector("#mkfv_controlls_play");
const mute = document.querySelector("#mkfv_controlls_mute");
const backPanel = document.querySelector("#mkfv_controlls_backTo");
const bigPanel = document.querySelector("#mkfv_controlls_big_panel");
const centralPanel = document.querySelector("#mkfv_controlls_big_play");
const afterPanel = document.querySelector("#mkfv_controlls_afterTo");
const progresBar = document.querySelector("#mkfs_video_progress_bar");
const progresSelect = document.querySelector("#mkfs_video_progress_select");


// Action functions -----------------------------------------------------

let interval = {
    isActive: false,
    intervalState: undefined,
}

let videPlayerProperties = {
    isFocused: true
}

const progresBar_startInterval = () => {
    let interval = setInterval(() => {
        progresBar.setAttribute("value", video.currentTime)
        progresSelect.setAttribute("value", video.currentTime)
    }, 200)
    return interval
}

const playAction = () => {
    if(video.paused){
        video.play();
        centralPanel.classList.add("makefs-video-in-panel-played");
        progresBar.setAttribute("max",video.duration);
        progresSelect.setAttribute("max",video.duration);
        setTimeout(() => {
            centralPanel.classList.remove("makefs-video-in-panel-played")
        },500);
        interval.isActive = true;
        interval.intervalState = progresBar_startInterval()
    }else{
        video.pause();
        centralPanel.classList.add("makefs-video-in-panel-paused");
        setTimeout(() => {
            centralPanel.classList.remove("makefs-video-in-panel-paused")
        },500);
        interval.isActive = false;
        clearInterval(interval.intervalState)
    }
}

const backToAction = () => {
    video.currentTime = video.currentTime - 10;
    backPanel.classList.add("makefs-video-in-panel-action");
    setTimeout(() => {
        backPanel.classList.remove("makefs-video-in-panel-action")
    },500);
    progresSelect.setAttribute("value", video.currentTime)
}
const afterToAction = () => {
    video.currentTime = video.currentTime + 10;
    afterPanel.classList.add("makefs-video-in-panel-action");
    setTimeout(() => {
        afterPanel.classList.remove("makefs-video-in-panel-action")
    },500);
    progresBar.setAttribute("value", video.currentTime)
    progresSelect.setAttribute("value", video.currentTime)
}

const muteAction = () => {
    if(video.muted){
        video.muted = false;
    }else{
        video.muted = true;
    }
}

// Action association ----------------------------------------------------

window.addEventListener("keypress", (e) => {
});
window.addEventListener("keydown", (e) => {
    console.log(e);
    let keyPressed = e.key;
    switch (keyPressed) {
        case "ArrowUp":
            
            break;
        case "ArrowDown":
            
            break;
        case "ArrowRight":
            afterToAction()
            break;
        case "ArrowLeft":
            backToAction()
            break;
        case " ":
            playAction()
            break;
        default:
            break;
    }       
});
play.addEventListener("click", () => {playAction()});
bigPanel.addEventListener("click", () => {playAction()});
mute.addEventListener("click", () => {muteAction()});
