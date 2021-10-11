const liColl = document.querySelectorAll(".step-li");
const stepList = document.getElementById("step-container");
let stpCounter = 0;
let mtt = false;
let stepMap = {};

function focusOnStep(obj,n){
    if(!obj.classList.contains("focus-step-on")){
        liColl.forEach(e => {
            e.classList.remove("focus-step-on");
        })
        obj.classList.add("focus-step-on");
    }else{
        obj.classList.remove("focus-step-on");
    }
    stepList.style.top = `-${stepMap[n]}vh`
}

liColl.length > 3 ? mtt = true : mtt = false;

let i = 1;
let ct = 0;
let multiplos = []
for(let i = 1; i <= (liColl.length / 3); i++){
    multiplos.push(i * 3)
}
liColl.forEach(e => {
    let n = i;
    e.addEventListener('click', (ev) => {
        focusOnStep(e,n)
    })
    if(mtt){
        multiplos.includes(i) ? ct += 20 : ct = ct;
        stepMap[i] = ct;
        i++
    }
})