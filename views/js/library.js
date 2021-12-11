const allDelTriggers = document.querySelectorAll(".del-bookshelf");
const allRecipes = document.querySelectorAll(".recipe-template");
const confirmSection = document.querySelector("#confirm-section");
const confirmImg = document.querySelector("#confirm-recipe-img");
const confirmChef = document.querySelector("#confirmation-chef-name");
const confirmTitle = document.querySelector("#confirmation-recipe-title");
const notification = document.querySelector(".bookshelf-notification");
const notificationImg = document.querySelector(".bookshelf-notification").children[0];
const notificationMsg = document.querySelector(".bookshelf-notification").children[1].children[1];
const notificationCancelBtn = document.querySelector("#cancel-elimination");
const triggerConfirmDelete = document.querySelector("#trigger-confirm");
const triggerCancelDelete = document.querySelector("#trigger-cancel");
const pileContainer = document.querySelector(".pile-waiting");
const acnitadedeletras= 9;
let notificationTimeOut = null;

const responseStates = {
    loading: "Espera Porfavor, estamos eliminando la receta de tu biblioteca",
    canceled: "¡Bien! Nuevamente se agrego a tu biblioteca la receta ",
    deleted: "¡Perfecto! Se ha eliminado de tu biblioteca ",
    error: "Hubo un error al intentar interactuar con la receta. Porfavor intenta denuevo o contacta con soporte"
}

const asyncHandler = {
    isFetching: false,
    actualIdFetching: null,
    pileIds: [],
    nextInPile: [],
    fetchedEls: 0,
    pileNextHandler: null
}

const cancelPosTimeOut = () => {
    if (notificationTimeOut != null) {
        clearTimeout(notificationTimeOut);
        notificationTimeOut = null;
    }
}

const showNewConfirmationScreen = (picroute,chefName,recipeTitle,recipeId,containerPos) => {
    confirmTitle.textContent = recipeTitle;
    confirmChef.textContent = chefName;
    confirmImg.src = picroute;

    confirmSection.style.display = "flex";
    setTimeout(() =>{
        confirmSection.style.opacity = "1";
    }, 10)
    triggerConfirmDelete.setAttribute("recipeDelId",recipeId);
    triggerConfirmDelete.setAttribute("recipePos",containerPos);
    triggerConfirmDelete.setAttribute("recipeTitle",recipeTitle);
}

const hideNotification = () => {
    notificationTimeOut = setTimeout(() => {
        notification.style.opacity = "0";
        setTimeout(() => {
            notification.removeAttribute("style");
            pileContainer.style.display = "none";
        },200)
    },5000)
}

const setNotificationState = ({img="../views/iconos/book.png",msg="Bookshlef Notification",isLoad=false,hideButton=true,recipeCancelId,recipeTitle,containerPos}) => {
    notification.style.display = "flex";
    setTimeout(() => {
        notification.style.opacity = "1";
    },10)
    if (hideButton){
        notificationCancelBtn.style.display = "none";
    }else{
        notificationCancelBtn.style.display = "flex";
        notificationCancelBtn.setAttribute("recipeid",recipeCancelId);
        notificationCancelBtn.setAttribute("title",recipeTitle);
        notificationCancelBtn.setAttribute("pos",containerPos);
    }
    if (isLoad) {
        notificationImg.style.animation = "onloadNotif .8s infinite";
    }else{
        notificationImg.style.animation = "none";
    }
    notificationImg.src = img;
    notificationMsg.textContent = msg;
}

const hideConfirmationScreen = () => {
    confirmSection.style.opacity = "0";
    setTimeout(() =>{
        confirmSection.removeAttribute("style");
    }, 200)
}

