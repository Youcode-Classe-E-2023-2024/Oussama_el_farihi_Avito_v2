-- Create the database
CREATE DATABASE IF NOT EXISTS avito_database;
USE avito_database;

-- Create the User table
CREATE TABLE user (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    img varchar(255),
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    user_type ENUM('admin', 'annonceur', 'utilisateur') NOT NULL
);

-- Create the Annonce table
CREATE TABLE annonce (
    id INT PRIMARY KEY AUTO_INCREMENT,
    image varchar(255),
    titre VARCHAR(255),
    description TEXT,
    prix FLOAT,
    date_poste DATE,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);