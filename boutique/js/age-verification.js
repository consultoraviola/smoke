document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('age-verification-form');
    const submitBtn = document.getElementById('submit-age');
    
    const dayInput = document.getElementById('day');
    const monthInput = document.getElementById('month');
    const yearInput = document.getElementById('year');

    function validateAge() {
        const day = parseInt(dayInput.value);
        const month = parseInt(monthInput.value);
        const year = parseInt(yearInput.value);
        
        if (isNaN(day) || isNaN(month) || isNaN(year)) {
            submitBtn.disabled = true;
            return;
        }

        // Crear fecha de nacimiento y fecha actual
        const today = new Date();
        const birthDate = new Date(year, month - 1, day); // Los meses van de 0 a 11

        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();

        // Ajuste si el mes y día de nacimiento aún no han pasado este año
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        // Habilitar el botón si la edad es mayor o igual a 21
        if (age >= 21) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }

    // Ejecutar la validación al cambiar los valores de los inputs
    dayInput.addEventListener('input', validateAge);
    monthInput.addEventListener('input', validateAge);
    yearInput.addEventListener('input', validateAge);

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
