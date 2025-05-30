<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Conductores</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Buscar Conductores</h1>
            <form action="SConductores.php" method="get" class="form">
                <div class="form__group">
                    <label for="criterio" class="form__label">Criterio de Búsqueda:</label>
                    <input type="text" name="criterio" id="criterio" class="form__input" placeholder="Ej. CURP123, Juan, etc.">
                </div>

                <div class="form__group form__group--radio">
                    <label class="form__label form__label--inline">Buscar por Atributo:</label>
                    <div class="form__radio-group">
                        <input type="radio" name="atributo" value="CURP" id="attr-curp" class="form__radio-input">
                        <label for="attr-curp" class="form__radio-label">CURP</label>

                        <input type="radio" name="atributo" value="NOMBRE" id="attr-nombre" class="form__radio-input">
                        <label for="attr-nombre" class="form__radio-label">Nombre</label>

                        <input type="radio" name="atributo" value="DOMICILIO" id="attr-domicilio" class="form__radio-input">
                        <label for="attr-domicilio" class="form__radio-label">Domicilio</label>

                        <input type="radio" name="atributo" value="FOLIO_TC" id="attr-folio-tc" class="form__radio-input">
                        <label for="attr-folio-tc" class="form__radio-label">Folio TC</label>

                        <input type="radio" name="atributo" value="NO_LICENCIA" id="attr-no-licencia" class="form__radio-input">
                        <label for="attr-no-licencia" class="form__radio-label">No. Licencia</label>
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