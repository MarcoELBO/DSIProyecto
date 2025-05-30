<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Tarjetas de Verificación</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Buscar Tarjetas de Verificación</h1>
            <form action="STarjetas_Verificacion.php" method="get" class="form">
                <div class="form__group">
                    <label for="criterio" class="form__label">Criterio de Búsqueda:</label>
                    <input type="text" name="criterio" id="criterio" class="form__input" placeholder="Ej. ABC123DEF, 2023-01-01, etc.">
                </div>

                <div class="form__group form__group--radio">
                    <label class="form__label form__label--inline">Buscar por Atributo:</label>
                    <div class="form__radio-group">
                        <input type="radio" name="atributo" value="FOLIO_VERIFICACION" id="attr-folio-verificacion" class="form__radio-input">
                        <label for="attr-folio-verificacion" class="form__radio-label">Folio Verificación</label>

                        <input type="radio" name="atributo" value="VEHICULO" id="attr-vehiculo" class="form__radio-input">
                        <label for="attr-vehiculo" class="form__radio-label">Vehículo</label>

                        <input type="radio" name="atributo" value="DOMICILIO" id="attr-domicilio" class="form__radio-input">
                        <label for="attr-domicilio" class="form__radio-label">Domicilio</label>

                        <input type="radio" name="atributo" value="TC" id="attr-tc" class="form__radio-input">
                        <label for="attr-tc" class="form__radio-label">Tarjeta de Circulación (TC)</label>

                        <input type="radio" name="atributo" value="CENTRO_VERIFICACION" id="attr-centro-verificacion" class="form__radio-input">
                        <label for="attr-centro-verificacion" class="form__radio-label">Centro Verificación</label>

                        <input type="radio" name="atributo" value="TECNICO_VERIFICACION" id="attr-tecnico-verificacion" class="form__radio-input">
                        <label for="attr-tecnico-verificacion" class="form__radio-label">Técnico Verificación</label>

                        <input type="radio" name="atributo" value="FECHA_EXPEDICION" id="attr-fecha-expedicion" class="form__radio-input">
                        <label for="attr-fecha-expedicion" class="form__radio-label">Fecha Expedición</label>

                        <input type="radio" name="atributo" value="HORA_ENTRADA" id="attr-hora-entrada" class="form__radio-input">
                        <label for="attr-hora-entrada" class="form__radio-label">Hora Entrada</label>

                        <input type="radio" name="atributo" value="HORA_SALIDA" id="attr-hora-salida" class="form__radio-input">
                        <label for="attr-hora-salida" class="form__radio-label">Hora Salida</label>

                        <input type="radio" name="atributo" value="MOTIVO_VERIFICACION" id="attr-motivo-verificacion" class="form__radio-input">
                        <label for="attr-motivo-verificacion" class="form__radio-label">Motivo Verificación</label>

                        <input type="radio" name="atributo" value="SEMESTRE" id="attr-semestre" class="form__radio-input">
                        <label for="attr-semestre" class="form__radio-label">Semestre</label>

                        <input type="radio" name="atributo" value="FOLIO_PREVIO" id="attr-folio-previo" class="form__radio-input">
                        <label for="attr-folio-previo" class="form__radio-label">Folio Previo</label>

                        <input type="radio" name="atributo" value="VIGENCIA" id="attr-vigencia" class="form__radio-input">
                        <label for="attr-vigencia" class="form__radio-label">Vigencia</label>
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