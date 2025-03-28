-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 28 mars 2025 à 11:17
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restaurant`
--

-- --------------------------------------------------------

--
-- Structure de la table `feedback`
--
CREATE DATABASE IF NOT EXISTS restaurant;
USE restaurant;
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `com_feed` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `note_feed` int NOT NULL,
  `id_feed_categ` int NOT NULL,
  `date_feed` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `feedback`
--

INSERT INTO `feedback` (`id`, `com_feed`, `note_feed`, `id_feed_categ`, `date_feed`) VALUES
(1, 'aedg', 3, 2, '2024-11-29');

-- --------------------------------------------------------

--
-- Structure de la table `feedback_categ`
--

DROP TABLE IF EXISTS `feedback_categ`;
CREATE TABLE IF NOT EXISTS `feedback_categ` (
  `id_feed_categ` int NOT NULL AUTO_INCREMENT,
  `type_feed_categ` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_feed_categ`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `feedback_categ`
--

INSERT INTO `feedback_categ` (`id_feed_categ`, `type_feed_categ`) VALUES
(1, 'plat tunisien'),
(2, 'plat algerien'),
(3, 'plat marocain');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `menu_id` int DEFAULT NULL,
  `quantite` int DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `num_people` int NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `reservation_date`, `reservation_time`, `num_people`, `client_name`) VALUES
(1, '2024-12-11', '13:30:00', 1, 'aed'),
(2, '2024-12-03', '19:00:00', 4, 'aedh');

-- --------------------------------------------------------

--
-- Structure de la table `transictions`
--

DROP TABLE IF EXISTS `transictions`;
CREATE TABLE IF NOT EXISTS `transictions` (
  `ordernumber` int NOT NULL AUTO_INCREMENT,
  `cardnumber` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `cardname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cvv` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `exp_month` int NOT NULL,
  `exp_year` int NOT NULL,
  PRIMARY KEY (`ordernumber`,`cvv`,`cardnumber`)
) ENGINE=InnoDB AUTO_INCREMENT=675 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `transictions`
--

INSERT INTO `transictions` (`ordernumber`, `cardnumber`, `cardname`, `cvv`, `exp_month`, `exp_year`) VALUES
(674, '2342 3423 4234 2342', 'aedh', '322', 2, 2),
(674, '3453 453453 45345', 'AEDF', '3333', 4, 4),
(674, '3453 45', '345', '345', 34, 34),
(674, '3453 453453 45345', 'FGDFG', '345', 34, 34),
(674, '4534 5345 3453 4534', 'aedgs', '3453', 2, 20);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'Hela', '$2y$10$jB5NqJLiX.X7PYifIyPTT.ZYVART1dap06ipR4wb/HsB7KYDaFG9u', 'hela.trabelsi@ecoles-epsi.net', '2024-11-12 14:52:59'),
(2, 'aedh', '$2y$10$Wlr8VncOBhmO.exgmkWns.MopRraEiMqo2iUll9m.CfKeevhOId02', 'aljeneaedh@gmail.com', '2024-12-03 14:06:14'),
(3, 'hela', '$2y$10$J5abbuTDVieMxnTr/XAN4eg7DbAbXa5iqkrGMuSQPD2g5CeqivmcG', 'hela@gmail.com', '2024-12-03 17:29:33');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
