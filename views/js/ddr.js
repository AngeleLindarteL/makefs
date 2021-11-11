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
const progressBar = document.querySelector("#mkfs_video_progress_bar");
const time_read = document.querySelector("#progress-bar-time-read");
const fullscreen = document.querySelector("#mkfv_controlls_fullscreen");
const volume_slider = document.querySelector("#mkfv_controlls_volume");


// Action functions -----------------------------------------------------

let interval = {
    isActive: false,
    intervalState: undefined,
}

let videoPlayerProperties = {
    isFocused: true,
    watchedTime: 0,
    seeking: false,
    isFullscreen: false,
}

const progressBar_startInterval = () => {
    let interval = setInterval(() => {
        if (videoPlayerProperties.seeking == true) {
            clearInterval(interval)
        }
        progressBar.setAttribute("value", video.currentTime)
        videoPlayerProperties.watchedTime = video.currentTime;
    }, 200)
    return interval
}

const playAction = () => {
    if(video.paused){
        video.play();
        centralPanel.classList.add("makefs-video-in-panel-played");
        progressBar.setAttribute("max",video.duration);
        setTimeout(() => {
            centralPanel.classList.remove("makefs-video-in-panel-played")
        },200);
        interval.isActive = true;
        interval.intervalState = progressBar_startInterval()
    }else{
        video.pause();
        centralPanel.classList.add("makefs-video-in-panel-paused");
        setTimeout(() => {
            centralPanel.classList.remove("makefs-video-in-panel-paused")
        },200);
        interval.isActive = false;
        clearInterval(interval.intervalState)
        interval.intervalState = undefined;
    }
}

const backToAction = () => {
    video.currentTime = video.currentTime - 10;
    backPanel.classList.add("makefs-video-in-panel-action");
    setTimeout(() => {
        backPanel.classList.remove("makefs-video-in-panel-action")
    },500);
}
const afterToAction = () => {
    video.currentTime = video.currentTime + 10;
    afterPanel.classList.add("makefs-video-in-panel-action");
    setTimeout(() => {
        afterPanel.classList.remove("makefs-video-in-panel-action")
    },500);
    progressBar.setAttribute("value", video.currentTime)
}

const changeTime = (time) =>{

}

const muteAction = () => {
    if(video.muted){
        video.muted = false;
        localStorage.setItem("muted", false)
    }else{
        video.muted = true;
        localStorage.setItem("muted", true)
    }
}

const changeVolume = (vol) => {
    if (vol < 0){
        video.volume = 0;
    }
    if (vol > 1){
        video.volume = 1;
    }
    video.muted = false;
    localStorage.setItem("muted", false)
    video.volume = vol;
    window.localStorage.setItem("common_volume", video.volume)
    volume_slider.value = video.volume;
}

const toggleFullscreen = () => {
    if (videoPlayerProperties.isFullscreen){
        document.exitFullscreen();
        videoPlayerProperties.isFullscreen = false;
    }else{
        mediaPlayer.requestFullscreen().catch(err => console.log(err))
        videoPlayerProperties.isFullscreen = true;
    }
}

// Action association ----------------------------------------------------

window.addEventListener("keydown", (e) => {
    console.log(e);
    let keyPressed = e.key;
    switch (keyPressed) {
        case "ArrowUp":
            if (video.volume < 0.96) {
                changeVolume(video.volume + 0.05);
            }else{
                changeVolume(1);
            }
            break;
        case "ArrowDown":
            if (video.volume > 0.04) {
                changeVolume(video.volume - 0.05);
            }else{
                changeVolume(0);
            }
            break;
        case "ArrowRight":
            afterToAction();
            break;
        case "ArrowLeft":
            backToAction();
            break;
        case " ":
            playAction();
            break;
        case "f":
            toggleFullscreen();
            break;
        default:
            break;
    }       
});
play.addEventListener("click", () => {playAction()});
bigPanel.addEventListener("click", () => {playAction()});
mute.addEventListener("click", () => {muteAction()});
fullscreen.addEventListener("click", () => {toggleFullscreen()});
volume_slider.addEventListener("input", () => {changeVolume(volume_slider.value)})

progressBar.addEventListener("mouseenter", (e) => {
    videoPlayerProperties.seeking = true;
    interval.isActive = false;
    interval.intervalState = undefined;
    clearInterval(interval.intervalState);
    console.log("mouseIn");
    time_read.style.display = "flex";
    setTimeout(() => {
        time_read.style.opacity = "100%";
    },10)
})
progressBar.addEventListener("mouseover", (e) => {
    const spx = video.duration / progressBar.offsetWidth;
    progressBar.value = e.offsetX * spx;
    console.log("mouseover");
    
})
progressBar.addEventListener("mousemove", (e) => {
    const spx = video.duration / progressBar.offsetWidth;
    progressBar.value = e.offsetX * spx;
    console.log("Seeking")
})
progressBar.addEventListener("click", (e) => {
    console.log("info: ", e)
    const spx = video.duration / progressBar.offsetWidth;
    video.currentTime = e.offsetX * spx;
    progressBar.setAttribute("value",e.offsetX * spx)
})
progressBar.addEventListener("mouseleave", (e) => {
    progressBar.value = videoPlayerProperties.watchedTime;
    videoPlayerProperties.seeking = false;
    interval.isActive = true;
    interval.intervalState = progressBar_startInterval();
    time_read.style.opacity = "0%";
    setTimeout(() => {
        time_read.style.display = "none";
    },200)
    console.log("mouseOut")
}) 

video.addEventListener("focus", () => {
    console.log("video focusing");
})
video.addEventListener("focusout", () => {
    console.log("Video focusout");
})

// Presets para video

if (window.localStorage.getItem("common_volume")) {
    changeVolume(localStorage.getItem("common_volume"));
}else{
    changeVolume(1);
}
if (window.localStorage.getItem("muted")) {
    video.muted = localStorage.getItem("muted");
}else{
    video.muted = false;
}
video.addEventListener('load', ()=>{
    console.log(video.duration)
})