const axiosToLib = (libVideoId,videoTitle,recipePos) => {
    cancelPosTimeOut();
    asyncHandler.isFetching = true;
    asyncHandler.actualIdFetching = libVideoId;
    // hideConfirmationScreen();
    const data = {
        userid: uid,
        recipeid:libVideoId,
    }
    axios.post("../controllers/saveRecipe.php",JSON.stringify(data))
    .then((res) => {
        asyncHandler.isFetching = false;
        asyncHandler.fetchedEls++;
        console.log(res);
        if (res.data == "removed"){
            let msg = responseStates.deleted + videoTitle;
            setNotificationState({img:"../views/iconos/remove-book.png",msg:msg,isLoad:false,hideButton:false,recipeCancelId:libVideoId,recipeTitle:videoTitle,containerPos:recipePos});
            allRecipes[parseInt(recipePos)].style.width = "0";
            allRecipes[parseInt(recipePos)].style.margin = "0";
        }else if(res.data == "saved"){
            let msg = responseStates.canceled + videoTitle;
            setNotificationState({img:"../views/iconos/book.png",msg:msg,isLoad:false})
            allRecipes[parseInt(recipePos)].removeAttribute("style");
        }else{
            setNotificationState({img:"../views/iconos/loading-circles.png",msg:responseStates.error,isLoad:true})
        }
        if (asyncHandler.nextInPile.length > 0) {
            asyncHandler.pileNextHandler = setTimeout(() => {
                let el = asyncHandler.nextInPile[0];
                axiosToLib(el[0],el[1],el[2]);
                asyncHandler.nextInPile.shift();
                asyncHandler.pileIds.shift();
                setNotificationState({img:"../views/iconos/loading-circles.png",msg:responseStates.loading,isLoad:true})
                pileContainer.removeChild(document.querySelectorAll(".waiting-pile")[0]);
                if (asyncHandler.nextInPile.length == 0){
                    pileContainer.removeAttribute("style");
                }
            },3000)
        }else{
            hideNotification();
        }
    })
    .catch((res) => {
        setNotificationState({img:"../views/iconos/loading-circles.png",msg:responseStates.error,isLoad:true})
    })
}


allDelTriggers.forEach((delB) => {
    const recipeid = delB.getAttribute("library_id");
    const containerPos = delB.getAttribute("position_in_library");
    const chefName = delB.getAttribute("chefName");
    const recipeTitle = delB.getAttribute("recipeTitle");
    const picDir = delB.getAttribute("picDir");

    delB.addEventListener("click", () => {
        showNewConfirmationScreen(picDir,chefName,recipeTitle,recipeid,containerPos);
    })
})

triggerConfirmDelete.addEventListener("click", () => {
    const id = triggerConfirmDelete.getAttribute("recipedelid");
    const title = triggerConfirmDelete.getAttribute("recipeTitle");
    const pos = triggerConfirmDelete.getAttribute("recipePos");
    hideConfirmationScreen();
    if (asyncHandler.isFetching || asyncHandler.nextInPile.length > 0){
        if (asyncHandler.pileIds.indexOf(id) != -1){
            return;
        }
        asyncHandler.pileIds.push(id);
        asyncHandler.nextInPile.push([id,title,pos]);
        let asocBtn = document.createElement("button");
        asocBtn.textContent = title.substr(0,9);
        asocBtn.classList.add("waiting-pile");
        asocBtn.setAttribute("recipe_id",id);
        asocBtn.addEventListener("click", () => {
            if (asyncHandler.actualIdFetching != id){
                asyncHandler.nextInPile.splice(asyncHandler.pileIds.indexOf(id));
                asyncHandler.pileIds.splice(asyncHandler.pileIds.indexOf(id));
                pileContainer.removeChild(asocBtn);
            }
        })
        pileContainer.appendChild(asocBtn);
        pileContainer.style.display = "flex";
        return;
    }
    setNotificationState({img:"../views/iconos/loading-circles.png",msg:responseStates.loading,isLoad:true});
    axiosToLib(id,title,pos);
})
triggerCancelDelete.addEventListener("click", () => {
    hideConfirmationScreen();
})

notificationCancelBtn.addEventListener("click", () => {
    let recipeid = notificationCancelBtn.getAttribute("recipeid");
    let recipeTitle = notificationCancelBtn.getAttribute("title");
    let containerPos = notificationCancelBtn.getAttribute("pos");
    setNotificationState({img:"../views/iconos/loading-circles.png",msg:responseStates.loading,isLoad:true})
    if (asyncHandler.pileNextHandler != null){
        clearTimeout(asyncHandler.pileNextHandler);
        asyncHandler.pileNextHandler = null;
    }
    axiosToLib(recipeid,recipeTitle,containerPos);
})