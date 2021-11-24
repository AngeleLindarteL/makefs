let timeDivisions = "01:52 - 02:50/2:51 - 8:54/08:55 - 9:20";
timeDivisions = timeDivisions.split("/")
console.log(timeDivisions)

// Reproductor de video -------------------------------------------------
// Variables xd

const mediaPlayer = document.querySelector(".makefs-media-player");
const video = document.querySelector("#source_video");
const firstPlayButton = document.querySelector("#first-play-btn");
const backPanel = document.querySelector("#mkfv_controlls_backTo");
const bigPanel = document.querySelector("#mkfv_controlls_big_panel");
const centralPanel = document.querySelector("#mkfv_controlls_big_play");
const afterPanel = document.querySelector("#mkfv_controlls_afterTo");
const makefsControlsContainer = document.querySelector(".makefs-video-controls");
const progressBar = document.querySelector("#mkfs_video_progress_bar");
const draggable_progress = document.querySelector(".mkfs_video_dragable_ball");
const draggable_visual = document.querySelector(".mkfs_video_dragable_representation");
const time_read = document.querySelector("#progress-bar-time-read");
const play = document.querySelector("#mkfv_controlls_play");
const mute = document.querySelector("#mkfv_controlls_mute");
const volume_slider = document.querySelector("#mkfv_controlls_volume");
const timeCounter = document.querySelector("#time_counter");
const fullscreen = document.querySelector("#mkfv_controlls_fullscreen");
const config = document.querySelector("#mkfv_controlls_config");
const configPanel = document.querySelector(".config-options"); 
const configOptionsPanel = document.querySelector(".main-config-options"); 
const speedRateOptions = document.querySelector("#speedrate-options"); 
const config_steps = document.querySelector("#makefs-video-controls-steps");
const config_steps_slidable = document.querySelector("#config-controllers-slidable-steps");
const config_bucle = document.querySelector("#makefs-video-controls-bucle");
const config_bucle_slidable = document.querySelector("#config-controllers-slidable-bucle");
const config_speedrate = document.querySelector("#makefs-video-controls-speedrate");
const loading_obj = document.querySelector(".loading-obj");
const speedrateback = document.querySelector("#makefs-video-controls-speedrate-back");
const speedrategroup = document.querySelectorAll(".makefs-video-controls-speedrate");
const actualSpeedRate = document.querySelector("#actual-speed-rate");
const anotationStep = document.querySelector(".step-anotation");
const anotationStepClose = document.querySelector("#step-annotation-close");
const anotationStepMinuteRange = document.querySelector("#step-annotation-minutes");
const anotationStepNum = document.querySelector("#step-annotation-number");
const anotationStepDetail = document.querySelector("#step-annotation-detail");
const anotationStepShowMore = document.querySelector("#step-annotation-show-more");
const anotationStepShowMoreGradient = document.querySelector("#step-annotation-show-more-gradient");

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
    isInConfig: false,
    isBucleActive: false,
    isInStepsPanel: false,
}

