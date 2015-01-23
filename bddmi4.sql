-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 23 Janvier 2015 à 19:15
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bddmi4`
--

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id_document` int(255) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id_document`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `document_mot`
--

CREATE TABLE IF NOT EXISTS `document_mot` (
  `id_document` int(255) NOT NULL,
  `id_mot` int(255) NOT NULL,
  `poids` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mot`
--

CREATE TABLE IF NOT EXISTS `mot` (
  `id_mot` int(255) NOT NULL AUTO_INCREMENT,
  `mot` varchar(30) NOT NULL,
  PRIMARY KEY (`id_mot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `mots-vides`
--

CREATE TABLE IF NOT EXISTS `mots-vides` (
  `id_mot` int(11) NOT NULL AUTO_INCREMENT,
  `mot_vide` varchar(255) NOT NULL,
  PRIMARY KEY (`id_mot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
