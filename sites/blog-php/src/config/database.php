<?php
// Forçar UTF-8 em todas as camadas
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_regex_encoding('UTF-8');
ini_set('default_charset', 'UTF-8');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = $_ENV['DB_HOST'] ?? 'mysql-blog';
$dbname = $_ENV['DB_NAME'] ?? 'blog_i2p';
$username = $_ENV['DB_USER'] ?? 'bloguser';
$password = $_ENV['DB_PASS'] ?? 'blogpass123';

$max_retries = 5;
$retry_count = 0;
$pdo = null;

while ($retry_count < $max_retries && $pdo === null) {
    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4", 
            $username, 
            $password, 
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_TIMEOUT => 5
            ]
        );
        
        // Configurações adicionais de charset
        $pdo->exec("SET CHARACTER SET utf8mb4");
        $pdo->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("SET character_set_client = utf8mb4");
        $pdo->exec("SET character_set_results = utf8mb4");
        $pdo->exec("SET character_set_connection = utf8mb4");
        
        // Testar conexão
        $pdo->query("SELECT 1");
        error_log("✅ Conexão com MySQL estabelecida com sucesso!");
        
    } catch(PDOException $e) {
        $retry_count++;
        error_log("❌ Tentativa $retry_count/$max_retries falhou: " . $e->getMessage());
        
        if ($retry_count < $max_retries) {
            error_log("⏳ Aguardando 2 segundos antes da próxima tentativa...");
            sleep(2);
        } else {
            error_log("💥 Máximo de tentativas excedido. Usando modo offline.");
            break;
        }
    }
}

// Se não conseguiu conectar, criar objeto mock para evitar erros
if ($pdo === null) {
    class MockPDO {
        public function query($sql) {
            return new class {
                public function fetchAll() {
                    return [
                        [
                            'id' => 1,
                            'title' => '⚠️ Modo Offline',
                            'content' => 'Não foi possível conectar ao banco de dados. Verifique se o MySQL está rodando.',
                            'author' => 'Sistema',
                            'created_at' => date('Y-m-d H:i:s')
                        ]
                    ];
                }
            };
        }
        
        public function exec($sql) {
            return true;
        }
    }
    
    $pdo = new MockPDO();
}
?>