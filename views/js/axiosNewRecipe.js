/*--------------------------------Update data*/
let uploadRecipe = document.querySelector("#uploadBtn");
let regionComida = document.querySelector("#eRegiones");
let recipleTittle = document.querySelector("#recipeTittle");
let video = document.querySelector("#recipeVideo");
let imagen = document.querySelector("#recipeImg");
let privateData = document.querySelector("#madePrivateBtn");
let arrayIngredients = [];
let arrayEtiquetas = [];
let steps = [];
let duration;

/*--------------------------------Update data*/
/*-----------------------------Notification */

const uploadFoto = document.querySelector("#btnImgUpload");
const uploadVid = document.querySelector("#btnVideoUpload");
const divUploadVid = document.querySelector("#divUploadVideo");
const divUploadImg = document.querySelector("#divUploadImg");
const notification_msg = document.querySelector("#notification-msg");
const notification_container = document.querySelector(".makefs-notification");
const notification_container_video = document.querySelector(".video-notifi");
const notification_msg_video = document.querySelector("#notification-msg-video")
const notifiactionStates = {
    loading_photo: "Se esta subiendo tu foto, espera un momento porfavor",
    updated_photo: "¡Esta Hecho! Tu foto se subio con éxito.",
    error_upload: "Fallo inesperado en la subida de la foto.",
    error_too_large: "Imagen muy pesada.",
    error_unsuported_type: "Tipo de archivo no soportado para la imagen",
}
const notifiactionStatesVid = {
    loading_photo: "Se esta subiendo tu video, espera un momento porfavor",
    updated_photo: "¡Esta Hecho! Tu video se subio con éxito.",
    error_upload: "El video que subiste es no está en el formato apropiado o es muy grande.",
    error_unsuported_type: "Tipo de archivo no soportado para tu video",
} 

/*-----------------------------Notification */

uploadFoto.addEventListener("click", async (e) => {
    imagen.addEventListener("change",()=>{
        divUploadImg.style.background="#FFB5B5";
    })
})

uploadVid.addEventListener("click", async (e) => {
    video.addEventListener("change",()=>{
        divUploadVid.style.background="#FFB5B5";
    })
})

