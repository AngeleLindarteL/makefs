const saveNotification = document.querySelector(".bookshelf-notification");
const saveNotifMsg = document.querySelector("#notification-save-msg");
const saveNotifico = document.querySelector("#bookshelf-icon");
const saveTrigger = document.querySelector("#save-actual-recipe");

const notifstates = {
    removed: `Se quito el video de <b>${chefName}</b> de tu biblioteca`,
    saved: `El video de <b>${chefName}</b> se agregó a tu biblioteca`,
    error: `Hubó un error con el video de <b>${chefName}</b> en tu biblioteca`,
    actualTimeOut: null,
}

const setButtonState = (isAcSaved) => {
    if (isAcSaved){
        saveTrigger.style.backgroundColor = "var(--color5)";
        saveTrigger.style.width = "12vh";
        saveTrigger.style.color = "white";
        saveTrigger.textContent = "Guardado ✔";
        recipeProperties.savedrecipes = 1;
    }else{
        saveTrigger.removeAttribute("style");
        saveTrigger.textContent = "Guardar";
        recipeProperties.savedrecipes = 0;
    }
}
setButtonState(isSaved);

const showNotif = (msg, ico) => {
    notifstates.actualTimeOut != null ? clearTimeout(notifstates.actualTimeOut): true;
    saveNotifico.src = ico;
    saveNotifMsg.innerHTML = msg;
    saveNotification.style.display = "flex";
    setTimeout(() => {
        saveNotification.style.opacity = "1";
    },10)
    notifstates.actualTimeOut = setTimeout(()=>{
        saveNotification.style.opacity = "0";
        saveNotification.style.bottom = "-50%";
        setTimeout(() => {
            saveNotification.style.display = "none";
            saveNotification.style.bottom = "0";
        },200)
    },5000)
}

saveTrigger.addEventListener("click", () => {
    if (followerid == 0) {
        let advise = document.querySelector(".not-registered-advise");
        advise.style.display = "flex";
        return;
    }
    let data = {
        userid: followerid,
        recipeid: videoID
    }
    axios.post("../controllers/saveRecipe.php",JSON.stringify(data))
    .then(res => {
        console.log(res)
        if (res.data === "saved"){
            showNotif(notifstates.saved,"../views/iconos/book.png");
            setButtonState(true);
        }else{
            showNotif(notifstates.removed,"../views/iconos/remove-book.png");
            setButtonState(false);
        }
    }).catch(err => {
        showNotif(notifstates.error, "../views/iconos/error.png");
        setButtonState(isSaved);
     })
})