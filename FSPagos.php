<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Pagos</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Buscar Pagos</h1>
            <form action="SPagos.php" method="get" class="form">
                <div class="form__group">
                    <label for="criterio" class="form__label">Criterio de Búsqueda:</label>
                    <input type="text" name="criterio" id="criterio" class="form__input" placeholder="Ej. 12345, Verificación, 2023-10-26, etc.">
                </div>

                <div class="form__group form__group--radio">
                    <label class="form__label form__label--inline">Buscar por Atributo:</label>
                    <div class="form__radio-group">
                        <input type="radio" name="atributo" value="ID_Pago" id="attr-id-pago" class="form__radio-input">
                        <label for="attr-id-pago" class="form__radio-label">ID Pago</label>

                        <input type="radio" name="atributo" value="Servicio" id="attr-servicio" class="form__radio-input">
                        <label for="attr-servicio" class="form__radio-label">Servicio</label>

                        <input type="radio" name="atributo" value="Monto" id="attr-monto" class="form__radio-input">
                        <label for="attr-monto" class="form__radio-label">Monto</label>

                        <input type="radio" name="atributo" value="Fecha" id="attr-fecha" class="form__radio-input">
                        <label for="attr-fecha" class="form__radio-label">Fecha</label>

                        <input type="radio" name="atributo" value="Hora" id="attr-hora" class="form__radio-input">
                        <label for="attr-hora" class="form__radio-label">Hora</label>

                        <input type="radio" name="atributo" value="Tarjeta_Asociada" id="attr-tarjeta-asociada" class="form__radio-input">
                        <label for="attr-tarjeta-asociada" class="form__radio-label">Tarjeta Asociada</label>
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