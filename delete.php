<?php
require 'db.php';
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("DELETE FROM peliculas WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
    exit;
}

// Sacamos el título para preguntar con el nombre del juego
$stmt = $pdo->prepare("SELECT titulo FROM peliculas WHERE id = ?");
$stmt->execute([$id]);
$pelicula = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Confirmar Eliminación</h1>
    <p>¿Estás completamente seguro de que deseas eliminar la película <strong><?= htmlspecialchars($pelicula['titulo']) ?></strong>?</p>
    <form method="POST">
        <button type="submit" style="color: red;">Sí, Eliminar</button>
        <a href="index.php"><button type="button">Cancelar</button></a>
    </form>
</body>
</html>