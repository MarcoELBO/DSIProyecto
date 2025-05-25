<?php
// Iniciar el buffering de salida para asegurar que los encabezados HTTP se envíen correctamente

    include_once("proteccion.php");
    validar_token('A', true);
ob_start();

// Establecer el tipo de contenido de la respuesta a JSON.
// Esto es CRÍTICO para que JavaScript interprete la respuesta correctamente.
header('Content-Type: application/json');

try {
    // Obteniendo los valores del front end
    // Usando $_REQUEST para compatibilidad con GET/POST, como en tu original
    $conductor = $_REQUEST['conductor'];
    $Fecha_expedicion = $_REQUEST['fecha_expedicion'];
    $Fecha_validacion = $_REQUEST['fecha_validacion'];
    $antiguedad = $_REQUEST['antiguedad'];
    $observaciones = $_REQUEST['observaciones'];
    $Domicilio = $_REQUEST['domicilio']; // Cuidado: La tabla licencias probablemente no tiene un Domicilio directo, sino un conductor_id
    $fundamento_legal = $_REQUEST['fundamento_legal'];
    $foto = $_FILES["foto"];
    $nombre_foto = $foto['name'];
    $size_foto = $foto['size'];
    $tipo_foto = $foto['type'];
    $temp_foto = $foto['tmp_name'];
    $firma = $_FILES['firma'];
    $nombre_firma = $firma['name'];
    $size_firma = $firma['size'];
    $temp_firma = $firma['tmp_name'];
    $tipo_firma = $firma['type'];

        $tipos_permitidos = ['image/jpeg', 'image/png'];
    if (!in_array($tipo_foto, haystack: $tipos_permitidos) && !in_array($tipo_firma, $tipos_permitidos)) {
        echo "Tipo de archivo no permitido. Se permiten: JPEG y PNG,.";
        exit;
    }

     $MAX_SIZE = 1024* 1024* 10;//10MB
    if($size_foto > $MAX_SIZE && $size_firma > $MAX_SIZE)
    {
        echo "Su archivo pesa más de 10MB";
        exit;
    }
    $directorio = 'images/';
    $subdirectorio_foto = 'fotos/';
    $subdirectorio_firmas = 'firmas/';
    if(!file_exists($directorio)) //crea el directorio images si no existe
    {
        mkdir($directorio);
    }
    if(!file_exists(($directorio . $subdirectorio_foto)))
    {
        mkdir($directorio . $subdirectorio_foto);
    }
    if(!file_exists(($directorio . $subdirectorio_firmas)))
    {
        mkdir($directorio . $subdirectorio_firmas);
    }
    
    $nombre_archivo_foto = uniqid() . "_" . basename($nombre_foto);
    $nombre_archivo_firma = uniqid() . "_" . basename($nombre_firma);
    $ubicacion_foto = $directorio . $subdirectorio_foto . $nombre_archivo_foto;
    $ubicacion_firma = $directorio . $subdirectorio_firmas . $nombre_archivo_firma;
    move_uploaded_file($temp_foto, $ubicacion_foto);
    move_uploaded_file($temp_firma,  $ubicacion_firma);
    // Crear la instrucción SQL para un INSERT implícito.
    // Los valores deben estar en el mismo orden que las columnas en la tabla 'licencias'.
    // NOTA: Esta construcción de la consulta es VULNERABLE a inyección SQL.
    // Para proyectos de producción, se recomienda encarecidamente usar sentencias preparadas.
    // Se mantiene 'NULL' para la primera columna (asumo que es un ID AUTO_INCREMENT).
    $SQL = "INSERT INTO licencias VALUES (NULL, '$conductor', '$Fecha_expedicion', '$Fecha_validacion', '$antiguedad', '$observaciones', '$ubicacion_firma', '$Domicilio', '$fundamento_legal', '$ubicacion_foto')";
    // Incluir el controlador de la base de datos y establecer la conexión
    include("Controlador.php");
    $Conexion = Conectar();

    // Comprobar si la conexión fue exitosa
    if (!$Conexion) {
        throw new Exception("Error al conectar a la base de datos.");
    }

    // Ejecutar la instrucción SQL
    // Asumo que la función ejecutar() devuelve 1 para éxito y 0/false para fallo.
    $ResultSet = Ejecutar($Conexion, $SQL);

    // Desconectar la base de datos
    Desconectar($Conexion);

    // Procesa el resultado de la operación
    if ($ResultSet == 1) {
        // Operación exitosa: Envía código 200 OK
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Registro de licencia guardado correctamente.']);
    } else {
        // Operación fallida por alguna razón
        // Incluye el mensaje de error de MySQL si está disponible para depuración
        $errorMessage = "Error al guardar el registro de la licencia";
        if ($Conexion->error) {
            $errorMessage .= ": " . $Conexion->error;
        }
        http_response_code(400); // 400 Bad Request para indicar un problema con los datos o la operación
        echo json_encode(['status' => 'error', 'message' => $errorMessage]);
    }

} catch (Exception $e) {
    // Captura cualquier excepción que pueda ocurrir (ej. error en la conexión, error de PHP, etc.)
    http_response_code(500); // 500 Internal Server Error para problemas del servidor
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al guardar la licencia: ' . $e->getMessage()]);

    // Opcional: Loggear el error para depuración en el servidor
    // error_log("Error en ILicencias.php: " . $e->getMessage() . " en línea " . $e->getLine());
}

// Finaliza el buffering de salida y envía la respuesta al cliente
ob_end_flush();
exit;
?>