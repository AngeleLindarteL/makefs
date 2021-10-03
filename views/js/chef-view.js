let chefConfig = document.getElementById("chef-config");
let btnCollection = document.querySelector(".action-buttons-container");

chefConfig.addEventListener("click",(e) => {
    if(btnCollection.classList.contains("showing-action-container")){
        btnCollection.classList.remove("showing-action-container");
    }else{
        btnCollection.classList.add("showing-action-container");
    }
})