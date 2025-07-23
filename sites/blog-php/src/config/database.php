<?php
$host = $_ENV['DB_HOST'] ?? 'mysql-blog';
$dbname = $_ENV['DB_NAME'] ?? 'blog_i2p';
$username = $_ENV['DB_USER'] ?? 'bloguser';
$password = $_ENV['DB_PASS'] ?? 'blogpass123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
    ]);
} catch(PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>