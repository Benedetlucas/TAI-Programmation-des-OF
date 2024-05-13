-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 03, 2024 at 03:33 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tai`
--

-- --------------------------------------------------------

CREATE TABLE agent (
  id INT PRIMARY KEY AUTO_INCREMENT,
  identifiant VARCHAR(255) NOT NULL,
  mot_de_passe VARCHAR(255) NOT NULL,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL
  type INT NOT NULL,
);

CREATE TABLE matiere (
  id INT PRIMARY KEY AUTO_INCREMENT,
  description VARCHAR(255) NOT NULL,
  prix DECIMAL(10,2) NOT NULL,
  cout DECIMAL(10,2) NOT NULL
);

CREATE TABLE operation (
  id INT PRIMARY KEY AUTO_INCREMENT,
  description VARCHAR(255) NOT NULL,
  id_of INT NOT NULL,
  id_matiere INT NOT NULL,
  cout INT NOT NULL,
  quantite INT NOT NULL,
  temps DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (id_of) REFERENCES of(id),
  FOREIGN KEY (id_matiere) REFERENCES matiere(id)
);

CREATE TABLE of (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_agent INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  etat VARCHAR(255) NOT NULL, 
  FOREIGN KEY (id_agent) REFERENCES agent(id)
);

INSERT INTO agent (identifiant, mot_de_passe, nom, prenom, type)
VALUES ('hippolyte.retiere', 'password', 'Retière', 'Hippolyte', 1),
       ('lucas.benedet', 'password', 'Benedet', 'Lucas', 1),
       ('hugo.sebbag', 'password', 'Sebbag', 'Hugo', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
