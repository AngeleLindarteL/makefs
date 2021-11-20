let timeDivisions = "01:52 - 02:50/2:51 - 8:54/08:55 - 9:20";
timeDivisions = timeDivisions.split("/")
console.log(timeDivisions)

// Reproductor de video -------------------------------------------------

// Variables xd

const mediaPlayer = document.querySelector(".makefs-media-player")
const video = document.querySelector("#source_video");
const makefsControlsContainer = document.querySelector(".makefs-video-controls");
const play = document.querySelector("#mkfv_controlls_play");
const firstPlayButton = document.querySelector("#first-play-btn");
const mute = document.querySelector("#mkfv_controlls_mute");
const backPanel = document.querySelector("#mkfv_controlls_backTo");
const bigPanel = document.querySelector("#mkfv_controlls_big_panel");
const centralPanel = document.querySelector("#mkfv_controlls_big_play");
const afterPanel = document.querySelector("#mkfv_controlls_afterTo");
const progressBar = document.querySelector("#mkfs_video_progress_bar");
const draggable_progress = document.querySelector(".mkfs_video_dragable_ball");
const draggable_visual = document.querySelector(".mkfs_video_dragable_representation");
const time_read = document.querySelector("#progress-bar-time-read");
const fullscreen = document.querySelector("#mkfv_controlls_fullscreen");
const volume_slider = document.querySelector("#mkfv_controlls_volume");
const loading_obj = document.querySelector(".loading-obj");
const timeCounter = document.querySelector("#time_counter");

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
    dragging: null,
    dragleft: 0,
    idleTimeout: null,
    dffbtwn: null,
    firstPlayed: false,
}
const formatSeconds = (secs) => {
    let generalSeconds = ((secs / 60).toFixed(2).toString()).split(".");
    generalSeconds[1] = "0." + generalSeconds[1];
    generalSeconds = [parseInt(generalSeconds[0]),parseInt(generalSeconds[1] * 60)];
    generalSeconds[0] < 10 ? generalSeconds[0] =  "0" + (generalSeconds[0].toString()) : generalSeconds;
    generalSeconds[1] < 10 ? generalSeconds[1] =  "0" + (generalSeconds[1].toString()) : generalSeconds;
    return generalSeconds;
}

const hideControls = () => {
    makefsControlsContainer.classList.replace("controls-showing","controls-hidden")
    mediaPlayer.style.cursor = "none"; 
}
const showControls = () => {
    makefsControlsContainer.classList.replace("controls-hidden","controls-showing")
    mediaPlayer.style.cursor = "default"; 
}

