let btnFollowUnloged = document.querySelector("#followUnloged");
let sectionFollowUnloged = document.querySelector("#unlogedFollowSect");
let btnCloseFollowUnloged = document.querySelector("#close-UnlogedFollow");
let buttonGoToLog = document.querySelector("#logRedirect")

buttonGoToLog.addEventListener("click", (e)=>{
    e.preventDefault();
    window.location.href="/login";
})

btnFollowUnloged.addEventListener("click",(e)=>{
    e.preventDefault();
    sectionFollowUnloged.style.display="flex";
    setTimeout(()=>{
        sectionFollowUnloged.style.opacity="100%"
    },300)
})

btnCloseFollowUnloged.addEventListener("click",(e)=>{
    e.preventDefault();
    sectionFollowUnloged.style.opacity="0";
    setTimeout(()=>{
        sectionFollowUnloged.style.display="none";
    },300)
})