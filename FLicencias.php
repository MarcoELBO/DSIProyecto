<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Licencias</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Registro de Licencias</h1>
            <form method="POST" action="ILicencias.php" class="form">

                <div class="form__group">
                    <label for="conductor" class="form__label">Conductor (CURP):</label>
                    <input type="text" id="conductor" name="conductor" required class="form__input">
                </div>

                <div class="form__group">
                    <label for="fecha_expedicion" class="form__label">Fecha de Expedición:</label>
                    <input type="date" id="fecha_expedicion" name="fecha_expedicion" required class="form__input">
                </div>

                <div class="form__group">
                    <label for="fecha_validacion" class="form__label">Fecha de Validación:</label>
                    <input type="date" id="fecha_validacion" name="fecha_validacion" required class="form__input">
                </div>

                <div class="form__group">
                    <label for="antiguedad" class="form__label">Antigüedad (años):</label>
                    <input type="number" id="antiguedad" name="antiguedad" required class="form__input">
                </div>

                <div class="form__group">
                    <label for="observaciones" class="form__label">Observaciones:</label>
                    <textarea id="observaciones" name="observaciones" class="form__input form__input--textarea" rows="4"></textarea>
                </div>

                <div class="form__group">
                    <label for="firma" class="form__label">Firma:</label>
                    <input type="file" id="firma" name="firma" required class="form__input form__input--file">
                </div>

                <div class="form__group">
                    <label for="domicilio" class="form__label">Domicilio (ID):</label>
                    <input type="number" id="domicilio" name="domicilio" required class="form__input">
                </div>

                <div class="form__group">
                    <label for="fundamento_legal" class="form__label">Fundamento Legal:</label>
                    <textarea id="fundamento_legal" name="fundamento_legal" required class="form__input form__input--textarea" rows="4"></textarea>
                </div>

                <div class="form__group">
                    <label for="foto" class="form__label">Foto:</label>
                    <input type="file" id="foto" name="foto" class="form__input form__input--file">
                </div>

                <div class="form__group form__group--actions">
                    <input type="submit" value="Registrar Licencia" class="form__button">
                </div>
            </form>
        </section>
    </main>
    <script src="./js/manejadorExcepciones.js"></script>
</body>
</html>