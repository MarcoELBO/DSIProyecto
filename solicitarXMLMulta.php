<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar XML de Multas</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <div class="page-container">
        <h1 class="page-title">Solicitar XML de Multas</h1>

        <form class="form form--pdf-request js-form-submit" action="XMLMultas.php" method="post">
            <div class="form__group">
                <label for="id" class="form__label">ID de Multas:</label>
                <input type="text" id="id" name="id" class="form__input" required>
            </div>

            <div class="form__group form__group--actions">
                <input type="submit" class="button button--primary form__button" value="Generar XML">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Selecciona todos los formularios que quieras manejar con esta lógica
            // Asegúrate de que tus formularios tengan la clase 'js-form-submit'
            const forms = document.querySelectorAll('.js-form-submit');

            forms.forEach(form => {
                form.addEventListener('submit', handleFormSubmission);
            });

            /**
             * Manejador genérico para el envío de formularios.
             * Envía los datos mediante Fetch API. Si es exitoso (PDF), abre una nueva pestaña.
             * Si hay un error (JSON), muestra SweetAlerts.
             * @param {Event} event El evento de envío del formulario.
             */
            async function handleFormSubmission(event) {
                event.preventDefault(); // ¡CRÍTICO! Previene la recarga de la página

                const form = event.target;
                const formData = new FormData(form);
                const actionUrl = form.getAttribute('action'); // Obtiene la URL de action="" del formulario
                const method = form.getAttribute('method') || 'POST'; // Por defecto POST, pero lee el atributo

                // Mostrar un indicador de carga mientras se procesa la solicitud
                Swal.fire({
                    title: 'Generando XML...',
                    text: 'Por favor, espere un momento.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                try {
                    const response = await fetch(actionUrl, {
                        method: method.toUpperCase(),
                        body: method.toUpperCase() === 'POST' ? formData : null,
                        // No es necesario especificar 'Accept' para PDF, el navegador lo manejará
                    });

                    // Cerrar el alert de "Procesando..." antes de mostrar el resultado
                    Swal.close();

                    // --- Lógica de manejo de respuesta ---
                    if (response.ok) { // response.ok es true para códigos 2xx
                        // Si es 200 OK, asumimos que es el PDF.
                        // Para abrir el PDF en una nueva pestaña con POST data,
                        // la forma más robusta es crear un formulario temporal y enviarlo.
                        let data = await response.json(); // Obtener el blob del PDF
                        const tempForm = document.createElement('form');
                        tempForm.action = data.file_path; // Asumiendo que el servidor devuelve la ruta del archivo PDF
                        console.log("Ruta del archivo PDF:", data.file_path); // Para depuración
                        console.log("Datos del formulario:", tempForm.action); // Para depuración
                        tempForm.method = 'POST'; // Asegura que el método sea POST
                        tempForm.target = '_blank'; // Abre en una nueva pestaña

                        // Añadir los datos del formulario original al formulario temporal
                        for (let [key, value] of formData.entries()) {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = key;
                            input.value = value;
                            tempForm.appendChild(input);
                        }

                        document.body.appendChild(tempForm);
                        tempForm.submit(); // Envía el formulario temporal
                        tempForm.remove(); // Elimina el formulario temporal del DOM

                        // Opcional: Mostrar un mensaje de éxito después de abrir el PDF
                        Swal.fire({
                            icon: 'success',
                            title: 'XML Generado',
                            text: 'El XML se ha abierto en una nueva pestaña.',
                            confirmButtonText: 'Aceptar'
                        });

                    } else {
                        // Si no es 2xx, es un error (4xx, 5xx). Esperamos un JSON.
                        const errorData = await response.json(); // Intentamos parsear como JSON

                        if (response.status === 400) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error de Datos',
                                text: 'Error al solicitar el XML: ' + (errorData.message || 'Verifique el ID de Multas.'),
                                confirmButtonText: 'Aceptar'
                            });
                        } else if (response.status === 404) {
                             Swal.fire({
                                icon: 'warning',
                                title: 'Multas No Encontrada',
                                text: errorData.message || 'No se encontró una Multas con el ID proporcionado.',
                                confirmButtonText: 'Aceptar'
                            });
                        } else if (response.status >= 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error del Servidor',
                                text: 'Fallo en el servidor al generar el XML: ' + (errorData.message || 'Intente de nuevo más tarde.'),
                                confirmButtonText: 'Aceptar'
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Respuesta Inesperada',
                                text: `Respuesta inesperada del servidor (Código: ${response.status}): ${errorData.message || 'Consulte al administrador.'}`,
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    }

                } catch (error) {
                    Swal.close(); // Asegurarse de cerrar el de procesamiento
                    console.error('Error en la solicitud Fetch o al procesar la respuesta:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Conexión',
                        text: 'Identificador invalido o error de conexión. Por favor, intente nuevamente.',
                        confirmButtonText: 'Aceptar'
                    });
                }
            }
        });
    </script>
</body>
</html>