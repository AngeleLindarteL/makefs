/*--------------------------------Update data*/
let uploadRecipe = document.querySelector("#uploadBtn");
let regionComida = document.querySelector("#eRegiones");
let recipleTittle = document.querySelector("#recipeTittle");
let video = document.querySelector("#recipeVideo");
let imagen = document.querySelector("#recipeImg");
let arrayIngredients = [];
let arrayEtiquetas = [];
let steps = [];

uploadRecipe.addEventListener("click", (e)=>{
    e.preventDefault();

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
        alert("selecciona un video");
    }

    try{
        axios.post("../controllers/recipeCreation/recipeCreation.php",infoRecipe).then(
            res => {
                console.log(res);
                if(res.status==200){
                   alert("subida con exito");
                }
            }
        )
    }catch(e){
        console.log("Error al subir la receta datos, Detalles " + e);
    }
})
