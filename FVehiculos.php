<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Vehículos</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
</head>
<body>
    <main class="page-wrapper">
        <section class="form-card">
            <h1 class="form-card__title">Registro de Vehículos</h1>
            <form method="post" action="IVehiculos.php" class="form">
                <div class="form__group">
                    <label for="Placa" class="form__label">Placa:</label>
                    <input type="text" name="Placa" id="Placa" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Marca" class="form__label">Marca:</label>
                    <input type="text" name="Marca" id="Marca" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Submarca" class="form__label">Submarca:</label>
                    <input type="text" name="Submarca" id="Submarca" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Linea" class="form__label">Línea:</label>
                    <input type="text" name="Linea" id="Linea" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Color" class="form__label">Color:</label>
                    <input type="text" name="Color" id="Color" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Modelo" class="form__label">Modelo:</label>
                    <input type="text" name="Modelo" id="Modelo" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Numeroserie" class="form__label">Número de Serie:</label>
                    <input type="text" name="Numeroserie" id="Numeroserie" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Puertas" class="form__label">Número de Puertas:</label>
                    <input type="number" name="Puertas" id="Puertas" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Asientos" class="form__label">Número de Asientos:</label>
                    <input type="number" name="Asientos" id="Asientos" required class="form__input">
                </div>
                <div class="form__group">
                    <label for="Cilindraje" class="form__label">Cilindraje:</label>
                    <input type="number" name="Cilindraje" id="Cilindraje" class="form__input">
                </div>
                <div class="form__group">
                    <label for="Combustible" class="form__label">Combustible (1 - Gasolina, 2 - Electrico):</label>
                    <input type="number" name="Combustible" id="Combustible" class="form__input">
                </div>
                <div class="form__group">
                    <label for="capacidad" class="form__label">Capacidad (litros):</label>
                    <input type="number" name="capacidad" id="capacidad" class="form__input">
                </div>
                                <div class="form__group">
                    <label for="transmision" class="form__label">Transmisión (1 - Manual, 2 - Automática):</label>
                    <input type="number" name="transmision" id="transmision" class="form__input">
                </div>
                                <div class="form__group">
                    <label for="origen" class="form__label">Origen:</label>
                    <input type="text" name="origen" id="origen" class="form__input">
                </div>
                <div class="form__group form__group--actions">
                    <input type="submit" value="Registrar Vehículo" class="form__button">
                </div>
            </form>
        </section>
    </main>
    <script src="./js/manejadorExcepciones.js"></script>
</body>
</html>