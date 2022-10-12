-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 12 oct. 2022 à 08:39
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `signature`
--

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

DROP TABLE IF EXISTS `employes`;
CREATE TABLE IF NOT EXISTS `employes` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `fonction` varchar(150) NOT NULL,
  `ld` varchar(12) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `cp` int(5) NOT NULL,
  `site` varchar(150) NOT NULL,
  `employe` int(11) NOT NULL,
  `signature` varchar(8) NOT NULL,
  `logo` varchar(1000) NOT NULL,
  `rs` varchar(55) NOT NULL,
  `ide` varchar(200) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nom`, `adresse`, `tel`, `ville`, `cp`, `site`, `employe`, `signature`, `logo`, `rs`, `ide`, `mdp`) VALUES
(1, 'Cactus', '101 rue des cailles', '512456522', 'Ruelisheim', 68530, 'www.kio.fr', 3, 'haut', '2021_11_22_Vamp7052.png', '', '', ''),
(2, 'Mussimys', '101 rue des cailles', '512456522', 'Ruelisheim', 68530, 'www.kio.fr', 3, 'haut', 'SW nos crÃ©a.JPG', '', 'mussimys.signature-cactus.fr', 'nxFk4EJeI2TcegNG0eEq'),
(3, 'Mussimys', '101 rue des cailles', '512456522', 'Ruelisheim', 68530, 'www.kio.fr', 3, 'haut', 'SW nos crÃ©a.JPG', '', 'mussimys.signature-cactus.fr', 'nxFk4EJeI2TcegNG0eEq');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
