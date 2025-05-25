<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Multas</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Registro de Multas</h1>
            <form method="POST" action="IMultas.php" class="form">
                <div class="form__group">
                    <label for="Folio" class="form__label">Folio:</label>
                    <input type="text" name="Folio" id="Folio" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Fecha" class="form__label">Fecha:</label>
                    <input type="date" name="Fecha" id="Fecha" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Hora" class="form__label">Hora:</label>
                    <input type="time" name="Hora" id="Hora" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Motivo" class="form__label">Motivo:</label>
                    <input type="text" name="Motivo" id="Motivo" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Licencia" class="form__label">Licencia (ID):</label>
                    <input type="number" name="Licencia" id="Licencia" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="T_Verificacion" class="form__label">Tarjeta de Verificación (ID):</label>
                    <input type="number" name="T_Verificacion" id="T_Verificacion" class="form__input">
                </div>
                <div class="form__group">
                    <label for="T_Circulacion" class="form__label">Tarjeta de Circulación (ID):</label>
                    <input type="number" name="T_Circulacion" id="T_Circulacion" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Policia" class="form__label">Policía (ID Oficial):</label>
                    <input type="number" name="Policia" id="Policia" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Observaciones" class="form__label">Observaciones</label>
                    <input type="text" name="Observaciones" id="Observaciones" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Lugar" class="form__label">Lugar</label>
                    <input type="text" name="Lugar" id="Lugar" required class="form__input">
                </div>
                <div class="form__group form__group--actions">
                    <input type="submit" value="Registrar Multa" class="form__button">
                </div>
            </form>
        </section>
    </main>
    <script src="./js/manejadorExcepciones.js"></script>
</body>
</html>