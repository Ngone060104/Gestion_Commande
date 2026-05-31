-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 24 mai 2026 à 20:04
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `estioncommande`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `role` varchar(20) DEFAULT 'client',
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'default.png',
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `telephone` (`telephone`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `role`, `mot_de_passe`, `photo`) VALUES
(7, 'ABIBATOU', 'Diagne', 'abibamacds@gmail.com', '771480102', 'Fan', 'client', 'password', 'default.png'),
(6, 'Sokhna', 'Diane', 'dianesoxna2003@gmail.com', '785648694', 'Medina', 'client', 'password', 'default.png'),
(3, 'Ndiaye', 'Mamadou Ardo', 'mamadouardondiaye@gmail.sn', '770865109', 'Dakar', 'client', 'password', 'default.png'),
(4, 'Diagne', 'Mame Ngone', 'ngonemame67@gmail.com', '766911225', 'Medina', 'admin', 'password', 'default.png'),
(8, 'Niang', 'Alassane', 'aluu@gmail.com', '779876543', 'Medina', 'client', NULL, '779876543_1779652865.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int NOT NULL AUTO_INCREMENT,
  `date_commande` date NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `montant_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `statut` enum('soldé','non soldé') NOT NULL DEFAULT 'non soldé',
  `id_client` int DEFAULT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `date_commande`, `libelle`, `montant_total`, `statut`, `id_client`) VALUES
(6, '2026-05-20', 'Commande Client N°3', 12500.00, 'soldé', 3);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `ref` varchar(255) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `description` text,
  `prix` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `ref`, `libelle`, `description`, `prix`, `stock`) VALUES
(5, 'REF-005', 'Sac', 'Sac à dos ergonomique, imperméable et idéal pour le transport quotidien d\'un ordinateur portable', 2500.00, 15),
(2, 'REF-002', 'Souris Sans Fil', 'Souris optique sans fil 2.4 GHz avec récepteur USB compact et autonomie longue durée', 19500.00, 500),
(3, 'REF-003', 'Support Machine', ' Support ventilé et réglable en hauteur pour ordinateur portable afin d\'améliorer la posture', 2000.00, 10),
(6, 'REF-006', 'Support Machine', 'support ajustable 2 en 1', 5000.00, 73);

-- --------------------------------------------------------

--
-- Structure de la table `produit_commande`
--

DROP TABLE IF EXISTS `produit_commande`;
CREATE TABLE IF NOT EXISTS `produit_commande` (
  `id_pc` int NOT NULL AUTO_INCREMENT,
  `id_commande` int NOT NULL,
  `id_produit` int NOT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  `prix_vente` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_pc`),
  KEY `id_commande` (`id_commande`),
  KEY `id_produit` (`id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produit_commande`
--

INSERT INTO `produit_commande` (`id_pc`, `id_commande`, `id_produit`, `quantite`, `prix_vente`) VALUES
(9, 8, 6, 2, 5000.00),
(8, 6, 5, 5, 2500.00);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
