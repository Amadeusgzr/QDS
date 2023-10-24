const inputRastreo = document.querySelector('#codigo-rastreo');

    inputRastreo.addEventListener('input', function () {
      let value = inputRastreo.value.replace(/[^a-zA-Z0-9]/g, ''); // Eliminar caracteres que no son dígitos
      value = value.toUpperCase();
      let nuevoValue = '';

      for (let i = 0; i < value.length; i++) {
        if (i > 0 && i % 4 === 0) {
            nuevoValue += '-';
        }
        nuevoValue += value[i];
      }

      inputRastreo.value = nuevoValue;
    });