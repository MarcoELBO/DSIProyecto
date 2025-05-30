<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Vehículos</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Buscar Vehículos</h1>
            <form action="SVehiculos.php" method="get" class="form">
                <div class="form__group">
                    <label for="criterio" class="form__label">Criterio de Búsqueda:</label>
                    <input type="text" name="criterio" id="criterio" class="form__input" placeholder="Ej. ABC-123, Nissan, Rojo, etc.">
                </div>

                <div class="form__group form__group--radio">
                    <label class="form__label form__label--inline">Buscar por Atributo:</label>
                    <div class="form__radio-group">
                        <input type="radio" name="atributo" value="Placa" id="attr-placa" class="form__radio-input">
                        <label for="attr-placa" class="form__radio-label">Placa</label>

                        <input type="radio" name="atributo" value="Marca" id="attr-marca" class="form__radio-input">
                        <label for="attr-marca" class="form__radio-label">Marca</label>

                        <input type="radio" name="atributo" value="Color" id="attr-color" class="form__radio-input">
                        <label for="attr-color" class="form__radio-label">Color</label>

                        <input type="radio" name="atributo" value="Modelo" id="attr-modelo" class="form__radio-input">
                        <label for="attr-modelo" class="form__radio-label">Modelo</label>

                        <input type="radio" name="atributo" value="Puertas" id="attr-puertas" class="form__radio-input">
                        <label for="attr-puertas" class="form__radio-label">Puertas</label>

                        <input type="radio" name="atributo" value="Asientos" id="attr-asientos" class="form__radio-input">
                        <label for="attr-asientos" class="form__radio-label">Asientos</label>

                        <input type="radio" name="atributo" value="Cilindraje" id="attr-cilindraje" class="form__radio-input">
                        <label for="attr-cilindraje" class="form__radio-label">Cilindraje</label>

                        <input type="radio" name="atributo" value="Combustible" id="attr-combustible" class="form__radio-input">
                        <label for="attr-combustible" class="form__radio-label">Combustible</label>
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