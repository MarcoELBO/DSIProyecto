document.addEventListener('DOMContentLoaded', () => {
    // Selecciona todos los formularios que quieras manejar con esta lógica
    // Asegúrate de que tus formularios tengan la clase 'js-form-submit'
    const forms = document.querySelectorAll('.form');

    forms.forEach(form => {
        form.addEventListener('submit', handleFormSubmission);
    });

    /**
     * Manejador genérico para el envío de formularios.
     * Envía los datos mediante Fetch API y muestra alerts basados en la respuesta HTTP.
     * @param {Event} event El evento de envío del formulario.
     */
    async function handleFormSubmission(event) {
        event.preventDefault(); // ¡CRÍTICO! Previene la recarga de la página

        const form = event.target;
        const formData = new FormData(form);
        const actionUrl = form.getAttribute('action'); // Obtiene la URL de action="" del formulario
        const method = form.getAttribute('method') || 'POST'; // Por defecto POST, pero lee el atributo

        try {
            const response = await fetch(actionUrl, {
                method: method.toUpperCase(), // Asegura que sea 'POST' o 'GET'
                body: method.toUpperCase() === 'POST' ? formData : null, // formData para POST, null para GET
                // Para GET, formData se convertiría en queryString, pero para inserts/updates, POST es común
                // En GET, enviarías: `Workspace(`${actionUrl}?${new URLSearchParams(formData).toString()}`)`
                headers: {
                    'Accept': 'application/json' // Esperamos una respuesta JSON
                }
            });

            // Intentamos parsear la respuesta como JSON.
            // Si la respuesta no es un JSON válido, `response.json()` lanzará un error,
            // que será capturado por el `catch`.
            const responseData = await response.json();

            // Evaluar el código de estado HTTP
            if (response.status === 200) {
                // Si el PHP devuelve 200, esperamos que 'status' dentro del JSON sea 'success'
                if (responseData.status === 'success') {
                    alert('¡Operación realizada con éxito!');
                    form.reset(); // Opcional: Reiniciar el formulario después de un éxito
                } else {
                    // Esto maneja un 200 OK pero con un status de 'error' en el JSON (ej. validación de negocio)
                    alert('Error: ' + (responseData.message || 'Error desconocido en la operación.'));
                }
            } else if (response.status === 400) {
                alert('Error al ingresar datos: ' + (responseData.message || 'Verifique los campos.'));
            } else if (response.status >= 500) { // Códigos 5xx son errores del servidor
                alert('Fallo en el servidor: ' + (responseData.message || 'Intente de nuevo más tarde.'));
            } else {
                // Cualquier otro código de estado no manejado explícitamente
                alert(`Respuesta inesperada del servidor (Código: ${response.status}): ${responseData.message || 'Consulte al administrador.'}`);
            }

        } catch (error) {
            // Este bloque captura errores de red, JSON inválido, o cualquier otro error en el fetch
            console.error('Error en la solicitud:', error.message);
            alert('Ocurrió un error en la comunicación con el servidor. Por favor, intente de nuevo.');

        }
    }
});