<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpeta de archivos</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('viewer/dist/viewer.css'); ?>">
    <script src="<?php echo base_url('viewer/dist/js/viewer.js'); ?>"></script>
</head>
<body>

    <h2>Carpeta de archivos</h2>

    <?php
        $idInforme = 2; // Reemplaza esto con la variable que contenga el ID de informe específico
        $carpeta = 'carpeta_archivos/' . $idInforme . '/'; // Ajusta la ruta de la carpeta según tu estructura de archivos

       if (is_dir($carpeta)) {
        $archivos = scandir($carpeta);
        foreach ($archivos as $archivo) {
            if ($archivo !== '.' && $archivo !== '..') {
                $url = "https://docs.google.com/gview?url=" . base_url() . $carpeta . $archivo;
                echo "<a href='$url' target='_blank'>$archivo</a><br/>";
            }
        }
    } else {
            echo "<p>No se encontraron archivos en esta carpeta.</p>";
        }
    ?>

    
<script>
        function openDocument(url) {
            var newWindow = window.open(url, '_blank');
            newWindow.focus();
        }
    </script>
</body>
</html>

