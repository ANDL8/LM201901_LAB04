<?php
$directorioSuperior = '..';  // Directorio superior
$nuevaCarpeta = 'prueba';  // Nombre de la nueva carpeta

// Ruta completa del nuevo directorio
$nuevoDirectorio = $directorioSuperior . '/' . $nuevaCarpeta;

// Cambiar al directorio superior
chdir($directorioSuperior);

// Obtener la lista de archivos y carpetas en el directorio superior
$listaArchivos = scandir($directorioSuperior);

// Crear el nuevo directorio si no existe
if (!is_dir($nuevoDirectorio)) {
    mkdir($nuevoDirectorio);
}

// Copiar cada archivo o directorio al nuevo directorio
foreach ($listaArchivos as $archivo) {
    // Ignorar los directorios . y ..
    if ($archivo != '.' && $archivo != '..') {
        $rutaOrigen = $directorioSuperior . '/' . $archivo;
        $rutaDestino = $nuevoDirectorio . '/' . $archivo;

        // Copiar archivo o directorio
        if (is_dir($rutaOrigen)) {
            // Copiar directorio recursivamente
            copyDirectorio($rutaOrigen, $rutaDestino);
        } else {
            // Copiar archivo
            copy($rutaOrigen, $rutaDestino);
        }
    }
}

echo "¡Copia exitosa!";
?>

<?php
// Función para copiar directorios recursivamente
function copyDirectorio($origen, $destino) {
    if (!is_dir($destino)) {
        mkdir($destino);
    }

    $archivos = scandir($origen);

    foreach ($archivos as $archivo) {
        if ($archivo != '.' && $archivo != '..') {
            $rutaOrigen = $origen . '/' . $archivo;
            $rutaDestino = $destino . '/' . $archivo;

            if (is_dir($rutaOrigen)) {
                copyDirectorio($rutaOrigen, $rutaDestino);
            } else {
                copy($rutaOrigen, $rutaDestino);
            }
        }
    }
}
?>