let stepsProperties = {
    isActive: true,
    isShowing: false,
    actualStepTimeOut: null,
    actualStepShowingInitMin: "0",
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

const showStepAnotation = (minutesRange,stepNum,stepText) => {

    if (stepsProperties.actualStepTimeOut != null){
        timesObj[stepsProperties.actualStepShowingInitMin][3] = true;
        clearTimeout(stepsProperties.actualStepTimeOut);
        stepsProperties.actualStepTimeOut = null;
    }

    stepsProperties.actualStepShowingInitMin = timesArr[timesArr.indexOf(minutesRange.split("-")[0].trim())];
    console.log(stepsProperties.actualStepShowingInitMin);
    timesObj[stepsProperties.actualStepShowingInitMin][3] = false;
    anotationStepMinuteRange.textContent = minutesRange;
    anotationStepNum.textContent = stepNum;
    anotationStepDetail.textContent = stepText;
    
    anotationStepShowMoreGradient.style.display = "none";
    anotationStepShowMore.style.display = "none";
    anotationStep.children[2].style.opacity = "0%";
    anotationStep.children[2].style.display = "block";
    anotationStep.style.width = "50%";
    setTimeout(() => {
        anotationStep.children[2].style.opacity = "100%";
        if (anotationStep.clientHeight < anotationStep.children[2].clientHeight) {
            anotationStepShowMoreGradient.style.display = "flex";
            anotationStepShowMore.style.display = "flex";
            anotationStepShowMore.setAttribute("ocPanelEl",stepNum);
        }
    },300)
    stepsProperties.actualStepTimeOut = setTimeout(() => {
        anotationStep.children[2].style.opacity = "0%";
        setTimeout(() => {
            anotationStep.children[2].style.display = "none";
            anotationStep.style.width = "0%";
            timesObj[stepsProperties.actualStepShowingInitMin][3] = true;
            stepsProperties.actualStepShowingInitMin = "0";
            stepsProperties.actualStepTimeOut = null;
        },500)
    },5500)
}

const relocateConfigPanel = () => {
    let height = configPanel.clientHeight;
    configPanel.style.top = "-"+`${height}px`;
}

const changeStepState = () => {
    if(stepsProperties.isActive){
        config_steps_slidable.style.left = "-1.5%";
        stepsProperties.isActive = false;
    }else{
        config_steps_slidable.style.left = "calc(100% - 1.6vh)";
        stepsProperties.isActive = true;
    }
}

const changeBucleState = () => {
    if(videoPlayerProperties.isBucleActive){
        config_bucle_slidable.style.left = "-1.5%";
        videoPlayerProperties.isBucleActive = false;
        video.loop = false;
    }else{
        config_bucle_slidable.style.left = "calc(100% - 1.6vh)";
        videoPlayerProperties.isBucleActive = true;
        video.loop = true;
    }
}

const changeConfigPanelState = () => {
    if (videoPlayerProperties.isInConfig === true){
        configPanel.style.display = "none";
        config.style.transform = "rotate(0deg)";
        videoPlayerProperties.isInConfig = false;
        makefsControlsContainer.removeAttribute("style")
        configOptionsPanel.style.display = "flex";
        speedRateOptions.style.display = "none";
    }else{
        configPanel.style.display = "block";
        config.style.transform = "rotate(60deg)";
        videoPlayerProperties.isInConfig = true;
        makefsControlsContainer.style.opacity = "100%";
    }
}

const updateProgressTime = () =>{
    let spx_pg = progressBar.clientWidth / duration;
    let formatedTime = formatSeconds(video.currentTime);
    progressBar.setAttribute("value", video.currentTime)
    videoPlayerProperties.watchedTime = video.currentTime;
    draggable_visual.style.left = spx_pg * video.currentTime + "px";
    draggable_progress.style.left = spx_pg * video.currentTime + "px";
    let actualTime = `${formatedTime[0]}:${formatedTime[1]}`;
    timeCounter.textContent = ` ${actualTime} / ${formatSeconds(duration)[0]}:${formatSeconds(duration)[1]}`;
    if (times.includes(actualTime) && stepsProperties.isActive) {
        let actualTimeObj = timesObj[actualTime];
        if (!actualTimeObj[3]) {
            return;
        }
        showStepAnotation(`${actualTimeObj[0]} - ${actualTimeObj[1]}`, timesArr.indexOf(actualTime)+1,actualTimeObj[2])
    }
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
// Config for speedRates

speedrategroup.forEach(element => {
    let speedrate = element.getAttribute("setRate");
    element.addEventListener("click", () =>{
        video.playbackRate = parseFloat(speedrate);
        element.style.animation = "config-button ease-out 1 .8s";
        setTimeout(() => {
            element.style.animation = "none";
        },800)
        
        actualSpeedRate.textContent = speedrate == 1 ? "Normal" :"X" + speedrate;
    })
});

// Step closing config

anotationStepClose.addEventListener("click", () => {
    let actualMinute = stepsProperties.actualStepShowingInitMin;
    anotationStep.children[2].style.display = "none";
    anotationStep.style.width = "0%";
    clearTimeout(stepsProperties.actualStepTimeOut);
    stepsProperties.actualStepTimeOut = null;
    timesObj[actualMinute][3] = false;
    setTimeout(() => {
        timesObj[actualMinute][3] = true;
    },1000)
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
    relocateConfigPanel();
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
        case "F":
            toggleFullscreen();
            break;
        case "m":
            muteAction();
            break;
        case "M":
            muteAction();
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

video.addEventListener("ended", () => {
    play.style.backgroundImage = "url(./img/video-controls/play.png)";
})

config.addEventListener("click", () => {
    changeConfigPanelState();
    relocateConfigPanel();
});

config_steps.addEventListener("click", () => {
    changeStepState();
    config_steps.style.animation = "config-button ease-out 1 .8s";
    setTimeout(() => {
        config_steps.removeAttribute("style");
    },800)
})
config_bucle.addEventListener("click", () => {
    changeBucleState();
    config_bucle.style.animation = "config-button ease-out 1 .8s";
    setTimeout(() => {
        config_bucle.removeAttribute("style");
    },800)
})

speedrateback.addEventListener("click", () => {
    speedRateOptions.style.display = "none";
    configOptionsPanel.style.display = "flex";
    relocateConfigPanel();
})

config_speedrate.addEventListener("click", () => {
    configOptionsPanel.style.display = "none";
    speedRateOptions.style.display = "flex";
    relocateConfigPanel();
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

// In video Steps Section

const stepsButton = document.querySelector("#makefs-steps-info-button");
const stepsContainer = document.querySelector(".makefs-steps-info-container");
const stepsGroup = document.querySelectorAll(".makefs-steps-info-template");
let stepsState = {};

const changeStepPanelState = () =>{
    if (videoPlayerProperties.isInStepsPanel){
        videoPlayerProperties.isInStepsPanel = false;
        stepsContainer.style.right = "-100%";
        if (!stepsButton.getAttribute("style") != null) {
            stepsButton.removeAttribute("style");
        }
    }else{
        videoPlayerProperties.isInStepsPanel = true;
        stepsContainer.style.right = "0px";
        stepsButton.style.backgroundImage = "url(./img/video-controls/steps-close.png)";
        stepsButton.style.transform = "rotate(360deg)";
        stepsButton.style.opacity = "100%";
    }
}

stepsButton.addEventListener("click", () => {
    changeStepPanelState();
})

let count = 0;
if (stepsGroup){
    stepsGroup.forEach((el) => {
        stepsState[count] = {
            isUsable: true,
            isOpened: false,
        };
        let actualStep = stepsState[count];
        if (el.clientHeight > el.children[2].clientHeight) {
            el.removeChild(el.children[0]);
        }else{
            let actualCount = count+1;
            el.addEventListener("click", () => {
                if (actualStep.isUsable){
                    let indicator = el.children[0];
                    let article = el.children[2];
                    if (actualStep.isOpened) {
                        el.style.paddingBottom = "0px";
                        indicator.style.transform = "rotate(0deg)";
                        actualStep.isOpened = false;
                        actualStep.isUsable = false;
                        setTimeout(() => {
                            actualStep.isUsable = true;
                        },300)
                    }else{
                        el.style.paddingBottom = `${article.clientHeight - el.clientHeight}px`;
                        indicator.style.transform = "rotate(180deg)";
                        actualStep.isOpened = true;
                        actualStep.isUsable = false;
                        setTimeout(() => {
                            if (stepsGroup.length == actualCount){
                                stepsContainer.scrollTo(0,stepsContainer.clientHeight);
                                console.log("JIOJIJAS")
                            }
                            actualStep.isUsable = true;
                        },300)
                    }
                }
            });
        }
        el.addEventListener("dblclick", () => {
            let goToMin = el.getAttribute("ocMinute").split(":");
            goToMin = parseInt(goToMin[0]) * 60 + parseInt(goToMin[1]);
            video.currentTime = goToMin;
            changeStepPanelState();
            updateProgressTime();
        });
        count++
    })
}
anotationStepShowMore.addEventListener("click", () => {
    let clickEv = new MouseEvent("click", {
        bubbles: true,
        cancelable: false
    })
    changeStepPanelState();
    let children = parseInt(anotationStepShowMore.getAttribute("ocPanelEl")) - 1;
    let toBeEmulatedEl = stepsGroup[children];

    setTimeout(() => {
        toBeEmulatedEl.dispatchEvent(clickEv);
        let actualMinute = stepsProperties.actualStepShowingInitMin;
        anotationStep.children[2].style.display = "none";
        anotationStep.style.width = "0%";
        clearTimeout(stepsProperties.actualStepTimeOut);
        stepsProperties.actualStepTimeOut = null;
        timesObj[actualMinute][3] = false;
        setTimeout(() => {
            timesObj[actualMinute][3] = true;
        },1000)
    },300)
})