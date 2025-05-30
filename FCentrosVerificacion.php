<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centros de Verificación</title>
    <link rel="stylesheet" href="css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Centros de Verificación</h1>
            <form method="post" action="ICentrosVerificacion.php" class="form">
                <div class="form__group">
                    <label for="NO_LINEA" class="form__label">No. Línea:</label>
                    <input type="number" name="NO_LINEA" id="NO_LINEA" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="VERIFICACION" class="form__label">Verificación:</label>
                    <input type="text" name="VERIFICACION" id="VERIFICACION" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="NOMBRE" class="form__label">Nombre:</label>
                    <input type="text" name="NOMBRE" id="NOMBRE" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="DOMICILIO" class="form__label">ID Domicilio:</label>
                    <input type="number" name="DOMICILIO" id="DOMICILIO" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="TIPO_CENTRO" class="form__label">Tipo de Centro:</label>
                    <input type="text" name="TIPO_CENTRO" id="TIPO_CENTRO" required class="form__input">
                </div>
                <div class="form__group form__group--actions">
                    <input type="submit" value="Guardar" class="form__button">
                </div>
            </form>
        </section>
    </main>
    <script src="./js/manejadorExcepciones.js"></script>
</body>
</html>