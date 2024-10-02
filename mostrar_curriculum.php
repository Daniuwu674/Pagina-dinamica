<?php
// Conexión a la base de datos
try {
    $db = new SQLite3('curriculum.db');
} catch (Exception $e) {
    die('Error de conexión a la base de datos: ' . $e->getMessage());
}

// Función para ejecutar consultas de manera segura
function executeQuery($db, $sql) {
    $result = $db->query($sql);
    if ($result === false) {
        die('Error en la consulta: ' . $db->lastErrorMsg());
    }
    return $result;
}

// Obtener los datos de las tablas
$result_experiencia = executeQuery($db, 'SELECT * FROM experiencia_laboral');
$result_formacion = executeQuery($db, 'SELECT * FROM formacion');
$result_aptitudes = executeQuery($db, 'SELECT * FROM aptitudes');

// Función para escapar HTML
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; }
        h1 { color: #333; }
        h2 { color: #666; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .section { margin-bottom: 20px; }
        .item { background: #f9f9f9; padding: 10px; margin-bottom: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Currículum</h1>

    <div class="section">
        <h2>Experiencia Laboral</h2>
        <?php while ($row = $result_experiencia->fetchArray(SQLITE3_ASSOC)): ?>
            <div class="item">
                <p><strong>Empresa:</strong> <?= e($row['empresa']) ?></p>
                <p><strong>Puesto:</strong> <?= e($row['puesto']) ?></p>
                <p><strong>Fecha Inicio:</strong> <?= e($row['fecha_inicio']) ?></p>
                <p><strong>Fecha Fin:</strong> <?= e($row['fecha_fin']) ?></p>
                <p><strong>Descripción:</strong> <?= e($row['descripcion']) ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="section">
        <h2>Formación</h2>
        <?php while ($row = $result_formacion->fetchArray(SQLITE3_ASSOC)): ?>
            <div class="item">
                <p><strong>Institución:</strong> <?= e($row['institucion']) ?></p>
                <p><strong>Título:</strong> <?= e($row['titulo']) ?></p>
                <p><strong>Fecha Inicio:</strong> <?= e($row['fecha_inicio']) ?></p>
                <p><strong>Fecha Fin:</strong> <?= e($row['fecha_fin']) ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="section">
        <h2>Aptitudes</h2>
        <?php while ($row = $result_aptitudes->fetchArray(SQLITE3_ASSOC)): ?>
            <div class="item">
                <p><strong>Idiomas:</strong> <?= e($row['idiomas']) ?></p>
                <p><strong>Habilidades:</strong> <?= e($row['habilidades']) ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <?php $db->close(); ?>
</body>
</html>