let inputCodigo = document.getElementById("codigo-rastreo");

inputCodigo.addEventListener("keyup", (e)=>{
    let contenido = inputCodigo.value;
    if(e.key != "Backspace"){
        if(contenido.length == 4){
            inputCodigo.value = contenido + "-";
        } else if(contenido.length == 9){
            inputCodigo.value = contenido + "-";
        }
    }
});