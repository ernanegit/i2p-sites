#!/bin/bash

echo "🚀 Iniciando Blog PHP I2P..."

# Aguardar MySQL estar disponível
echo "⏳ Aguardando MySQL estar disponível..."
/wait-for-it.sh mysql-blog:3306 --timeout=60 --strict -- echo "✅ MySQL conectado!"

# Testar conexão com banco
echo "🔍 Testando conexão com banco de dados..."
php -r "
try {
    \$pdo = new PDO('mysql:host=mysql-blog;dbname=blog_i2p', 'bloguser', 'blogpass123');
    echo '✅ Conexão com banco OK!' . PHP_EOL;
} catch(Exception \$e) {
    echo '❌ Erro na conexão: ' . \$e->getMessage() . PHP_EOL;
}
"

echo "🌐 Iniciando Apache..."
exec apache2-foreground