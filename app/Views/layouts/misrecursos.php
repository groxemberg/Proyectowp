<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mi Aplicación' ?></title>
    <?= $this->include('recursos/headergentelella') ?>
</head>
<body class="nav-md">
    <?= $this->include('recursos/sidebargentelella') ?>
    <?= $this->include('recursos/topbargentelella') ?>

    <div class="content-wrapper">
        <?= $this->renderSection('content') ?>
    </div>

    <?= $this->include('recursos/creditosgentelella') ?>
    <?= $this->include('recursos/footergentelella') ?>
</body>
</html>