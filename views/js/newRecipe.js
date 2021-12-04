const addIngredient = document.querySelector("#addIngredientBtn");
const addEtiqueta = document.querySelector("#addEtiquetaBtn");
const addStep = document.querySelector("#addStepBtn");
let regionValue = document.querySelector("#eRegiones");

let contador = 0;

const ingredientsSpace = document.querySelector("#inputsLateralesNewRecipe");
const etiquetasSpace = document.querySelector("#selectsEtiquetasNewRecipe");
const stepsSpace = document.querySelector("#inputsSteps");

const btnLessIngredients = document.querySelector("#lessIngrediens");
const btnLessEtiquetas = document.querySelector("#lessEtiquetas");
const btnLessSteps = document.querySelector("#lessSteps");


btnLessSteps.addEventListener("click",()=>{
    let countStepsDivs = stepsSpace.childElementCount;
    if(countStepsDivs==2){
        let ultimoStep = document.querySelector(".oneStepNewRecipe:last-child");
        stepsSpace.removeChild(ultimoStep);
        btnLessSteps.style.display="none";
    }else{
        let ultimoStep = document.querySelector(".oneStepNewRecipe:last-child");
        stepsSpace.removeChild(ultimoStep);
    }
    
})

btnLessEtiquetas.addEventListener("click",()=>{
    let countEtiquetasSpace = etiquetasSpace.childElementCount;
    if(countEtiquetasSpace==5){
        let ultimaEtiqueta = document.querySelector(".etiFood:last-child");
        etiquetasSpace.removeChild(ultimaEtiqueta);
        contador--;
        btnLessEtiquetas.style.display="none";
    }else{
        let ultimaEtiqueta = document.querySelector(".etiFood:last-child");
        etiquetasSpace.removeChild(ultimaEtiqueta);
        contador--;
    }
})

btnLessIngredients.addEventListener("click",()=>{
    let countIngredientsSpace = ingredientsSpace.childElementCount;
    if(countIngredientsSpace==2){
        let ultimoIngrediente = document.querySelector(".ingredient:last-child");
        ingredientsSpace.removeChild(ultimoIngrediente);
        btnLessIngredients.style.display="none";
    }else{
        let ultimoIngrediente = document.querySelector(".ingredient:last-child");
        ingredientsSpace.removeChild(ultimoIngrediente);
    }
})




addStep.addEventListener("click",()=>{
    btnLessSteps.style.display="inline-block";
    let steps = document.createElement("div");
    let inputTxt = document.createElement("input");
    let inputMinInicio = document.createElement("input");
    let inputMinFin = document.createElement("input");

    steps.className="oneStepNewRecipe";

    inputTxt.type="text";
    inputTxt.classList.add("stepTxtInput","steps");
    inputTxt.placeholder="Paso"

    inputMinInicio.type="text";
    inputMinInicio.classList.add("minInicioInput","steps");
    inputMinInicio.placeholder="minInicio"

    inputMinFin.type="text";
    inputMinFin.classList.add("minFinInput","steps");
    inputMinFin.placeholder="minFin"

    steps.appendChild(inputTxt);
    steps.appendChild(inputMinInicio);
    steps.appendChild(inputMinFin);

    stepsSpace.appendChild(steps);
})

addIngredient.addEventListener("click",()=>{

    btnLessIngredients.style.display="inline-block";
    let inputIngredient = document.createElement("input");
    inputIngredient.type="text";
    inputIngredient.name="ingredients";
    inputIngredient.placeholder="Ingrediente";
    inputIngredient.classList.add("ingredient");
    inputIngredient.classList.add("WhiteRecipetit");
    ingredientsSpace.appendChild(inputIngredient);
})

addEtiqueta.addEventListener("click",()=>{
    btnLessEtiquetas.style.display="inline-block";
    region = regionValue.value;
    let values;
    if(contador<=2){
        if(region == "latam"){
            values = ["latamSopa","latamVegana","latamGourmet","latamPostres","latamCasero","latamTipica",];
        }else if(region == "asia"){
            values = ["asiaSopa","asiaVegana","asiaGourmet","asiaPostres","asiaCasero","asiaTipica",];
        }else if(region == "norteA"){
            values = ["norteSopa","norteVegana","norteGourmet","nortePostres","norteCasero","norteTipica",];
        }else if(region == "europa"){
            values = ["europaSopa","europaVegana","europaGourmet","europaPostres","europaCasero","europaTipica",];
        }else if(region == "africa"){
            values = ["africaSopa","africaVegana","africaGourmet","africaPostres","africaCasero","africaTipica",];
        }else if(region == "oceania"){
            values = ["oceaniaSopa","oceaniaVegana","oceaniaGourmet","oceaniaPostres","oceaniaCasero","oceaniaTipica",];
        }
    
        let etiqueta = document.createElement("select");
        let opcion = document.createElement("option");
        let opcion2 = document.createElement("option");
        let opcion3 = document.createElement("option");
        let opcion4 = document.createElement("option");
        let opcion5 = document.createElement("option");
        let opcion6 = document.createElement("option");

        etiqueta.className="etiFood"
    
        opcion.value=values[0];
        opcion.text="Sopas";
    
        opcion2.value=values[1];
        opcion2.text="Vegana";
    
        opcion3.value=values[2];
        opcion3.text="Gourmet";
    
        opcion4.value=values[3];
        opcion4.text="Postres";
    
        opcion5.value=values[4];
        opcion5.text="Casero";
    
        opcion6.value=values[5];
        opcion6.text="Tipicas";
    
        etiqueta.add(opcion,null);
        etiqueta.add(opcion2,null);
        etiqueta.add(opcion3,null);
        etiqueta.add(opcion4,null);
        etiqueta.add(opcion5,null);
        etiqueta.add(opcion6,null);
    
        etiquetasSpace.appendChild(etiqueta);
        contador++;
    }
    
})