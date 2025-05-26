<?php
    include_once("proteccion.php");
    validar_token('U', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Consultas</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
    <link rel="stylesheet" href="./css/a.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Conductores <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSConductores.php" class="dropdown__link">CONSULTAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Domicilios <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSDomicilios.php" class="dropdown__link">CONSULTAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Licencias <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSLicencias.php" class="dropdown__link">CONSULTAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Oficiales <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSOficiales.php" class="dropdown__link">CONSULTAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Pagos <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSPagos.php" class="dropdown__link">CONSULTAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Propietarios <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSPropietarios.php" class="dropdown__link">CONSULTAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Tarjetas de Circulación <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSTarjetas_Circulacion.php" class="dropdown__link">CONSULTAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Tarjetas de Verificación <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSTarjetas_Verificacion.php" class="dropdown__link">CONSULTAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Vehículos <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSVehiculos.php" class="dropdown__link">CONSULTAR</a></li>
                    </ul>
                </li>
                <li class="nav-list__item dropdown">
                    <a href="#" class="nav-list__link dropdown__trigger">Multas <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown__menu">
                        <li class="dropdown__item"><a href="FSMultas.php" class="dropdown__link">CONSULTAR</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
   <main class="page-content">
    <h1 class="page-content__title">Bienvenido al Sistema de Gestión</h1>
    <p class="page-content__text">Selecciona una opción del menú superior para empezar.</p>
    
    <section class="generation-section">
        <div class="generation-section__block">
            <h2 class="generation-section__heading">Generar documento</h2>
            <ul class="generation-section__list">
                <li class="generation-section__list-item"><a href="solicitarPDFLicencia.php" class="generation-section__link">Licencia</a></li>
                <li class="generation-section__list-item"><a href="solicitarPDFMulta.php" class="generation-section__link">Multas</a></li>
                <li class="generation-section__list-item"><a href="solicitarPDFRecaudanet.php" class="generation-section__link">Recaudanet</a></li>
                <li class="generation-section__list-item"><a href="solicitarPDFTarjetaVerificacion.php" class="generation-section__link">Tarjeta de Verificación</a></li>
                <li class="generation-section__list-item"><a href="solicitarPDFTCirculacion.php" class="generation-section__link">Tarjeta de Circulación</a></li>
            </ul>
        </div>
        
        <div class="generation-section__block">
            <h2 class="generation-section__heading">Generar XML</h2>
            <ul class="generation-section__list">
                <li class="generation-section__list-item"><a href="solicitarXMLLicencia.php" class="generation-section__link">Licencia</a></li>
                <li class="generation-section__list-item"><a href="solicitarXMLMulta.php" class="generation-section__link">Multas</a></li>
                <li class="generation-section__list-item"><a href="solicitarXMLRecaudanet.php" class="generation-section__link">Recaudanet</a></li>
                <li class="generation-section__list-item"><a href="solicitarXMLTarjetaVerificacion.php" class="generation-section__link">Tarjeta de Verificación</a></li>
                <li class="generation-section__list-item"><a href="solicitarXMLTCirculacion.php" class="generation-section__link">Tarjeta de Circulación</a></li>
            </ul>
        </div>
    </section>
</main>
    </body>
</html>