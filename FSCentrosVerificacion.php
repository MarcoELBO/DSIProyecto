<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Centros de Verificación</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Buscar Centros de Verificación</h1>
            <form action="SCentrosVerificacion.php" method="get" class="form">
                <div class="form__group">
                    <label for="criterio" class="form__label">Criterio de Búsqueda:</label>
                    <input type="text" name="criterio" id="criterio" class="form__input" placeholder="Ej. Centro A, 123, etc.">
                </div>

                <div class="form__group form__group--radio">
                    <label class="form__label form__label--inline">Buscar por Atributo:</label>
                    <div class="form__radio-group">
                        <input type="radio" name="atributo" value="NO_CENTRO" id="attr-no-centro" class="form__radio-input">
                        <label for="attr-no-centro" class="form__radio-label">No. Centro</label>

                        <input type="radio" name="atributo" value="NO_LINEA" id="attr-no-linea" class="form__radio-input">
                        <label for="attr-no-linea" class="form__radio-label">No. Línea</label>

                        <input type="radio" name="atributo" value="VERIFICACION" id="attr-verificacion" class="form__radio-input">
                        <label for="attr-verificacion" class="form__radio-label">Verificación</label>

                        <input type="radio" name="atributo" value="NOMBRE" id="attr-nombre" class="form__radio-input">
                        <label for="attr-nombre" class="form__radio-label">Nombre</label>

                        <input type="radio" name="atributo" value="DOMICILIO" id="attr-domicilio" class="form__radio-input">
                        <label for="attr-domicilio" class="form__radio-label">Domicilio</label>

                        <input type="radio" name="atributo" value="TIPO_CENTRO" id="attr-tipo-centro" class="form__radio-input">
                        <label for="attr-tipo-centro" class="form__radio-label">Tipo Centro</label>
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