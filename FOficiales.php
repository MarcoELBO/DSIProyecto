<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Oficiales</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Registro de Oficiales</h1>
            <form method="POST" action="IOficiales.php" class="form">
                <div class="form__group">
                    <label for="Nombre" class="form__label">Nombre:</label>
                    <input type="text" name="Nombre" id="Nombre" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Cargo" class="form__label">Cargo:</label>
                    <input type="text" name="Cargo" id="Cargo" required class="form__input">
                </div>
                <div class="form__group form__group--actions">
                    <input type="submit" value="Registrar Oficial" class="form__button">
                </div>
            </form>
        </section>
    </main>
    <script src="./js/manejadorExcepciones.js"></script>
</body>
</html>