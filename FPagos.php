<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pagos</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Registro de Pagos</h1>
            <form method="post" action="IPagos.php" class="form">
                <div class="form__group">
                    <label for="Servicio" class="form__label">Servicio:</label>
                    <input type="text" id="Servicio" name="Servicio" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Monto" class="form__label">Monto:</label>
                    <input type="number" id="Monto" name="Monto" step="0.01" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Fecha" class="form__label">Fecha:</label>
                    <input type="date" id="Fecha" name="Fecha" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Hora" class="form__label">Hora:</label>
                    <input type="time" id="Hora" name="Hora" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Tarjeta_Asociada" class="form__label">Tarjeta T_Circulacion (ID):</label>
                    <input type="number" id="Tarjeta_Asociada" name="Tarjeta_Asociada" required class="form__input">
                </div>
                <div class="form__group form__group--actions">
                    <input type="submit" value="Registrar Pago" class="form__button">
                </div>
            </form>
        </section>
    </main>
    <script src="./js/manejadorExcepciones.js"></script>
</body>
</html>