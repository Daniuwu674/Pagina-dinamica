<?php
// Conexión a la base de datos
$db = new SQLite3('curriculum.db');

// Verificar si los datos han sido enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $empresa = $_POST['empresa'];
    $puesto = $_POST['puesto'];
    $fecha_inicio_experiencia = $_POST['fecha_inicio_experiencia'];
    $fecha_fin_experiencia = $_POST['fecha_fin_experiencia'];
    $descripcion = $_POST['descripcion'];
    
    $institucion = $_POST['institucion'];
    $titulo = $_POST['titulo'];
    $fecha_inicio_formacion = $_POST['fecha_inicio_formacion'];
    $fecha_fin_formacion = $_POST['fecha_fin_formacion'];
    
    $idiomas = $_POST['idiomas'];
    $aptitudes = $_POST['aptitudes'];
    
    // Insertar los datos en la tabla experiencia_laboral
    $stmt_experiencia = $db->prepare("INSERT INTO experiencia_laboral (empresa, puesto, fecha_inicio, fecha_fin, descripcion) VALUES (?, ?, ?, ?, ?)");
    $stmt_experiencia->bindValue(1, $empresa, SQLITE3_TEXT);
    $stmt_experiencia->bindValue(2, $puesto, SQLITE3_TEXT);
    $stmt_experiencia->bindValue(3, $fecha_inicio_experiencia, SQLITE3_TEXT);
    $stmt_experiencia->bindValue(4, $fecha_fin_experiencia, SQLITE3_TEXT);
    $stmt_experiencia->bindValue(5, $descripcion, SQLITE3_TEXT);
    $stmt_experiencia->execute();

    // Insertar los datos en la tabla formacion
    $stmt_formacion = $db->prepare("INSERT INTO formacion (institucion, titulo, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
    $stmt_formacion->bindValue(1, $institucion, SQLITE3_TEXT);
    $stmt_formacion->bindValue(2, $titulo, SQLITE3_TEXT);
    $stmt_formacion->bindValue(3, $fecha_inicio_formacion, SQLITE3_TEXT);
    $stmt_formacion->bindValue(4, $fecha_fin_formacion, SQLITE3_TEXT);
    $stmt_formacion->execute();
    
    // Insertar los datos en la tabla aptitudes
    $stmt_aptitudes = $db->prepare("INSERT INTO aptitudes (idiomas, habilidades) VALUES (?, ?)");
    $stmt_aptitudes->bindValue(1, $idiomas, SQLITE3_TEXT);
    $stmt_aptitudes->bindValue(2, $aptitudes, SQLITE3_TEXT);
    $stmt_aptitudes->execute();

    // Redireccionar a la página de visualización del currículum
    header("Location: mostrar_curriculum.php");
    exit();
}
?>
