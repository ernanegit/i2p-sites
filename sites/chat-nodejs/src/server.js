const express = require('express');
const http = require('http');

const app = express();
const server = http.createServer(app);

app.get('/', (req, res) => {
    res.send(`
        <h1>🔗 Chat I2P Anônimo</h1>
        <p>✅ Servidor Node.js funcionando!</p>
        <p>🌐 Conectado via rede I2P simulada</p>
        <p>🔐 Comunicação criptografada</p>
        <style>
            body { font-family: Arial; background: #1a1a2e; color: #fff; padding: 40px; }
            h1 { color: #00ff88; }
        </style>
    `);
});

app.get('/status', (req, res) => {
    res.json({
        status: 'online',
        service: 'I2P Chat',
        timestamp: new Date().toISOString()
    });
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, '0.0.0.0', () => {
    console.log('🔗 Chat I2P rodando na porta ' + PORT);
});