<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Tarjetas de Circulación</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Buscar Tarjetas de Circulación</h1>
            <form action="STarjetas_Circulacion.php" method="get" class="form">
                <div class="form__group">
                    <label for="criterio" class="form__label">Criterio de Búsqueda:</label>
                    <input type="text" name="criterio" id="criterio" class="form__input" placeholder="Ej. ABC1234, Juan Pérez, etc.">
                </div>

                <div class="form__group form__group--radio">
                    <label class="form__label form__label--inline">Buscar por Atributo:</label>
                    <div class="form__radio-group">
                        <input type="radio" name="atributo" value="ID_TC" id="attr-id-tc" class="form__radio-input">
                        <label for="attr-id-tc" class="form__radio-label">ID Tarjeta</label>

                        <input type="radio" name="atributo" value="Vehiculo" id="attr-vehiculo" class="form__radio-input">
                        <label for="attr-vehiculo" class="form__radio-label">Vehículo</label>

                        <input type="radio" name="atributo" value="Propietario" id="attr-propietario" class="form__radio-input">
                        <label for="attr-propietario" class="form__radio-label">Propietario</label>

                        <input type="radio" name="atributo" value="Tipo_Servicio" id="attr-tipo-servicio" class="form__radio-input">
                        <label for="attr-tipo-servicio" class="form__radio-label">Tipo de Servicio</label>

                        <input type="radio" name="atributo" value="Domicilio" id="attr-domicilio" class="form__radio-input">
                        <label for="attr-domicilio" class="form__radio-label">Domicilio</label>
                    </div>
                </div>

                <div class="form__group form__group--actions">
                    <input type="submit" value="Buscar" class="form__button form__button--primary">
                </div>
            </form>
        </section>
    </main>
</body>
</html>