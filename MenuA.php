<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/estilos.css">
</head>
<body>
    <header class="main-header">
        <nav class="main-nav">
            <input type="checkbox" id="menu-toggle" class="main-nav__checkbox">
            <label for="menu-toggle" class="main-nav__toggle">
                <i class="fas fa-bars"></i>
            </label>
            <ul class="nav-list">
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Centros Verificación <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSCentrosVerificacion.php" class="dropdown__link">CONSULTAR</a></li>
                        <li class="dropdown__item"><a href="FCentrosVerificacion.php" class="dropdown__link">INSERTAR</a></li>
                        <li class="dropdown__item"><a href="FDCentrosVerificacion.php" class="dropdown__link">ELIMINAR</a></li>
                        <li class="dropdown__item"><a href="FUCentrosVerificacion.php" class="dropdown__link">MODIFICAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Conductores <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSConductores.php" class="dropdown__link">CONSULTAR</a></li>
                        <li class="dropdown__item"><a href="FConductores.php" class="dropdown__link">INSERTAR</a></li>
                        <li class="dropdown__item"><a href="FDConductores.php" class="dropdown__link">ELIMINAR</a></li>
                        <li class="dropdown__item"><a href="FUConductores.php" class="dropdown__link">MODIFICAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Domicilios <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSDomicilios.php" class="dropdown__link">CONSULTAR</a></li>
                        <li class="dropdown__item"><a href="FDomicilios.php" class="dropdown__link">INSERTAR</a></li>
                        <li class="dropdown__item"><a href="FDDomicilios.php" class="dropdown__link">ELIMINAR</a></li>
                        <li class="dropdown__item"><a href="FUDomicilios.php" class="dropdown__link">MODIFICAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Licencias <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSLicencias.php" class="dropdown__link">CONSULTAR</a></li>
                        <li class="dropdown__item"><a href="FLicencias.php" class="dropdown__link">INSERTAR</a></li>
                        <li class="dropdown__item"><a href="FDLicencias.php" class="dropdown__link">ELIMINAR</a></li>
                        <li class="dropdown__item"><a href="FULicencias.php" class="dropdown__link">MODIFICAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Oficiales <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSOficiales.php" class="dropdown__link">CONSULTAR</a></li>
                        <li class="dropdown__item"><a href="FOficiales.php" class="dropdown__link">INSERTAR</a></li>
                        <li class="dropdown__item"><a href="FDOficiales.php" class="dropdown__link">ELIMINAR</a></li>
                        <li class="dropdown__item"><a href="FUOficiales.php" class="dropdown__link">MODIFICAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Pagos <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSPagos.php" class="dropdown__link">CONSULTAR</a></li>
                        <li class="dropdown__item"><a href="FPagos.php" class="dropdown__link">INSERTAR</a></li>
                        <li class="dropdown__item"><a href="FDPagos.php" class="dropdown__link">ELIMINAR</a></li>
                        <li class="dropdown__item"><a href="FUPagos.php" class="dropdown__link">MODIFICAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Propietarios <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSPropietarios.php" class="dropdown__link">CONSULTAR</a></li>
                        <li class="dropdown__item"><a href="FPropietarios.php" class="dropdown__link">INSERTAR</a></li>
                        <li class="dropdown__item"><a href="FDPropietarios.php" class="dropdown__link">ELIMINAR</a></li>
                        <li class="dropdown__item"><a href="FUPropietarios.php" class="dropdown__link">MODIFICAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Tarjetas de Circulación <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSTarjetas_Circulacion.php" class="dropdown__link">CONSULTAR</a></li>
                        <li class="dropdown__item"><a href="FTarjetasCirculacion.php" class="dropdown__link">INSERTAR</a></li>
                        <li class="dropdown__item"><a href="FDTarjetasCirculacion.php" class="dropdown__link">ELIMINAR</a></li>
                        <li class="dropdown__item"><a href="FUTarjetasCirculacion.php" class="dropdown__link">MODIFICAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Tarjetas de Verificación <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSTarjetas_Verificacion.php" class="dropdown__link">CONSULTAR</a></li>
                        <li class="dropdown__item"><a href="FTarjetasVerificacion.php" class="dropdown__link">INSERTAR</a></li>
                        <li class="dropdown__item"><a href="FDTarjetasVerificacion.php" class="dropdown__link">ELIMINAR</a></li>
                        <li class="dropdown__item"><a href="FUTarjetasVerificacion.php" class="dropdown__link">MODIFICAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Vehículos <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSVehiculos.php" class="dropdown__link">CONSULTAR</a></li>
                        <li class="dropdown__item"><a href="FVehiculos.php" class="dropdown__link">INSERTAR</a></li>
                        <li class="dropdown__item"><a href="FDVehiculos.php" class="dropdown__link">ELIMINAR</a></li>
                        <li class="dropdown__item"><a href="FUVehiculos.php" class="dropdown__link">MODIFICAR</a></li>
                    </ul>
                </li>
                 <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Multas <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSMultas.php" class="dropdown__link">CONSULTAR</a></li>
                        <li class="dropdown__item"><a href="FMultas.php" class="dropdown__link">INSERTAR</a></li>
                        <li class="dropdown__item"><a href="FDMultas.php" class="dropdown__link">ELIMINAR</a></li>
                        <li class="dropdown__item"><a href="FUMultas.php" class="dropdown__link">MODIFICAR</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <main class="page-content">
        <h1>Bienvenido al Sistema de Gestión</h1>
        <p>Selecciona una opción del menú superior para empezar.</p>
        <section>
            <h2>Generar documento</h2>
            <ul>
                <li><a href="solicitarPDFLicencia.php">Licencia</a></li>
                <li><a href="solicitarPDFMulta.php">Multas</a></li>
                <li><a href="solicitarPDFRecaudanet.php">Recaudanet</a></li>
                <li><a href="solicitarPDFTarjetaVerificacion.php">Tarjeta de Verificación</a></li>
                <li><a href="solicitarPDFTCirculacion.php">Tarjeta de Circulación</a></li>
            </ul>
        </section>
    </main>
    <script src="./js/menu.js"></script>

</body>
</html>