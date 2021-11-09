let btnLAT2 = document.getElementById("soup");
let btnASI2 = document.getElementById("veg");
let btnNA2 = document.getElementById("gourmet");
let btnEUW2 = document.getElementById("postre");
let btnAF2 = document.getElementById("casero");
let btnOC2 = document.getElementById("tipico");

let imgSubcategories = ["./img/sopaCat.png","./img/vegetarianCat.png",
"./img/gourmetCat.png","./img/postresCat.png",
"./img/caseroCat.png"];

let imgTipica = ["./img/latamTipica.png","./img/asiaTipica.png",
"./img/norteamericaTipica.png","./img/europaTipica.png","./img/africaTipica.png",
"./img/oceaniaTipica.png"];

let imgCategorias = ["./img/latamCat.png","./img/asiaCat.png",
"./img/norteamericaCat.png","./img/europaCat.png","./img/africaCat.png",
"./img/oceaniaCat.png"];

let txtCategorias = ["Latinoamerica","Asia","Norteamerica","Europa","Africa","Oceania"]

let txtSubcategorias = ["Sopas","Vegetariana","Gourmet","Postres","Casero","Tipicas"];

let hrefsSub1 = ["#","#","#","#","#","#"];
let hrefsSub2 = ["#","#","#","#","#","#"];
let hrefsSub3 = ["#","#","#","#","#","#"];
let hrefsSub4 = ["#","#","#","#","#","#"];
let hrefsSub5 = ["#","#","#","#","#","#"];
let hrefsSub6 = ["#","#","#","#","#","#"];
let hrefsVacios = ["#","#","#","#","#","#"];

let btnClose1 = document.getElementById("returnBtnDesp");



function changeSubcategory(imgComida,div,arrayDeTexto,arrayHrefs,enteroDelArrayImg,enteroDelArrayTXT) {
    div.children[0].setAttribute("href",arrayHrefs[enteroDelArrayTXT]);
    div.children[0].children[0].setAttribute("src",imgComida[enteroDelArrayImg]);
    div.children[0].children[1].textContent = arrayDeTexto[enteroDelArrayTXT];
}

btnClose1.addEventListener("click",()=>{
    changeSubcategory(imgCategorias,btnLAT2,txtCategorias,hrefsVacios,0,0);
    changeSubcategory(imgCategorias,btnASI2,txtCategorias,hrefsVacios,1,1);
    changeSubcategory(imgCategorias,btnNA2,txtCategorias,hrefsVacios,2,2);
    changeSubcategory(imgCategorias,btnEUW2,txtCategorias,hrefsVacios,3,3);
    changeSubcategory(imgCategorias,btnAF2,txtCategorias,hrefsVacios,4,4);
    changeSubcategory(imgCategorias,btnOC2,txtCategorias,hrefsVacios,5,5);
    btnClose1.style.display="none";
    btnClose1.innerHTML=``;
})

