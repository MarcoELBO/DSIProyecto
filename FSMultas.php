<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Multas</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Buscar Multas</h1>
            <form action="SMultas.php" method="get" class="form">
                <div class="form__group">
                    <label for="criterio" class="form__label">Criterio de Búsqueda:</label>
                    <input type="text" name="criterio" id="criterio" class="form__input" placeholder="Ej. 12345, 2023-10-26, etc.">
                </div>

                <div class="form__group form__group--radio">
                    <label class="form__label form__label--inline">Buscar por Atributo:</label>
                    <div class="form__radio-group">
                        <input type="radio" name="atributo" value="Folio" id="attr-folio" class="form__radio-input">
                        <label for="attr-folio" class="form__radio-label">Folio</label>

                        <input type="radio" name="atributo" value="Fecha" id="attr-fecha" class="form__radio-input">
                        <label for="attr-fecha" class="form__radio-label">Fecha</label>

                        <input type="radio" name="atributo" value="Hora" id="attr-hora" class="form__radio-input">
                        <label for="attr-hora" class="form__radio-label">Hora</label>

                        <input type="radio" name="atributo" value="Motivo" id="attr-motivo" class="form__radio-input">
                        <label for="attr-motivo" class="form__radio-label">Motivo</label>

                        <input type="radio" name="atributo" value="Licencia" id="attr-licencia" class="form__radio-input">
                        <label for="attr-licencia" class="form__radio-label">Licencia</label>

                        <input type="radio" name="atributo" value="T_Verificacion" id="attr-t-verificacion" class="form__radio-input">
                        <label for="attr-t-verificacion" class="form__radio-label">Tarjeta de Verificación</label>

                        <input type="radio" name="atributo" value="T_Circulacion" id="attr-t-circulacion" class="form__radio-input">
                        <label for="attr-t-circulacion" class="form__radio-label">Tarjeta de Circulación</label>

                        <input type="radio" name="atributo" value="Policia" id="attr-policia" class="form__radio-input">
                        <label for="attr-policia" class="form__radio-label">Policía</label>
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