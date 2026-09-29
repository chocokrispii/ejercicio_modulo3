<?php
$host = 'sql112.infinityfree.com';
$dbname = 'if0_42883613_cine';
$user = 'if0_42883613';
$pass = 'r2eesT1QHFFBRFw';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>