let button = document.getElementById("boton");
let report = document.getElementById("reportSection");
let closeReport = document.getElementById("closereport");
button.addEventListener('click',(e)=>{
    report.style.display = "flex";
    setTimeout(()=>{
        report.style.opacity ="100%";
    },300);
    reporting=true;
})
closeReport.addEventListener('click',(e)=>{
    report.style.opacity = "0";
        setTimeout(function(){
            report.style.display ="none";
        },300);
})
