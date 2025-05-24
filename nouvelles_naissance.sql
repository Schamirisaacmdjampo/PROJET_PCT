-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 22 mai 2025 à 16:25
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
-- Base de données : `etat_civil`
--

-- --------------------------------------------------------

--
-- Structure de la table `nouvelles_naissance`
--

DROP TABLE IF EXISTS `nouvelles_naissance`;
CREATE TABLE IF NOT EXISTS `nouvelles_naissance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_bebe` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `heure_naissance` time NOT NULL,
  `lieu_naissance` varchar(255) NOT NULL,
  `nom_pere` varchar(255) NOT NULL,
  `prenom_pere` varchar(255) NOT NULL,
  `profession_pere` varchar(255) NOT NULL,
  `nom_mere` varchar(255) NOT NULL,
  `prenom_mere` varchar(255) NOT NULL,
  `profession_mere` varchar(255) NOT NULL,
  `cni_path` varchar(255) DEFAULT NULL,
  `passeport_path` varchar(255) DEFAULT NULL,
  `nombre_copies` int NOT NULL,
  `date_demande` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` enum('en attente','validé','refusé') DEFAULT 'en attente',
  `motif_refus` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `nouvelles_naissance`
--

INSERT INTO `nouvelles_naissance` (`id`, `nom_bebe`, `date_naissance`, `heure_naissance`, `lieu_naissance`, `nom_pere`, `prenom_pere`, `profession_pere`, `nom_mere`, `prenom_mere`, `profession_mere`, `cni_path`, `passeport_path`, `nombre_copies`, `date_demande`, `statut`, `motif_refus`) VALUES
(1, 'Uzumaki', '2009-04-13', '04:25:00', 'Konoha', 'Namikazé', 'Minato', 'Hokagé', 'Uzumaki', 'Kushina', 'Ninja', NULL, NULL, 1, '2025-05-22 15:00:22', 'en attente', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
