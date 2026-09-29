<?php
require 'db.php';
$error = '';
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Obtener los datos actuales para rellenar el formulario
$stmt = $pdo->prepare("SELECT * FROM peliculas WHERE id = ?");
$stmt->execute([$id]);
$pelicula = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $director = trim($_POST['director'] ?? '');
    $genero = trim($_POST['genero'] ?? '');
    $anio = trim($_POST['anio'] ?? '');
    $duracion = trim($_POST['duracion'] ?? '');

    if (empty($titulo) || empty($director) || empty($genero) || empty($anio) || empty($duracion)) {
        $error = "Error: Todos los campos son obligatorios.";
    } else {
        $stmt = $pdo->prepare("UPDATE peliculas SET titulo=?, director=?, genero=?, anio=?, duracion=? WHERE id=?");
        $stmt->execute([$titulo, $director, $genero, $anio, $duracion, $id]);
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Modificar Película</h1>
    <?php if ($error): ?><p style="color:red;"><?= $error ?></p><?php endif; ?>
    <form method="POST">
        Título: <input type="text" name="titulo" value="<?= htmlspecialchars($pelicula['titulo']) ?>"><br><br>
        Director: <input type="text" name="director" value="<?= htmlspecialchars($pelicula['director']) ?>"><br><br>
        Género: <input type="text" name="genero" value="<?= htmlspecialchars($pelicula['genero']) ?>"><br><br>
        Año: <input type="text" name="anio" value="<?= htmlspecialchars($pelicula['anio']) ?>"><br><br>
        Duración: <input type="number" name="duracion" value="<?= htmlspecialchars($pelicula['duracion']) ?>"><br><br>
        <button type="submit">Actualizar</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
