document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('age-verification-form');
    const submitBtn = document.getElementById('submit-age');
    
    const dayInput = document.getElementById('day');
    const monthInput = document.getElementById('month');
    const yearInput = document.getElementById('year');

    // Función para validar que solo haya números y que cumplan las reglas de formato
    function validateNumericInput(input, maxLength) {
        input.value = input.value.replace(/\D/g, ''); // Elimina todo lo que no sea dígito
        if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength); // Limita la longitud del valor
        }
    }

    // Validar el campo de día
    dayInput.addEventListener('input', function() {
        validateNumericInput(dayInput, 2);
        validateAge(); // Validar la edad después de cada cambio
    });

    // Validar el campo de mes
    monthInput.addEventListener('input', function() {
        validateNumericInput(monthInput, 2);
        validateAge(); // Validar la edad después de cada cambio
    });

    // Validar el campo de año
    yearInput.addEventListener('input', function() {
        validateNumericInput(yearInput, 4);
        validateAge(); // Validar la edad después de cada cambio
    });

    function validateAge() {
        const day = parseInt(dayInput.value);
        const month = parseInt(monthInput.value);
        const year = parseInt(yearInput.value);
        
        // Verificar si los valores ingresados son válidos
        if (isNaN(day) || isNaN(month) || isNaN(year) || year.toString().length < 4) {
            submitBtn.disabled = true;
            return;
        }

        // Crear fecha de nacimiento y fecha actual
        const today = new Date();
        const birthDate = new Date(year, month - 1, day); // Los meses van de 0 a 11

        // Verificar que la fecha ingresada sea válida
        if (birthDate > today) {
            submitBtn.disabled = true;
            return;
        }

        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();

        // Ajuste si el mes y día de nacimiento aún no han pasado este año
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        // Habilitar el botón si la edad es mayor o igual a 21
        submitBtn.disabled = age < 21;
    }

    // Evento de envío del formulario
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const day = parseInt(dayInput.value);
        const month = parseInt(monthInput.value);
        const year = parseInt(yearInput.value);

        if (isNaN(day) || isNaN(month) || isNaN(year)) {
            alert('Por favor, ingrese una fecha válida.');
            return;
        }

        const today = new Date();
        const birthDate = new Date(year, month - 1, day);

        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        if (age >= 21) {
            // Guardar en localStorage para que no pregunte otra vez
            localStorage.setItem('ageVerified', 'true');
            document.getElementById('age-verification').style.display = 'none';
        } else {
            alert('Debes tener al menos 21 años para entrar.');
            window.location.href = "/"; // Redirigir a otra página
        }
    });

    // Verificar si ya ha sido verificada la edad
    if (localStorage.getItem('ageVerified') === 'true') {
        document.getElementById('age-verification').style.display = 'none';
    }
});
