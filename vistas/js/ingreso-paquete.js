let radioNo = document.getElementById("radio-paq-no");
let radioSi = document.getElementById("radio-paq-si");
let selectFragil = document.getElementById("select-fragil-paq");

radioNo.addEventListener("click",()=>{
    selectFragil.disabled = true;
    selectFragil.value = "";
});

radioSi.addEventListener("click",()=>{
    selectFragil.disabled = false;
});