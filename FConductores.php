<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conductores</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Conductores</h1>
            <form method="post" action="IConductores.php" class="form">
                <div class="form__group">
                    <label for="CURP" class="form__label">CURP:</label>
                    <input type="text" name="CURP" id="CURP" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Nombre" class="form__label">Nombre:</label>
                    <input type="text" name="Nombre" id="Nombre" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Domicilio" class="form__label">ID Domicilio:</label>
                    <input type="number" name="Domicilio" id="Domicilio" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="FechaNacimiento" class="form__label">Fecha de Nacimiento:</label>
                    <input type="date" name="FechaNacimiento" id="FechaNacimiento" class="form__input">
                </div>
                <div class="form__group">
                    <label for="TipoSangre" class="form__label">Tipo de Sangre:</label>
                    <input type="text" name="TipoSangre" id="TipoSangre" maxlength="5" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="DonadorOrg" class="form__label">Donador de Órganos:</label>
                    <select name="DonadorOrg" id="DonadorOrg" required class="form__input">
                        <option value="">Seleccione</option>
                        <option value="SI">Sí</option>
                        <option value="NO">No</option>
                    </select>
                </div>
                <div class="form__group">
                    <label for="NumeroEmergencia" class="form__label">Número de Emergencia:</label>
                    <input type="text" name="NumeroEmergencia" id="NumeroEmergencia" maxlength="17" required class="form__input">
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