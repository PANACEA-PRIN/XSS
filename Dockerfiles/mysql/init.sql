-- Creazione del database
CREATE DATABASE IF NOT EXISTS db_web;

-- Utilizzo del database
USE db_web;

-- Creazione della tabella Users
CREATE TABLE IF NOT EXISTS Users (
   username VARCHAR(30) PRIMARY KEY NOT NULL,
   passw VARCHAR(255) NOT NULL
);

-- Creazione della tabella Comments con chiave esterna
CREATE TABLE IF NOT EXISTS Posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment VARCHAR(2000) NOT NULL,
    imageUrl VARCHAR(250),
    username VARCHAR(30) NOT NULL,
    FOREIGN KEY (username) REFERENCES Users(username)
);
