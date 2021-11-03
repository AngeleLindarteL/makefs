let button = document.getElementById("boton");
let report = document.getElementById("reportSection");
let reporting = false;
button.addEventListener('click',(e)=>{
    if(reporting){
        report.style.opacity = "0";
        setTimeout(function(){
            report.style.display ="none";
        },300);
        reporting=false;
    }else{
        report.style.display = "flex";
        setTimeout(()=>{
            report.style.opacity ="100%";
        },300);
        reporting=true;
    }
})

