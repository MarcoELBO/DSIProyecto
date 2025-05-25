<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Oficiales</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Buscar Oficiales</h1>
            <form action="SOficiales.php" method="get" class="form">
                <div class="form__group">
                    <label for="criterio" class="form__label">Criterio de Búsqueda:</label>
                    <input type="text" name="criterio" id="criterio" class="form__input" placeholder="Ej. 123, Juan Pérez, etc.">
                </div>

                <div class="form__group form__group--radio">
                    <label class="form__label form__label--inline">Buscar por Atributo:</label>
                    <div class="form__radio-group">
                        <input type="radio" name="atributo" value="Id_Oficial" id="attr-id-oficial" class="form__radio-input">
                        <label for="attr-id-oficial" class="form__radio-label">ID Oficial</label>

                        <input type="radio" name="atributo" value="Nombre" id="attr-nombre" class="form__radio-input">
                        <label for="attr-nombre" class="form__radio-label">Nombre</label>

                        <input type="radio" name="atributo" value="Apellido" id="attr-apellido" class="form__radio-input">
                        <label for="attr-apellido" class="form__radio-label">Apellido</label>
                        
                        <input type="radio" name="atributo" value="Cargo" id="attr-cargo" class="form__radio-input">
                        <label for="attr-cargo" class="form__radio-label">Cargo</label>
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