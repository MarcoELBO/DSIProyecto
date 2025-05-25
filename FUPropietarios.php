<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Propietarios</title>
    <link rel="stylesheet" href="./css/FACCESO.css"></head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_Propietario'])) {
            echo "Falta el IdPropietario.";
            exit;
        }

        $ID_Propietario = $_GET['ID_Propietario'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM propietarios WHERE ID_Propietario = '$ID_Propietario'");
        if (mysqli_num_rows($ResultSet) == 0) {
            echo "Error en la consulta: " . mysqli_error($Conexion);
            exit;
        }
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <div class="container">
        <form class="form" method="get" action="UPropietarios.php">
            <h1 class="form__title">Editar Propietarios</h1>

            <div class="form__group">
                <label for="ID_Propietario" class="form__label">IdPropietario</label>
                <input type="number" name="ID_Propietario" id="ID_Propietario" class="form__input form__input--readonly" value="<?php echo htmlspecialchars($Row['ID_Propietario'] ?? ''); ?>" readonly>
            </div>

            <div class="form__group">
                <label for="RFC" class="form__label">RFC</label>
                <input type="text" name="RFC" id="RFC" class="form__input" value="<?php echo htmlspecialchars($Row['RFC'] ?? ''); ?>">
            </div>

            <div class="form__group">
                <label for="Nombre" class="form__label">Nombre</label>
                <input type="text" name="Nombre" id="Nombre" class="form__input" value="<?php echo htmlspecialchars($Row['Nombre'] ?? ''); ?>">
            </div>

            <div class="form__group">
                <label for="Fecha_nacimiento" class="form__label">Fecha de nacimiento</label>
                <input type="date" name="Fecha_nacimiento" id="Fecha_nacimiento" class="form__input" value="<?php echo htmlspecialchars($Row['Fecha_nacimiento'] ?? ''); ?>">
            </div>

            <button type="submit" class="form__button">Editar</button>
        </form>
    </div>
</body>
</html>