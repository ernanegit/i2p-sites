-- Configurar charset correto para a sessão
SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci;
SET CHARACTER SET utf8mb4;

-- Recriar as tabelas com charset correto
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts;

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100) DEFAULT 'Anonimo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    content TEXT NOT NULL,
    author VARCHAR(100) DEFAULT 'Anonimo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir dados com encoding correto
INSERT INTO posts (title, content, author) VALUES 
('Bem-vindo ao I2P!', 'Este e o primeiro post do blog I2P descentralizado. Aqui voce pode postar anonimamente!', 'Admin'),
('Privacidade Total', 'Todas as suas comunicacoes sao criptografadas e anonimas atraves da rede I2P.', 'I2P_User'),
('Rede Descentralizada', 'O I2P cria uma rede completamente descentralizada onde a privacidade e garantida por design.', 'Tech_Anon'),
('Encoding Corrigido', 'Agora o sistema funciona perfeitamente com UTF-8! Teste: acentos funcionam.', 'Sistema');