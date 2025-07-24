FROM node:18-alpine

WORKDIR /app

# Copiar package.json primeiro para cache das dependências
COPY package.json ./

# Instalar dependências
RUN npm install

# Copiar código fonte
COPY src/ ./

# Criar usuário não-root
RUN addgroup -g 1001 -S nodejs
RUN adduser -S nodejs -u 1001
USER nodejs

EXPOSE 3000

CMD ["node", "server.js"]