<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Tarjetas de Verificación</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Registro de Tarjetas de Verificación</h1>
            <form method="post" action="ITarjetasVerificacion.php" class="form">
                <div class="form__group">
                    <label for="Folio_Verificacion" class="form__label">Folio de Verificación:</label>
                    <input type="number" name="Folio_Verificacion" id="Folio_Verificacion" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Vehiculo" class="form__label">Vehículo (Placa):</label>
                    <input type="text" name="Vehiculo" id="Vehiculo" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Domicilio" class="form__label">Domicilio (ID):</label>
                    <input type="number" name="Domicilio" id="Domicilio" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="TC" class="form__label">Tarjeta de Circulación (TC ID):</label>
                    <input type="number" name="TC" id="TC" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Centro_Verificacion" class="form__label">Centro de Verificación (ID):</label>
                    <input type="number" name="Centro_Verificacion" id="Centro_Verificacion" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="TECNICO_VERIFICACION" class="form__label">Técnico de Verificación (ID):</label>
                    <input type="text" name="TECNICO_VERIFICACION" id="TECNICO_VERIFICACION" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="FECHA_EXPEDICION" class="form__label">Fecha de Expedición:</label>
                    <input type="date" name="FECHA_EXPEDICION" id="FECHA_EXPEDICION" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="HORA_ENTRADA" class="form__label">Hora de Entrada:</label>
                    <input type="time" name="HORA_ENTRADA" id="HORA_ENTRADA" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="HORA_SALIDA" class="form__label">Hora de Salida:</label>
                    <input type="time" name="HORA_SALIDA" id="HORA_SALIDA" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="MOTIVO_VERIFICACION" class="form__label">Motivo de Verificación:</label>
                    <input type="text" name="MOTIVO_VERIFICACION" id="MOTIVO_VERIFICACION" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="SEMESTRE" class="form__label">Semestre:</label>
                    <input type="number" name="SEMESTRE" id="SEMESTRE" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="FOLIO_PREVIO" class="form__label">Folio Previo:</label>
                    <input type="number" name="FOLIO_PREVIO" id="FOLIO_PREVIO" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="VIGENCIA" class="form__label">Vigencia:</label>
                    <input type="date" name="VIGENCIA" id="VIGENCIA" required class="form__input">
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