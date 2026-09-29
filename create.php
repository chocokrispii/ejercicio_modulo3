<?php
require 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos
    $titulo = trim($_POST['titulo'] ?? '');
    $director = trim($_POST['director'] ?? '');
    $genero = trim($_POST['genero'] ?? '');
    $anio = trim($_POST['anio'] ?? '');
    $duracion = trim($_POST['duracion'] ?? '');

    // Validación
    if (empty($titulo) || empty($director) || empty($genero) || empty($anio) || empty($duracion)) {
        $error = "Error: Todos los campos son obligatorios.";
    } else {
        // Insertar en la BD
        $stmt = $pdo->prepare("INSERT INTO peliculas (titulo, director, genero, anio, duracion) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$titulo, $director, $genero, $anio, $duracion]);
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Añadir Película</h1>
    <?php if ($error): ?><p style="color:red;"><?= $error ?></p><?php endif; ?>
    <form method="POST">
        Título: <input type="text" name="titulo"><br><br>
        Director: <input type="text" name="director"><br><br>
        Género: <input type="text" name="genero"><br><br>
        Año: <input type="text" name="anio"><br><br>
        Duración: <input type="number" name="duracion"><br><br>
        <button type="submit">Guardar</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
