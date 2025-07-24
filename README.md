# 🌐 I2P Sites Simulator

Simulação completa de rede I2P com sites dinâmicos, sistema de email real e domínios .i2p usando Docker.

## 🎯 Status Atual

**✅ I2P Router**: Conectado e funcionando (porta 7657)  
**✅ Blog PHP**: Funcionando com MySQL (porta 8082)  
**✅ Chat Node.js**: Funcionando com Redis (porta 8081)  
**✅ Docker Setup**: Configurado e estável  
**✅ Domínios .i2p**: Configurados e operacionais  
**✅ Nginx Proxy**: Proxy reverso funcionando (porta 80)  
**🔧 Sistema Email I2P**: Em configuração (SusiMail real)  

## 🏗️ Arquitetura

### Serviços Principais
- **I2P Router**: Router oficial com console web
- **Blog Dark**: Sistema PHP com MySQL (blogdark.i2p)
- **Chat Anônimo**: Chat Node.js com Redis (chatanon.i2p)
- **Marketplace**: Página placeholder (marketdark.i2p)
- **Forum**: Página placeholder (forumdark.i2p)
- **Nginx Proxy**: Proxy reverso com domínios .i2p

### Banco de Dados
- **MySQL 8.0**: Para o blog PHP
- **Redis**: Para sessões do chat

### Rede
- **Rede Docker**: 172.20.0.0/16
- **DNS Local**: Configurado via arquivo hosts
- **SSL/TLS**: Certificados locais configurados

## 🚀 Como Usar

### Pré-requisitos
- Docker Desktop
- PowerShell (Windows)
- Permissões de Administrador (para arquivo hosts)

### Instalação

```bash
# 1. Clone o repositório
git clone https://github.com/ernanegit/i2p-sites.git
cd i2p-sites

# 2. Configure domínios .i2p no arquivo hosts (como Administrador)
Add-Content -Path "C:\Windows\System32\drivers\etc\hosts" -Value "127.0.0.1 blogdark.i2p"
Add-Content -Path "C:\Windows\System32\drivers\etc\hosts" -Value "127.0.0.1 chatanon.i2p"
Add-Content -Path "C:\Windows\System32\drivers\etc\hosts" -Value "127.0.0.1 marketdark.i2p"
Add-Content -Path "C:\Windows\System32\drivers\etc\hosts" -Value "127.0.0.1 forumdark.i2p"
Add-Content -Path "C:\Windows\System32\drivers\etc\hosts" -Value "127.0.0.1 portal.i2p"

# 3. Limpar cache DNS
ipconfig /flushdns

# 4. Gerar certificados SSL (opcional)
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout ssl\i2p.key -out ssl\i2p.crt -subj "/C=BR/ST=I2P/L=Network/O=I2P/CN=*.i2p"

# 5. Iniciar containers
docker-compose build
docker-compose up -d

# 6. Aguardar I2P inicializar (2-3 minutos)
docker-compose logs -f i2p-router
```

## 🌐 Acessos

### Sites I2P
- **Portal I2P**: http://portal.i2p (página de entrada da rede)
- **Blog Dark**: http://blogdark.i2p (blog anônimo com posts)
- **Chat Anônimo**: http://chatanon.i2p (chat em tempo real)
- **Marketplace**: http://marketdark.i2p (marketplace - em desenvolvimento)
- **Forum**: http://forumdark.i2p (forum - em desenvolvimento)

### Serviços Diretos
- **I2P Console**: http://localhost:7657 (interface administrativa)
- **Blog (direto)**: http://localhost:8082
- **Chat (direto)**: http://localhost:8081
- **Proxy Nginx**: http://localhost:80

### Sistema de Email I2P
- **SusiMail**: http://localhost:7657/susimail/ (webmail integrado)
- **I2P-Bote**: http://localhost:7657/i2pbote/ (após instalação do plugin)

## 🔧 Configuração Avançada

### Email I2P (SusiMail)
1. Acesse http://localhost:7657/i2ptunnel/
2. Configure túneis SMTP (porta 7659) e POP3 (porta 7660)
3. Registre conta em http://hq.postman.i2p
4. Use email formato: usuario@mail.i2p

