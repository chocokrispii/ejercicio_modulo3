<?php
require 'db.php';
// Obtenemos todas las películas
$stmt = $pdo->query("SELECT * FROM peliculas");
$peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Películas</title>
</head>
<body>
    <h1>Catálogo de Películas</h1>
    <a href="create.php"><button>Añadir Nueva Película</button></a>
    <br><br>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Título</th><th>Director</th><th>Género</th><th>Año</th><th>Duración</th><th>Acciones</th>
        </tr>
        <?php foreach ($peliculas as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['id']) ?></td>
            <td><?= htmlspecialchars($p['titulo']) ?></td>
            <td><?= htmlspecialchars($p['director']) ?></td>
            <td><?= htmlspecialchars($p['genero']) ?></td>
            <td><?= htmlspecialchars($p['anio']) ?></td>
            <td><?= htmlspecialchars($p['duracion']) ?></td>
            <td>
                <a href="edit.php?id=<?= $p['id'] ?>">Modificar</a> | 
                <a href="delete.php?id=<?= $p['id'] ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
