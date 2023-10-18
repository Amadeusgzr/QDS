const inputs = Array.from(document.querySelectorAll(".txt-intermedio"));
const form = document.querySelector("#form-alta-tray");
const btnAgregar = document.querySelector("#btn-alta-tray");

// "<input type='text' placeholder='Punto intermedio' class='txt-crud txt-intermedio' name='intermedio[]'>"

inputs.forEach((input, i) => {
    console.log(input + i);
    input.addEventListener("input", ()=>{
        if(input === inputs[inputs.length - 1]){
            const nuevoInput = document.createElement("input");
            nuevoInput.type = "text";
            nuevoInput.placeholder = "Punto intermedio";
            nuevoInput.classList.add("txt-crud", "txt-intermedio");
            nuevoInput.name = "intermedio[]";
            form.insertBefore(nuevoInput, btnAgregar);
            inputs.push(nuevoInput);
        }
    })
});
