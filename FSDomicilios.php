<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Domicilios</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Buscar Domicilios</h1>
            <form action="SDomicilios.php" method="get" class="form">
                <div class="form__group">
                    <label for="criterio" class="form__label">Criterio de Búsqueda:</label>
                    <input type="text" name="criterio" id="criterio" class="form__input" placeholder="Ej. Juárez, 76000, etc.">
                </div>

                <div class="form__group form__group--radio">
                    <label class="form__label form__label--inline">Buscar por Atributo:</label>
                    <div class="form__radio-group">
                        <input type="radio" name="atributo" value="ID_DOMICILIO" id="attr-id-domicilio" class="form__radio-input">
                        <label for="attr-id-domicilio" class="form__radio-label">ID Domicilio</label>

                        <input type="radio" name="atributo" value="CALLE" id="attr-calle" class="form__radio-input">
                        <label for="attr-calle" class="form__radio-label">Calle</label>

                        <input type="radio" name="atributo" value="CP" id="attr-cp" class="form__radio-input">
                        <label for="attr-cp" class="form__radio-label">Código Postal</label>

                        <input type="radio" name="atributo" value="COLONIA" id="attr-colonia" class="form__radio-input">
                        <label for="attr-colonia" class="form__radio-label">Colonia</label>

                        <input type="radio" name="atributo" value="NUM_EXT" id="attr-num-ext" class="form__radio-input">
                        <label for="attr-num-ext" class="form__radio-label">Número Externo</label>
                        
                        <input type="radio" name="atributo" value="NUM_INT" id="attr-num-int" class="form__radio-input">
                        <label for="attr-num-int" class="form__radio-label">Número Interno</label>

                        <input type="radio" name="atributo" value="ESTADO" id="attr-estado" class="form__radio-input">
                        <label for="attr-estado" class="form__radio-label">Estado</label>

                        <input type="radio" name="atributo" value="MUNICIPIO" id="attr-municipio" class="form__radio-input">
                        <label for="attr-municipio" class="form__radio-label">Municipio</label>

                        <input type="radio" name="atributo" value="REFERENCIA" id="attr-referencia" class="form__radio-input">
                        <label for="attr-referencia" class="form__radio-label">Referencias</label>
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