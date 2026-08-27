CREATE DATABASE IF NOT EXISTS crud_petshop;
USE crud_petshop;

DROP TABLE IF EXISTS atendimentos;
DROP TABLE IF EXISTS animais;
DROP TABLE IF EXISTS clientes;


CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    email VARCHAR(100)

);


CREATE TABLE animais (
    id_animal INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    raca VARCHAR(100),
    idade INT NOT NULL,
    peso DECIMAL(5,2) NOT NULL DEFAULT 0,
    id_cliente INT NOT NULL,
    FOREIGN KEY (id_cliente)
        REFERENCES clientes(id_cliente)

);


CREATE TABLE atendimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_animal INT NOT NULL,
    procedimento VARCHAR(100) NOT NULL,
    data_atendimento DATE NOT NULL,
    horario TIME NOT NULL,
    observacao TEXT,
    status VARCHAR(30) DEFAULT 'Agendado',
    FOREIGN KEY (id_cliente)
        REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_animal)
        REFERENCES animais(id_animal)

);