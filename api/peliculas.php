<?php
// Incluimos db.php. Como estamos dentro de la carpeta "api", subimos un nivel con "../"
require '../db.php';

// Indicamos que vamos a devolver JSON y no HTML
header('Content-Type: application/json');

// Esta API solo permite solicitudes GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
	header('Allow: GET');
	http_response_code(405);
	echo json_encode(['error' => 'Método no permitido. Usa GET.']);
	exit;
}

// Consultamos los datos
$stmt = $pdo->query("SELECT * FROM peliculas");
$peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Transformamos el array de PHP en un formato JSON e imprimimos
echo json_encode($peliculas);
?>