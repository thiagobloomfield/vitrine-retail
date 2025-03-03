CREATE TABLE profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_id INT,
    FOREIGN KEY (profile_id) REFERENCES profiles(id)
);

-- Adicionar um usuário e perfil exemplo
INSERT INTO profiles (name) VALUES ('Admin'), ('User');

INSERT INTO users (username, password, profile_id) 
VALUES 
    ('admin', PASSWORD('adminpassword'), 1),
    ('user', PASSWORD('userpassword'), 2);
