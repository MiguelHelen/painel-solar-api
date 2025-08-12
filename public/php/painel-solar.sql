CREATE DATABASE IF NOT EXISTS painel_solar;
USE painel_solar;

-- Usuários do sistema
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'usuario') DEFAULT 'usuario',
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Projetos cadastrados
CREATE TABLE projetos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    localizacao VARCHAR(255),
    criado_por INT,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (criado_por) REFERENCES usuarios(id)
);

-- Dados de medições dos painéis solares
CREATE TABLE medicoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    projeto_id INT,
    energia_gerada DECIMAL(10,2), -- kWh
    irradiancia DECIMAL(10,2),    -- W/m²
    temperatura DECIMAL(5,2),     -- °C
    data_medicao DATETIME NOT NULL,
    FOREIGN KEY (projeto_id) REFERENCES projetos(id)
);

-- Histórico de eventos ou alterações
CREATE TABLE historico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    projeto_id INT,
    acao VARCHAR(255),
    detalhes TEXT,
    data_evento DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (projeto_id) REFERENCES projetos(id)
);

-- Dados genéricos coletados pela API (caso precise flexibilidade)
CREATE TABLE dados_api (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chave VARCHAR(100),
    valor VARCHAR(255),
    projeto_id INT,
    data_coleta DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (projeto_id) REFERENCES projetos(id)
);