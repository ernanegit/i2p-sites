<?php
// Forçar UTF-8 em TUDO
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_regex_encoding('UTF-8');
ini_set('default_charset', 'UTF-8');

require_once 'config/database.php';

// Buscar posts com configuração de charset adequada
try {
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 10");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $posts = [];
    error_log("Erro ao buscar posts: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔗 Blog I2P Anônimo</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 40px; 
            background: #1a1a2e; 
            color: #fff; 
        }
        .container { 
            max-width: 800px; 
            margin: 0 auto; 
        }
        .header { 
            text-align: center; 
            margin-bottom: 40px; 
        }
        .post { 
            background: rgba(255,255,255,0.1); 
            padding: 20px; 
            margin: 20px 0; 
            border-radius: 10px; 
            border-left: 4px solid #00ff88;
        }
        .post-title { 
            color: #00ff88; 
            margin-bottom: 10px; 
            font-size: 20px;
        }
        .post-meta { 
            font-size: 12px; 
            color: #888; 
            margin-bottom: 15px; 
        }
        .status { 
            text-align: center; 
            padding: 15px; 
            background: #00ff88; 
            color: #000; 
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .footer-info {
            text-align: center; 
            margin-top: 40px; 
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }
        .encoding-info {
            background: rgba(0,255,136,0.2);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📝 Blog Dark I2P</h1>
            <div class="status">🔗 blogdark.i2p - Conectado à Rede Anônima I2P</div>
            <div class="encoding-info">
                📝 Sistema: UTF-8 | Banco: utf8mb4_unicode_ci | PHP: <?= mb_internal_encoding() ?>
            </div>
        </div>
        
        <div class="posts">
            <?php if(empty($posts)): ?>
                <div class="post">
                    <h3>⏳ Aguardando conexão com banco de dados...</h3>
                    <p>O sistema está inicializando. Recarregue a página em alguns segundos.</p>
                </div>
            <?php else: ?>
                <?php foreach($posts as $post): ?>
                <div class="post">
                    <h3 class="post-title"><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <div class="post-meta">
                        👤 Por: <strong><?= htmlspecialchars($post['author'], ENT_QUOTES, 'UTF-8') ?></strong> | 
                        📅 <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
                    </div>
                    <div class="post-content">
                        <?= nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
                <div class="footer-info">
            <p>🔒 Todas as comunicações são criptografadas via Garlic Routing</p>
            <p>🌐 Acesso: <strong>blogdark.i2p</strong> | Portal: <a href="http://localhost">localhost</a></p>
            <p>💬 Chat: <a href="http://chatanon.i2p">chatanon.i2p</a> | 🛒 Market: <a href="http://marketdark.i2p">marketdark.i2p</a></p>
            <p>✅ Sistema funcionando com encoding UTF-8 corrigido</p>
        </div>
    </div>
</body>
</html>