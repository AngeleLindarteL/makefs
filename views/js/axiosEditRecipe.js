/*--------------------------------Update data*/
let uploadRecipe = document.querySelector("#uploadBtn2");
let regionComida = document.querySelector("#eRegiones");
let recipleTittle = document.querySelector("#recipeTittle");
let privateData = document.querySelector("#madePrivateBtn");
let arrayIngredients = [];
let arrayEtiquetas = [];
let steps = [];

let deleteRecipe = document.querySelector("#deleteRecipe");

deleteRecipe.addEventListener("click",(e)=>{
    e.preventDefault();
    let infoRecipeDelete = {
        "recipeid" : recipeid,
    };
    infoRecipeDelete = JSON.stringify(infoRecipeDelete);

    try{
        axios.post("../controllers/editRecipe/recipeDelete.php",infoRecipeDelete).then(
            res => {
                console.log(res);
                if(res.status==200){
                   window.location.href=`/chef/${chefid}`;
                }
            }
        )
    }catch(e){
        console.log("Error al subir la receta datos, Detalles " + e);
    }
})

uploadRecipe.addEventListener("click", (e)=>{
    e.preventDefault();
    if(privateData.checked){
        privateData = true;
    }else{
        privateData = 'false';
    }

    let contenedorSteps = document.querySelectorAll(".oneStepNewRecipe");

    contenedorSteps.forEach(element =>{
            let inputs = element.querySelectorAll(".steps");
            minIn = inputs[1].children[0].value + ":" + inputs[1].children[1].value;
            minFn = inputs[2].children[0].value + ":" + inputs[2].children[1].value;
            steptxt = inputs[0].value;
            steps.push([steptxt,minIn,minFn]);
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

    let infoRecipeEdit = {
        "recipeid" : recipeid,
        "namer" : recipleTittle.value,
        "ingredients" : arrayIngredients,
        "steps" : steps,
        "tags" : arrayEtiquetas,
        "regionTag" : regionComida.value,
        "privater" : privateData,
    };
    infoRecipeEdit = JSON.stringify(infoRecipeEdit);

    try{
        axios.post("../controllers/editRecipe/recipeEdit.php",infoRecipeEdit).then(
            res => {
                console.log(res);
                if(res.status==200){
                   window.location.href=`/chef/${chefid}`;
                }
            }
        )
    }catch(e){
        console.log("Error al subir la receta datos, Detalles " + e);
    }
})