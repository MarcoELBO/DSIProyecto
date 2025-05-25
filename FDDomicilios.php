<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Domicilio</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Eliminar Domicilio</h1>
            <form action="DDomicilios.php" method="get" class="form">
                <div class="form__group">
                    <label for="NO_DOMICILIO" class="form__label">ID Domicilio:</label>
                    <input type="text" id="NO_DOMICILIO" name="ID_DOMICILIO" required class="form__input">
                </div>
                <div class="form__group form__group--actions">
                    <input type="submit" value="Eliminar" class="form__button form__button--danger">
                </div>
            </form>
        </section>
    </main>
</body>
</html>