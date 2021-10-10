const liColl = document.querySelectorAll(".step-li");

liColl.forEach(e => {
    e.addEventListener('click', (ev) => {
        liColl.forEach(e => {
            e.classList.remove("focus-step-on");
        })
        e.classList.add("focus-step-on");
    })
})