const playAction = () => {
    if(video.paused){
        video.play();
        centralPanel.classList.add("makefs-video-in-panel-played");
        play.style.backgroundImage = "url(./img/video-controls/pause.png)";
        progressBar.setAttribute("max",duration);
        setTimeout(() => {
            centralPanel.classList.remove("makefs-video-in-panel-played")
        },180);
        interval.isActive = true;
        interval.intervalState = progressBar_startInterval()
        hideControls();
    }else{
        video.pause();
        centralPanel.classList.add("makefs-video-in-panel-paused");
        play.style.backgroundImage = "url(./img/video-controls/play.png)";
        setTimeout(() => {
            centralPanel.classList.remove("makefs-video-in-panel-paused")
        },180);
        interval.isActive = false;
        clearInterval(interval.intervalState)
        interval.intervalState = undefined;
        showControls();
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

const updateProgressTime = () =>{
    let spx_pg = progressBar.clientWidth / duration;
    let formatedTime = formatSeconds(video.currentTime);
    progressBar.setAttribute("value", video.currentTime)
    videoPlayerProperties.watchedTime = video.currentTime;
    draggable_visual.style.left = spx_pg * video.currentTime + "px";
    draggable_progress.style.left = spx_pg * video.currentTime + "px";
    timeCounter.textContent = ` ${formatedTime[0]}:${formatedTime[1]} / ${formatSeconds(duration)[0]}:${formatSeconds(duration)[1]}`;
}

const muteAction = () => {
    if(video.muted){
        video.muted = false;
        localStorage.setItem("muted", false);
        mute.style.backgroundImage = "url(./img/video-controls/volume.png)";
    }else{
        video.muted = true;
        localStorage.setItem("muted", true);
        mute.style.backgroundImage = "url(./img/video-controls/volume-muted.png)";
    }
}

const changeVolume = (vol) => {
    if (vol < 0){
        video.volume = 0;
    }
    if (vol > 1){
        video.volume = 1;
    }
    mute.style.backgroundImage = "url(./img/video-controls/volume.png)";
    video.muted = false;
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
const progressBar_startInterval = () => {
    let interval = setInterval(() => {
        if (videoPlayerProperties.seeking == true || videoPlayerProperties.dragging) {
            clearInterval(interval)
        }
        updateProgressTime();
    }, 500)
    return interval
}

firstPlayButton.addEventListener("click", () => {
    playAction();
    timeCounter.textContent = `00:00 / ${formatSeconds(duration)}`;
    makefsControlsContainer.classList.replace("controls-hidden","controls-showing");
    makefsControlsContainer.classList.remove("first-play");
    firstPlayButton.opacity = "20%";
    firstPlayButton.transform = "scale(0.8)";
    makefsControlsContainer.style.display = "flex";
    setTimeout(() => {
        mediaPlayer.removeChild(firstPlayButton);
        videoPlayerProperties.dffbtwn = parseFloat(window.getComputedStyle(draggable_visual).getPropertyValue("left").replace("px","")) / progressBar.value;
        updateProgressTime();
    },200)
    videoPlayerProperties.firstPlayed = true;
})

// Action association ----------------------------------------------------

video.addEventListener("waiting", () => {
    loading_obj.style.display = "flex";
})
video.addEventListener("playing", () => {
    loading_obj.style.display = "none";
})


window.addEventListener("resize", () => {
    if(videoPlayerProperties.firstPlayed === false){
        return;
    }
    updateProgressTime()
    videoPlayerProperties.dffbtwn = parseFloat(window.getComputedStyle(draggable_visual).getPropertyValue("left").replace("px","")) / progressBar.value;
})

window.addEventListener("keydown", (e) => {
    if (videoPlayerProperties.firstPlayed === false) {
        return;
    }
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

mediaPlayer.addEventListener("mousemove", () => {
    showControls();
    clearTimeout(videoPlayerProperties.idleTimeout);
    videoPlayerProperties.idleTimeout = null;
    videoPlayerProperties.idleTimeout = setTimeout(() => {
        hideControls();
    },1500);
})

makefsControlsContainer.addEventListener("mouseenter", () => {
    showControls()
})
makefsControlsContainer.addEventListener("mouseleave", () => {
    hideControls()
})

progressBar.addEventListener("mouseenter", (e) => {
    videoPlayerProperties.seeking = true;
    time_read.style.top = mediaPlayer.clientHeight - makefsControlsContainer.clientHeight - progressBar.clientHeight - 33 + "px";
    time_read.style.display = "flex";
    time_read.style.opacity = "100%";
})
progressBar.addEventListener("mousemove", (e) => {
    const spx = duration / progressBar.offsetWidth;
    let setVal = e.offsetX * spx;
    setVal = formatSeconds(setVal);
    time_read.textContent = `${setVal[0]}:${setVal[1]}`
    time_read.style.display = "flex";
    time_read.style.opacity = "100%";
    time_read.style.left = e.offsetX - (time_read.clientWidth / 4) + "px";
})
progressBar.addEventListener("click", (e) => {
    const spx = duration / progressBar.offsetWidth;
    video.currentTime = e.offsetX * spx;
    updateProgressTime()
})
progressBar.addEventListener("mouseleave", (e) => {
    progressBar.value = videoPlayerProperties.watchedTime;
    videoPlayerProperties.seeking = false;
    interval.isActive = true;
    updateProgressTime();
    interval.intervalState = progressBar_startInterval();
    time_read.style.opacity = "0%";
    setTimeout(() => {
        time_read.style.display = "none";
    },200)
})
draggable_progress.addEventListener("dragstart", (e)=>{
    interval.isActive = false;
    clearInterval(interval.intervalState)
    interval.intervalState = null;
    videoPlayerProperties.dragging = true;
})
let flag = false;
draggable_progress.addEventListener("drag", (e)=>{
    if(!flag){
        videoPlayerProperties.dffbtwn = parseFloat(window.getComputedStyle(draggable_visual).getPropertyValue("left").replace("px","")) / progressBar.value;
        flag = true;
    }
    let positions = progressBar.getBoundingClientRect();
    document.querySelector("html").style.cursor = "move";
    draggable_visual.classList.replace("mkfs_ball_static","mkfs_ball_dragging");
    if (e.pageX > positions.left && e.pageX < positions.right) {
        videoPlayerProperties.dragleft = e.pageX - positions.left; 
        draggable_visual.style.left = videoPlayerProperties.dragleft + "px";
        progressBar.value = (videoPlayerProperties.dragleft) / videoPlayerProperties.dffbtwn;
    }
    else if (e.pageX == 0){
        return;
    }else if (positions.left > e.pageX) {
        draggable_visual.style.left = "0%";
        progressBar.setAttribute("value","0")
        video.currentTime = 0;
    }else if (positions.right < e.pageX) {
        draggable_visual.style.left = "100%";
        progressBar.setAttribute("value",duration)
        video.currentTime = duration;
    }
})
draggable_progress.addEventListener("dragend", (e)=>{
    document.querySelector("html").style.cursor = "default";
    videoPlayerProperties.dragging = false;
    draggable_visual.classList.replace("mkfs_ball_dragging","mkfs_ball_static");
    draggable_progress.style.left = videoPlayerProperties.dragleft + "px";
    video.currentTime = videoPlayerProperties.dragleft / videoPlayerProperties.dffbtwn;
    updateProgressTime();
    interval.isActive = true;
    interval.intervalState = progressBar_startInterval();
})
// Presets para video

if (window.localStorage.getItem("common_volume")) {
    changeVolume(localStorage.getItem("common_volume"));
}else{
    changeVolume(1);
}

if(localStorage.getItem("muted") === "false"){
    video.mute = false;
    mute.style.backgroundImage = "url(./img/video-controls/volume.png)"
}else{
    video.muted = true;
    mute.style.backgroundImage = "url(./img/video-controls/volume-muted.png)"
}