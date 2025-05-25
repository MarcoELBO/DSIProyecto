<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Tarjetas de Circulación</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Registro de Tarjetas de Circulación</h1>
            <form method="post" action="ITarjetasCirculacion.php" class="form">
                <div class="form__group">
                    <label for="Vehiculo" class="form__label">Vehículo (Placa):</label>
                    <input type="text" name="Vehiculo" id="Vehiculo" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Propietario" class="form__label">Propietario (ID):</label>
                    <input type="number" name="Propietario" id="Propietario" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Tipo_Servicio" class="form__label">Tipo de Servicio:</label>
                    <input type="text" name="Tipo_Servicio" id="Tipo_Servicio" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Domicilio" class="form__label">Domicilio (ID):</label>
                    <input type="number" name="Domicilio" id="Domicilio" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="vigencia" class="form__label">Vigencia:</label>
                    <input type="date" name="vigencia" id="vigencia" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="fecha_expedicion" class="form__label">Fecha de Expedición:</label>
                    <input type="date" name="fecha_expedicion" id="fecha_expedicion" required class="form__input">
                </div>
                <div class="form__group form__group--actions">
                    <input type="submit" value="Registrar Tarjeta" class="form__button">
                </div>
                
            </form>
        </section>
    </main>
    <script src="./js/manejadorExcepciones.js"></script>
</body>
</html>