btnLAT2.addEventListener("click",()=>{
    changeSubcategory(imgSubcategories,btnLAT2,txtSubcategorias,hrefsSub1,0,0);
    changeSubcategory(imgSubcategories,btnASI2,txtSubcategorias,hrefsSub1,1,1);
    changeSubcategory(imgSubcategories,btnNA2,txtSubcategorias,hrefsSub1,2,2);
    changeSubcategory(imgSubcategories,btnEUW2,txtSubcategorias,hrefsSub1,3,3);
    changeSubcategory(imgSubcategories,btnAF2,txtSubcategorias,hrefsSub1,4,4);
    changeSubcategory(imgTipica,btnOC2,txtSubcategorias,hrefsSub1,0,5);
    btnClose1.style.display="flex";
    btnClose1.innerHTML=`
    <a href='#'>
    <h2><<</h2>
    </a>
    `;
})
btnASI2.addEventListener("click",()=>{
    changeSubcategory(imgSubcategories,btnLAT2,txtSubcategorias,hrefsSub2,0,0);
    changeSubcategory(imgSubcategories,btnASI2,txtSubcategorias,hrefsSub2,1,1);
    changeSubcategory(imgSubcategories,btnNA2,txtSubcategorias,hrefsSub2,2,2);
    changeSubcategory(imgSubcategories,btnEUW2,txtSubcategorias,hrefsSub2,3,3);
    changeSubcategory(imgSubcategories,btnAF2,txtSubcategorias,hrefsSub2,4,4);
    changeSubcategory(imgTipica,btnOC2,txtSubcategorias,hrefsSub2,1,5);
    btnClose1.style.display="flex";
    btnClose1.innerHTML=`
    <a href='#'>
    <h2><<</h2>
    </a>
    `;
})
btnNA2.addEventListener("click",()=>{
    changeSubcategory(imgSubcategories,btnLAT2,txtSubcategorias,hrefsSub3,0,0);
    changeSubcategory(imgSubcategories,btnASI2,txtSubcategorias,hrefsSub3,1,1);
    changeSubcategory(imgSubcategories,btnNA2,txtSubcategorias,hrefsSub3,2,2);
    changeSubcategory(imgSubcategories,btnEUW2,txtSubcategorias,hrefsSub3,3,3);
    changeSubcategory(imgSubcategories,btnAF2,txtSubcategorias,hrefsSub3,4,4);
    changeSubcategory(imgTipica,btnOC2,txtSubcategorias,hrefsSub3,2,5);
    btnClose1.style.display="flex";
    btnClose1.innerHTML=`
    <a href='#'>
    <h2><<</h2>
    </a>
    `;
})
btnEUW2.addEventListener("click",()=>{
    changeSubcategory(imgSubcategories,btnLAT2,txtSubcategorias,hrefsSub4,0,0);
    changeSubcategory(imgSubcategories,btnASI2,txtSubcategorias,hrefsSub4,1,1);
    changeSubcategory(imgSubcategories,btnNA2,txtSubcategorias,hrefsSub4,2,2);
    changeSubcategory(imgSubcategories,btnEUW2,txtSubcategorias,hrefsSub4,3,3);
    changeSubcategory(imgSubcategories,btnAF2,txtSubcategorias,hrefsSub4,4,4);
    changeSubcategory(imgTipica,btnOC2,txtSubcategorias,hrefsSub4,3,5);
    btnClose1.style.display="flex";
    btnClose1.innerHTML=`
    <a href='#'>
    <h2><<</h2>
    </a>
    `;
})
btnAF2.addEventListener("click",()=>{
    changeSubcategory(imgSubcategories,btnLAT2,txtSubcategorias,hrefsSub5,0,0);
    changeSubcategory(imgSubcategories,btnASI2,txtSubcategorias,hrefsSub5,1,1);
    changeSubcategory(imgSubcategories,btnNA2,txtSubcategorias,hrefsSub5,2,2);
    changeSubcategory(imgSubcategories,btnEUW2,txtSubcategorias,hrefsSub5,3,3);
    changeSubcategory(imgSubcategories,btnAF2,txtSubcategorias,hrefsSub5,4,4);
    changeSubcategory(imgTipica,btnOC2,txtSubcategorias,hrefsSub5,4,5);
    btnClose1.style.display="flex";
    btnClose1.innerHTML=`
    <a href='#'>
    <h2><<</h2>
    </a>
    `;
})
btnOC2.addEventListener("click",()=>{
    changeSubcategory(imgSubcategories,btnLAT2,txtSubcategorias,hrefsSub6,0,0);
    changeSubcategory(imgSubcategories,btnASI2,txtSubcategorias,hrefsSub6,1,1);
    changeSubcategory(imgSubcategories,btnNA2,txtSubcategorias,hrefsSub6,2,2);
    changeSubcategory(imgSubcategories,btnEUW2,txtSubcategorias,hrefsSub6,3,3);
    changeSubcategory(imgSubcategories,btnAF2,txtSubcategorias,hrefsSub6,4,4);
    changeSubcategory(imgTipica,btnOC2,txtSubcategorias,hrefsSub6,5,5);
    btnClose1.style.display="flex";
    btnClose1.innerHTML=`
    <a href='#'>
    <h2><<</h2>
    </a>
    `;
})

