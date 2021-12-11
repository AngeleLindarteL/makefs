let bodyy = document.querySelector("body");

window.addEventListener("load", ()=>{

    let script1 = document.querySelector("#categories1");
    let script2 = document.querySelector("#categories2");
    let scriptRes = document.querySelector("#categoriesRes");

    if(window.innerWidth < 970){
        if(script1 == null){

        }else{
            bodyy.removeChild(script1);
            bodyy.removeChild(script2);
        }
        if(!document.querySelector("#categoriesRes")){
            scriptRes = document.createElement("script");
            scriptRes.src = "../../views/js/categoriesResponsive.js";
            scriptRes.id = "categoriesRes"
            bodyy.appendChild(scriptRes);
        }
    }else{
        if(!document.querySelector("#categories1")){
            script1 = document.createElement("script");
            script1.src= "../../views/js/categoriesmenu.js";
            script1.id = "categories1";

            script2 = document.createElement("script");
            script2.src= "../../views/js/footerHidden.js";
            script2.id = "categories2";


            bodyy.appendChild(script1);
            bodyy.appendChild(script2);
        }
        if(document.querySelector("#categoriesRes")){
            bodyy.removeChild(scriptRes);
        }
    }
})