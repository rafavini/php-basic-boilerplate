CREATE DATABASE IF NOT EXISTS didactic_mvc;
USE didactic_mvc;

-- -----------------------------------------------------------------------
-- 1. Roles  (apenas agrupamento)
-- -----------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS roles (
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- -----------------------------------------------------------------------
-- 2. Permissions  (unidade atômica de acesso  →  resource.action)
-- -----------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS permissions (
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE   -- ex: user.create, sample.delete
);

-- -----------------------------------------------------------------------
-- 3. Users
-- -----------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL
);

-- -----------------------------------------------------------------------
-- 4. Pivô  user ↔ role
-- -----------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS role_user (
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    PRIMARY KEY (user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

-- -----------------------------------------------------------------------
-- 5. Pivô  role ↔ permission
-- -----------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS permission_role (
    role_id       INT NOT NULL,
    permission_id INT NOT NULL,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id)       REFERENCES roles(id)       ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
);

-- ───────────────────────────────────────────────────────────────────────
-- SEED
-- ───────────────────────────────────────────────────────────────────────

-- Roles
INSERT INTO roles (name) VALUES ('admin'), ('professor'), ('aluno');

-- Permissions  (resource.action)
INSERT INTO permissions (name) VALUES
    ('user.create'),
    ('user.read'),
    ('user.update'),
    ('user.delete'),
    ('sample.create'),
    ('sample.read'),
    ('sample.update'),
    ('sample.delete');

-- Admin  → todas as permissions
INSERT INTO permission_role (role_id, permission_id)
SELECT r.id, p.id
FROM roles r, permissions p
WHERE r.name = 'admin';

-- Professor  → tudo do sample exceto delete; pode ler users
INSERT INTO permission_role (role_id, permission_id)
SELECT r.id, p.id
FROM roles r
JOIN permissions p ON p.name IN ('sample.create','sample.read','sample.update','user.read')
WHERE r.name = 'professor';

-- Aluno  → somente leitura
INSERT INTO permission_role (role_id, permission_id)
SELECT r.id, p.id
FROM roles r
JOIN permissions p ON p.name IN ('sample.read','user.read')
WHERE r.name = 'aluno';

-- Users  (senha: 123456)
INSERT INTO users (name, email, password) VALUES
    ('Admin User',      'admin@teste.com',      '$2y$10$4XgSz4kZKewTI7f8G6PWG..vMZT2AMHzCB7DbrAgJ1IAKZC0bJYoq'),
    ('Professor User',  'professor@teste.com',  '$2y$10$4XgSz4kZKewTI7f8G6PWG..vMZT2AMHzCB7DbrAgJ1IAKZC0bJYoq'),
    ('Aluno User',      'aluno@teste.com',       '$2y$10$4XgSz4kZKewTI7f8G6PWG..vMZT2AMHzCB7DbrAgJ1IAKZC0bJYoq');

-- Atribui roles aos users
INSERT INTO role_user (user_id, role_id)
SELECT u.id, r.id FROM users u, roles r
WHERE (u.email='admin@teste.com'     AND r.name='admin')
   OR (u.email='professor@teste.com' AND r.name='professor')
   OR (u.email='aluno@teste.com'     AND r.name='aluno');
