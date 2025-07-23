#  I2P Sites Simulator

Simulação de sites dinâmicos rodando em rede I2P usando Docker.

##  Status Atual

 **I2P Router**: Conectado e testando rede  
 **Blog PHP**: Em desenvolvimento  
 **Chat Node.js**: Em desenvolvimento  
 **Docker Setup**: Funcionando  

##  Arquitetura

- **Blog PHP**: Sistema com MySQL (porta 8082)
- **Chat Node.js**: Chat com Redis (porta 8081)  
- **I2P Router**: Router oficial (porta 7657)
- **Nginx Proxy**: Proxy reverso (porta 80/443)

##  Como usar

\\\ash
# Clone o repositório
git clone https://github.com/ernanegit/i2p-sites.git
cd i2p-sites

# Gerar certificados SSL
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout ssl\i2p.key -out ssl\i2p.crt -subj "/C=BR/ST=I2P/L=Network/O=I2P/CN=*.i2p"

# Iniciar containers
docker-compose up -d

# Aguardar I2P inicializar (2-3 minutos)
\\\

##  Acesso

- **I2P Console**: http://localhost:7657
- **Blog**: http://localhost:8082  
- **Chat**: http://localhost:8081

##  Tecnologias

- Docker & Docker Compose
- PHP 8.1 + Apache + MySQL
- Node.js 18 + Express + Redis
- I2P Router (geti2p/i2p)
- Nginx Proxy
- SSL/TLS certificates

##  TODO

- [x] Setup Docker environment
- [x] I2P Router integration
- [ ] Fix blog PHP connectivity
- [ ] Fix chat Node.js connectivity
- [ ] Add .i2p domain routing
- [ ] Implement WebSockets chat
- [ ] Add blog comment system

##  Desenvolvimento

Projeto em desenvolvimento ativo. Status dos serviços pode variar.
