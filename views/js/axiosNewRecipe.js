/*--------------------------------Update data*/
let uploadRecipe = document.querySelector("#uploadBtn");
let regionComida = document.querySelector("#eRegiones");
let recipleTittle = document.querySelector("#recipeTittle");
let video = document.querySelector("#recipeVideo");
let imagen = document.querySelector("#recipeImg");
let arrayIngredients = [];
let arrayEtiquetas = [];
let steps = [];
let duration;

uploadRecipe.addEventListener("click", (e)=>{
    e.preventDefault();

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
    };
    infoRecipe = JSON.stringify(infoRecipe);

    if(video.files.length>0){
        let formData = new FormData();
        formData.append("videoR",video.files[0]);
        console.log(formData);
        axios.post("../controllers/recipeCreation/subirVideo.php", formData, {
            "Content-Type": "multipart/form-data"
        })
        .then(res=>{
            console.log(res);
        });
    }else{
        alert("selecciona un Video");
    }

    if(imagen.files.length>0){
        let formData = new FormData();
        formData.append("imagenR",imagen.files[0]);
        console.log(formData);
        axios.post("../controllers/recipeCreation/subirImagen.php", formData, {
            "Content-Type": "multipart/form-data"
        })
        .then(res=>{
            console.log(res);
        });
    }else{
        alert("selecciona una Imagen");
    }

    try{
        axios.post("../controllers/recipeCreation/recipeCreation.php",infoRecipe).then(
            res => {
                console.log(res);
                if(res.status==200){
                   alert("subida con exito");
                   //window.location.href="../views/chef-view.php";
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