uploadRecipe.addEventListener("click", async (e)=>{
    let arrayIngredients = [];
    let arrayEtiquetas = [];
    let steps = [];
    
    e.preventDefault();
    if(privateData.checked){
        privateData = true;
    }else{
        privateData = 'false';
    }

    if(duration==''){
        return;
    }
    let contenedorSteps = document.querySelectorAll(".oneStepNewRecipe");

    contenedorSteps.forEach(element =>{

        let inputs = element.querySelectorAll(".steps");
        let step = [];
        inputs.forEach(elements=>{
            step.push(elements.value);
        })
        steps.push(step);
    });
    
    let ingredients = document.querySelectorAll(".ingredient");
    ingredients.forEach(element => {
        let elemento = element.value;
        arrayIngredients.push(elemento);
    });
    
    let etiquetas = document.querySelectorAll(".etiFood");
    etiquetas.forEach(element => {
        let elemento = element.value;
        arrayEtiquetas.push(elemento);
    });

    let infoRecipe = {
        "chefid": chefid,
        "namer" : recipleTittle.value,
        "ingredients" : arrayIngredients,
        "video" : video.files[0].name,
        "imagen": imagen.files[0].name,
        "steps" : steps,
        "duration" : duration,
        "tags" : arrayEtiquetas,
        "regionTag" : regionComida.value,
        "privater" : privateData,
        "chefname": chefname,
    };
    infoRecipe = JSON.stringify(infoRecipe);

    if(video.files.length>0){
        notification_container_video.style.display = "flex";
        notification_msg_video.textContent = notifiactionStatesVid.loading_photo;
        setTimeout(() => {
            notification_container_video.style.opacity = "100%";
        }, 10);
        notification_container_video.classList.add("loading");
        let formData = new FormData();
        formData.append("videoR",video.files[0]);
        console.log(formData);
        await axios.post("../controllers/recipeCreation/subirVideo.php", formData, {
            "Content-Type": "multipart/form-data"
        })
        .then(res=>{
            if (res.data.msg == "success_200") {
                notification_container_video.classList.replace("loading","success");
                notification_msg_video.textContent = notifiactionStatesVid.updated_photo;
                setTimeout(() => {
                    notification_container_video.style.opacity = "0";
                    notification_container_video.style.top = "11vh";
                    setTimeout(() => {
                        notification_container_video.style.display = "none";
                        notification_container_video.classList.replace("success","loading");
                        notification_container_video.style.top = "8vh";
                    }, 100);
                }, 5000);
            }else{
                notification_container_video.classList.replace("loading","error");
                setTimeout(() => {
                    notification_container_video.style.opacity = "0";
                    notification_container_video.style.top = "11vh";
                    setTimeout(() => {
                        notification_container_video.style.display = "none";
                        notification_container_video.classList.replace("error","loading");
                        notification_container_video.style.top = "8vh";
                    }, 100);
                }, 5000);
                console.log(res.data);
                switch (res.data.msg) {
                    case "error_upload":
                        notification_msg_video.textContent = notifiactionStatesVid.error_upload;
                        break;
                    case "error_unsuported_type":
                        notification_msg_video.textContent = notifiactionStatesVid.error_unsuported_type;
                        break;
                }
                exit();
            }
        });
    }else{
        alert("selecciona un Video");
    }
    
    if(imagen.files.length>0){


        notification_container.style.display = "flex";
        notification_msg.textContent = notifiactionStates.loading_photo;
        setTimeout(() => {
            notification_container.style.opacity = "100%";
        }, 10);
        notification_container.classList.add("loading");
        
        let formData = new FormData();
        formData.append("imagenR",imagen.files[0]);
        console.log(formData);
        await axios.post("../controllers/recipeCreation/subirImagen.php", formData, {
            "Content-Type": "multipart/form-data"
        })
        .then(res=>{
            if (res.data.msg == "success_200") {
                notification_container.classList.replace("loading","success");
                notification_msg.textContent = notifiactionStates.updated_photo;
                setTimeout(() => {
                    notification_container.style.opacity = "0";
                    notification_container.style.top = "11vh";
                    setTimeout(() => {
                        notification_container.style.display = "none";
                        notification_container.classList.replace("success","loading");
                        notification_container.style.top = "8vh";
                    }, 100);
                }, 5000);
            }else{
                notification_container.classList.replace("loading","error");
                setTimeout(() => {
                    notification_container.style.opacity = "0";
                    notification_container.style.top = "11vh";
                    setTimeout(() => {
                        notification_container.style.display = "none";
                        notification_container.classList.replace("error","loading");
                        notification_container.style.top = "8vh";
                    }, 100);
                }, 5000);
                console.log(res.data);
                switch (res.data.msg) {
                    case "error_upload":
                        notification_msg.textContent = notifiactionStates.error_upload;
                        break;
                    case "error_too_large":
                        notification_msg.textContent = notifiactionStates.error_too_large;
                        break;
                    case "error_unsuported_type":
                        notification_msg.textContent = notifiactionStates.error_unsuported_type;
                        break;
                }
                exit();
            }
        });
    }else{
        alert("selecciona una Imagen");
    }

    try{
        axios.post("../controllers/recipeCreation/recipeCreation.php",infoRecipe).then(
            res => {
                console.log(res);
                if(res.status==200){
                   window.location.href=`../views/chef-view.php?chef=${chefid}`;
                }
            }
        )
    }catch(e){
        console.log("Error al subir la receta datos, Detalles " + e);
    }
})

const validateFile = (file) => {

    var video2 = document.createElement('video');
    video2.preload = 'metadata';

    video2.onloadedmetadata = () => {
        window.URL.revokeObjectURL(video2.src);

        if (video2.duration < 1) {

            console.log("Invalid Video! video is less than 1 second");
            return;
        }
	duration = video2.duration;
    }

    video2.src = URL.createObjectURL(file);
}

video.addEventListener("change", ()=>{
    validateFile(video.files[0]);
})

