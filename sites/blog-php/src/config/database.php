<?php
$host = $_ENV['DB_HOST'] ?? 'mysql-blog';
$dbname = $_ENV['DB_NAME'] ?? 'blog_i2p';
$username = $_ENV['DB_USER'] ?? 'bloguser';
$password = $_ENV['DB_PASS'] ?? 'blogpass123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>