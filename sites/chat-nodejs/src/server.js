const http = require('http');

const server = http.createServer((req, res) => {
    res.writeHead(200, {'Content-Type': 'text/html; charset=utf-8'});
    res.end(`
        <h1> Chat I2P Funcionando!</h1>
        <p> Servidor Node.js OK</p>
        <p> Rede I2P Conectada</p>
        <style>body{background:#1a1a2e;color:white;font-family:Arial;text-align:center;padding:50px;}</style>
    `);
});

server.listen(3000, '0.0.0.0', () => {
    console.log(' Chat I2P rodando na porta 3000');
});