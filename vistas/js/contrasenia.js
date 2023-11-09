const input = document.querySelector("#txt-contrasenia");
const btn = document.querySelector("#icono-ojo");

btn.addEventListener("click", ()=>{
    if(btn.getAttribute("src") === "img/iconos/ojo-cerrado.png"){
        btn.src = "img/iconos/ojo-abierto.png";
        input.type = "text";
    }else{
        btn.src = "img/iconos/ojo-cerrado.png";
        input.type = "password";
    }
});