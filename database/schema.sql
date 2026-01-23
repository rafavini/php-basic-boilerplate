CREATE DATABASE IF NOT EXISTS didactic_mvc;
USE didactic_mvc;

CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

INSERT INTO roles (name) VALUES ('admin'), ('professor'), ('aluno');

-- Default password is '123456' hashed with PASSWORD_DEFAULT
INSERT INTO users (name, email, password, role_id) VALUES 
('Admin User', 'admin@teste.com', '$2y$10$4XgSz4kZKewTI7f8G6PWG..vMZT2AMHzCB7DbrAgJ1IAKZC0bJYoq', 1),
('Professor User', 'professor@teste.com', '$2y$10$4XgSz4kZKewTI7f8G6PWG..vMZT2AMHzCB7DbrAgJ1IAKZC0bJYoq', 2),
('Aluno User', 'aluno@teste.com', '$2y$10$4XgSz4kZKewTI7f8G6PWG..vMZT2AMHzCB7DbrAgJ1IAKZC0bJYoq', 3);
