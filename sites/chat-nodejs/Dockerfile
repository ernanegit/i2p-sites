FROM node:18-alpine
WORKDIR /app

# Instalar express antes de copiar arquivos
RUN npm install express

# Copiar arquivos
COPY src/ ./

EXPOSE 3000
CMD ["node", "server.js"]
