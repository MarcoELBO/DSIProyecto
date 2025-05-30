<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Licencias</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Buscar Licencias</h1>
            <form action="SLicencias.php" method="get" class="form">
                <div class="form__group">
                    <label for="criterio" class="form__label">Criterio de Búsqueda:</label>
                    <input type="text" name="criterio" id="criterio" class="form__input" placeholder="Ej. 12345, Juan Pérez, 2023-01-01, etc.">
                </div>

                <div class="form__group form__group--radio">
                    <label class="form__label form__label--inline">Buscar por Atributo:</label>
                    <div class="form__radio-group">
                        <input type="radio" name="atributo" value="ID_LICENCIA" id="attr-id-licencia" class="form__radio-input">
                        <label for="attr-id-licencia" class="form__radio-label">ID Licencia</label>

                        <input type="radio" name="atributo" value="CONDUCTOR" id="attr-conductor" class="form__radio-input">
                        <label for="attr-conductor" class="form__radio-label">Conductor</label>

                        <input type="radio" name="atributo" value="FECHA_EXPEDICION" id="attr-fecha-expedicion" class="form__radio-input">
                        <label for="attr-fecha-expedicion" class="form__radio-label">Fecha Expedición</label>

                        <input type="radio" name="atributo" value="FECHA_VALIDACION" id="attr-fecha-validacion" class="form__radio-input">
                        <label for="attr-fecha-validacion" class="form__radio-label">Fecha Validación</label>

                        <input type="radio" name="atributo" value="ANTIGUEDAD" id="attr-antiguedad" class="form__radio-input">
                        <label for="attr-antiguedad" class="form__radio-label">Antigüedad</label>

                        <input type="radio" name="atributo" value="OBSERVACIONES" id="attr-observaciones" class="form__radio-input">
                        <label for="attr-observaciones" class="form__radio-label">Observaciones</label>

                        <input type="radio" name="atributo" value="FIRMA" id="attr-firma" class="form__radio-input">
                        <label for="attr-firma" class="form__radio-label">Firma</label>

                        <input type="radio" name="atributo" value="DOMICILIO" id="attr-domicilio" class="form__radio-input">
                        <label for="attr-domicilio" class="form__radio-label">Domicilio</label>

                        <input type="radio" name="atributo" value="FUNDAMENTO_LEGAL" id="attr-fundamento-legal" class="form__radio-input">
                        <label for="attr-fundamento-legal" class="form__radio-label">Fundamento Legal</label>

                        <input type="radio" name="atributo" value="FOTO" id="attr-foto" class="form__radio-input">
                        <label for="attr-foto" class="form__radio-label">Foto</label>
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