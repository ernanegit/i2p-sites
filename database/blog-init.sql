CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100) DEFAULT 'Anônimo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    content TEXT NOT NULL,
    author VARCHAR(100) DEFAULT 'Anônimo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id)
);

INSERT INTO posts (title, content, author) VALUES 
('🔗 Bem-vindo ao I2P!', 'Este é o primeiro post do blog I2P descentralizado. Aqui você pode postar anonimamente!', 'Admin'),
('🔐 Privacidade Total', 'Todas as suas comunicações são criptografadas e anônimas através da rede I2P.', 'I2P_User');