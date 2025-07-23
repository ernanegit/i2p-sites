<?php
require_once 'config/database.php';

// Buscar posts
try {
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 10");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $posts = [];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔒 Blog I2P Anônimo</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #1a1a2e; color: #fff; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 40px; }
        .post { background: rgba(255,255,255,0.1); padding: 20px; margin: 20px 0; border-radius: 10px; }
        .post-title { color: #00ff88; margin-bottom: 10px; }
        .post-meta { font-size: 12px; color: #888; margin-bottom: 15px; }
        .status { text-align: center; padding: 10px; background: #00ff88; color: #000; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔗 Blog I2P Descentralizado</h1>
            <div class="status">🟢 Conectado à Rede Anônima I2P</div>
        </div>
        
        <div class="posts">
            <?php if(empty($posts)): ?>
                <div class="post">
                    <h3>🔄 Aguardando conexão com banco de dados...</h3>
                    <p>O sistema está inicializando. Recarregue a página em alguns segundos.</p>
                </div>
            <?php else: ?>
                <?php foreach($posts as $post): ?>
                <div class="post">
                    <h3 class="post-title"><?= htmlspecialchars($post['title']) ?></h3>
                    <div class="post-meta">
                        Por: <strong><?= htmlspecialchars($post['author']) ?></strong> | 
                        <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
                    </div>
                    <div class="post-content">
                        <?= nl2br(htmlspecialchars($post['content'])) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div style="text-align: center; margin-top: 40px; color: #666;">
            <p>🔐 Todas as comunicações são criptografadas via Garlic Routing</p>
            <p>🌐 Rede I2P Simulada - Para fins educacionais</p>
        </div>
    </div>
</body>
</html>