let radioNo = document.getElementById("radio-lote-no");
let radioSi = document.getElementById("radio-lote-si");
let selectFragil = document.getElementById("select-fragil-lote");

radioNo.addEventListener("click",()=>{
    selectFragil.disabled = true;
    selectFragil.value="default";
});

radioSi.addEventListener("click",()=>{
    selectFragil.disabled = false;
});