### Monitoramento
```bash
# Status dos containers
docker-compose ps

# Logs específicos
docker-compose logs blog-php
docker-compose logs chat-nodejs
docker-compose logs i2p-router

# Verificar conectividade
docker exec blog_php_i2p nc -zv mysql-blog 3306
```

## 📁 Estrutura do Projeto

```
i2p-sites/
├── config/
│   └── nginx/
│       └── default.conf          # Configuração proxy reverso
├── database/
│   └── blog-init.sql             # Dados iniciais do blog
├── sites/
│   ├── blog-php/
│   │   ├── Dockerfile
│   │   ├── start.sh              # Script de inicialização
│   │   └── src/
│   │       ├── index.php         # Blog principal
│   │       └── config/database.php
│   └── chat-nodejs/
│       ├── Dockerfile
│       ├── package.json
│       └── src/server.js
├── ssl/                          # Certificados SSL
├── docker-compose.yml            # Orquestração principal
├── .gitignore
└── README.md
```

## 🛠️ Tecnologias

### Backend
- **PHP 8.1** + Apache + MySQL 8.0
- **Node.js 18** + Express + Redis
- **I2P Router** (Java)

### Frontend
- **HTML5** + CSS3 + JavaScript
- **Design Dark Web** temático
- **Responsivo** para mobile

### Infraestrutura
- **Docker & Docker Compose**
- **Nginx** (proxy reverso)
- **SSL/TLS** (certificados locais)
- **DNS local** (arquivo hosts)

## 🔐 Recursos de Segurança

### Simulação I2P
- ✅ **Garlic Routing** (simulado)
- ✅ **Headers I2P** (X-I2P-Network, X-Anonymity-Level)
- ✅ **Domínios .i2p** reais
- ✅ **Criptografia** (simulada via headers)

### Segurança Real
- ✅ **Rede isolada** Docker
- ✅ **Containers** sem privilégios
- ✅ **SSL/TLS** local
- ✅ **Wait-for-it** (dependências)

## 📊 Monitoramento e Debug

### Comandos Úteis
```bash
# Verificar status completo
docker-compose ps
docker volume ls
docker network ls

# Logs em tempo real
docker-compose logs -f

# Restart seletivo
docker-compose restart nginx-proxy
docker-compose restart blog-php

# Limpeza completa
docker-compose down -v
docker system prune -af --volumes
```

### Troubleshooting
- **Blog não carrega**: Verificar logs MySQL e aguardar inicialização
- **Encoding UTF-8**: Dados podem ter caracteres corrompidos (correção em progresso)
- **Domínios .i2p não resolvem**: Verificar arquivo hosts e cache DNS
- **I2P lento para iniciar**: Aguardar 2-3 minutos para bootstrap da rede

## 🎯 Roadmap

### Próximas Implementações
- [ ] ✅ Correção completa encoding UTF-8 no blog
- [ ] 📧 Sistema email I2P completo (SusiMail + I2P-Bote)
- [ ] 🛒 Marketplace funcional com produtos
- [ ] 💭 Forum com discussões anônimas
- [ ] 🔐 Sistema de chaves PGP
- [ ] 📱 Interface mobile otimizada
- [ ] 🚀 Deploy em VPS com I2P real

### Melhorias Técnicas
- [ ] 🔄 Auto-backup de dados
- [ ] 📈 Métricas e monitoring
- [ ] 🧪 Testes automatizados
- [ ] 📚 Documentação API
- [ ] 🐳 Otimização Docker

## 🤝 Contribuição

1. **Fork** o projeto
2. **Clone** sua fork
3. **Crie** uma branch para sua feature
4. **Commit** suas mudanças
5. **Push** para a branch
6. **Abra** um Pull Request

### Convenções
- Commits em português
- Branch naming: `feature/nome-da-feature`
- Documentar mudanças no README

## 📄 Licença

Projeto educacional para demonstração de conceitos I2P.  
**Não usar em produção sem auditoria de segurança.**

## 👨‍💻 Autor

**Ernane** - [ernanegit](https://github.com/ernanegit)

---

**⚠️ Aviso**: Este é um simulador educacional. Para uso real do I2P, utilize o software oficial em https://geti2p.net/

**🔗 Acesse o portal**: http://portal.i2p