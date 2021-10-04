const userLog = document.querySelector("#userlog");
const userSelection = document.querySelector("#user_selection");
const navBar = document.querySelector("#nav-bar-ct");
const navButton = document.querySelector("#nav-menu-btn")

userLog.addEventListener('click', () => {
    if(userSelection.className == "userSelectClose"){
        userSelection.style.display = "flex";
        setTimeout(() => {
            userSelection.classList.replace("userSelectClose","userSelectOpen")
        },1)
    }else{        
        userSelection.style.display = "none";
        setTimeout(() => {
            userSelection.classList.replace("userSelectOpen", "userSelectClose");
        },1)
    }
})

navButton.addEventListener('click', () => {
    if(navBar.classList.contains("nav-bar-hidden")){
        navBar.classList.replace("nav-bar-hidden","nav-bar-showing")
        navButton.classList.add("displayedBar")
    }else{
        navBar.classList.replace("nav-bar-showing", "nav-bar-hidden");
        navButton.classList.remove("displayedBar")
    }
})

