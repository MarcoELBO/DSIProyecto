<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Domicilios</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Registro de Domicilios</h1>
            <form method="post" action="IDomicilios.php" class="form">
                <div class="form__group">
                    <label for="CALLE" class="form__label">Calle:</label>
                    <input type="text" name="CALLE" id="CALLE" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="CP" class="form__label">Código Postal:</label>
                    <input type="number" name="CP" id="CP" required class="form__input" maxlength="5">
                </div>
                <div class="form__group">
                    <label for="COLONIA" class="form__label">Colonia:</label>
                    <input type="text" name="COLONIA" id="COLONIA" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="NUM_INT" class="form__label">Número Interno:</label>
                    <input type="text" name="NUM_INT" id="NUM_INT" class="form__input">
                </div>
                <div class="form__group">
                    <label for="NUM_EXT" class="form__label">Número Externo:</label>
                    <input type="text" name="NUM_EXT" id="NUM_EXT" class="form__input">
                </div>
                <div class="form__group">
                    <label for="ESTADO" class="form__label">Estado:</label>
                    <input type="text" name="ESTADO" id="ESTADO" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="MUNICIPIO" class="form__label">Municipio:</label>
                    <input type="text" name="MUNICIPIO" id="MUNICIPIO" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="REFERENCIAS" class="form__label">Referencias:</label>
                    <input type="text" name="REFERENCIAS" id="REFERENCIAS" class="form__input">
                </div>
                <div class="form__group form__group--actions">
                    <input type="submit" value="Guardar Domicilio" class="form__button">
                </div>
            </form>
        </section>
    </main>
</body>
</html>