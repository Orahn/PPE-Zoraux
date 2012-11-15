-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 15 Novembre 2012 à 11:22
-- Version du serveur: 5.1.63-0ubuntu0.11.04.1
-- Version de PHP: 5.3.5-1ubuntu7.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `zoraux`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `classe`
--

INSERT INTO `classe` (`id`, `libelle`) VALUES
(1, 'SIO'),
(2, 'Hotellerie'),
(3, 'Mode');

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `adresseRue` varchar(255) DEFAULT NULL,
  `adresseVille` varchar(255) DEFAULT NULL,
  `adresseCp` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `tiersTemps` tinyint(1) DEFAULT NULL,
  `classe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classe_id` (`classe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `adresseRue`, `adresseVille`, `adresseCp`, `mail`, `tiersTemps`, `classe_id`) VALUES
(2, 'FOUQUET', 'Julien', '36 Boulevard Arago', 'LA ROCHE SUR YON', '85000', 'julien.fouquet.85@gmail.com', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `epreuve`
--

CREATE TABLE IF NOT EXISTS `epreuve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  `dureeLibreAvant` time DEFAULT NULL,
  `dureePassage` time DEFAULT NULL,
  `dureePreparation` time DEFAULT NULL,
  `classe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classe_id` (`classe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `epreuve`
--

INSERT INTO `epreuve` (`id`, `libelle`, `dureeLibreAvant`, `dureePassage`, `dureePreparation`, `classe_id`) VALUES
(9, 'Mathématiques', '00:10:00', '00:20:00', '00:20:00', 1),
(10, 'Français', '00:10:00', '00:20:00', '00:20:00', 1),
(11, 'Test', '00:10:00', '00:00:00', '00:00:00', 2),
(13, 'E6', '00:00:10', '00:10:00', '00:10:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `jury`
--

CREATE TABLE IF NOT EXISTS `jury` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jury` int(11) DEFAULT NULL,
  `acteur_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `numJury` (`id_jury`),
  KEY `acteur_id` (`acteur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `jury`
--

INSERT INTO `jury` (`id`, `id_jury`, `acteur_id`) VALUES
(2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `eleve_id` int(1) DEFAULT NULL,
  `membreJury_id` int(1) DEFAULT NULL,
  `is_admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `eleve_id` (`eleve_id`),
  KEY `membreJury_id` (`membreJury_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `login`
--

INSERT INTO `login` (`id`, `login`, `password`, `eleve_id`, `membreJury_id`, `is_admin`) VALUES
(3, 'julien', 'julien', 2, NULL, 0),
(4, 'gallenne.e', 'gallenne.e', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `membreJury`
--

CREATE TABLE IF NOT EXISTS `membreJury` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `numTelephone` int(10) DEFAULT NULL,
  `professeur` tinyint(1) NOT NULL DEFAULT '0',
  `professionnel` tinyint(1) NOT NULL DEFAULT '0',
  `autre` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `membreJury`
--

INSERT INTO `membreJury` (`id`, `nom`, `prenom`, `mail`, `numTelephone`, `professeur`, `professionnel`, `autre`) VALUES
(2, 'GALLENNE', 'Erwan', 'erwan.gallenne@gmail.com', NULL, 1, 0, 0),
(3, 'HAURAY', 'François', NULL, NULL, 1, 0, 0),
(4, 'PAPON', 'Valérie', NULL, NULL, 0, 1, 0),
(5, 'TEST', 'Test', NULL, NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `membreJury_classe`
--

CREATE TABLE IF NOT EXISTS `membreJury_classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe_id` int(11) DEFAULT NULL,
  `membreJury_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `classe_id` (`classe_id`,`membreJury_id`),
  KEY `membreJury_id` (`membreJury_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `membreJury_classe`
--

INSERT INTO `membreJury_classe` (`id`, `classe_id`, `membreJury_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(5, 1, 4),
(3, 2, 2),
(4, 2, 4),
(6, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `membreJury_epreuve`
--

CREATE TABLE IF NOT EXISTS `membreJury_epreuve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epreuve_id` int(11) DEFAULT NULL,
  `membreJury_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`epreuve_id`,`membreJury_id`),
  KEY `membreJury_id` (`membreJury_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `membreJury_epreuve`
--

INSERT INTO `membreJury_epreuve` (`id`, `epreuve_id`, `membreJury_id`) VALUES
(11, 9, 2),
(12, 9, 3),
(3, 10, 2),
(4, 10, 3),
(16, 11, 2),
(17, 11, 3),
(19, 11, 4),
(18, 11, 5),
(20, 13, 2),
(21, 13, 3);

-- --------------------------------------------------------

--
-- Structure de la table `passage`
--

CREATE TABLE IF NOT EXISTS `passage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `heurePassage` time DEFAULT NULL,
  `eleve_id` int(11) DEFAULT NULL,
  `epreuve_id` int(11) DEFAULT NULL,
  `jury_id` int(11) DEFAULT NULL,
  `salle_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eleve_id` (`eleve_id`),
  KEY `epreuve_id` (`epreuve_id`),
  KEY `salle_id` (`salle_id`),
  KEY `jury_id` (`jury_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `passage`
--

INSERT INTO `passage` (`id`, `date`, `heurePassage`, `eleve_id`, `epreuve_id`, `jury_id`, `salle_id`) VALUES
(9, '2012-11-15', '12:00:00', 2, 9, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`id`, `libelle`) VALUES
(1, 'AS10'),
(2, 'C13');

-- --------------------------------------------------------

--
-- Structure de la table `salle_epreuve`
--

CREATE TABLE IF NOT EXISTS `salle_epreuve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epreuve_id` int(11) DEFAULT NULL,
  `salle_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`epreuve_id`,`salle_id`),
  KEY `salle_id` (`salle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `salle_epreuve`
--

INSERT INTO `salle_epreuve` (`id`, `epreuve_id`, `salle_id`) VALUES
(2, 9, 2),
(10, 10, 2),
(5, 11, 1),
(9, 13, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`);

--
-- Contraintes pour la table `epreuve`
--
ALTER TABLE `epreuve`
  ADD CONSTRAINT `epreuve_ibfk_1` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`);

--
-- Contraintes pour la table `jury`
--
ALTER TABLE `jury`
  ADD CONSTRAINT `jury_ibfk_1` FOREIGN KEY (`acteur_id`) REFERENCES `membreJury` (`id`);

--
-- Contraintes pour la table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `login_ibfk_3` FOREIGN KEY (`membreJury_id`) REFERENCES `membreJury` (`id`);

--
-- Contraintes pour la table `membreJury_classe`
--
ALTER TABLE `membreJury_classe`
  ADD CONSTRAINT `membreJury_classe_ibfk_1` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`),
  ADD CONSTRAINT `membreJury_classe_ibfk_2` FOREIGN KEY (`membreJury_id`) REFERENCES `membreJury` (`id`);

--
-- Contraintes pour la table `membreJury_epreuve`
--
ALTER TABLE `membreJury_epreuve`
  ADD CONSTRAINT `membreJury_epreuve_ibfk_1` FOREIGN KEY (`epreuve_id`) REFERENCES `epreuve` (`id`),
  ADD CONSTRAINT `membreJury_epreuve_ibfk_2` FOREIGN KEY (`epreuve_id`) REFERENCES `epreuve` (`id`);

--
-- Contraintes pour la table `passage`
--
ALTER TABLE `passage`
  ADD CONSTRAINT `passage_ibfk_1` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `passage_ibfk_2` FOREIGN KEY (`epreuve_id`) REFERENCES `epreuve` (`id`),
  ADD CONSTRAINT `passage_ibfk_3` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `passage_ibfk_4` FOREIGN KEY (`epreuve_id`) REFERENCES `epreuve` (`id`),
  ADD CONSTRAINT `passage_ibfk_5` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id`),
  ADD CONSTRAINT `passage_ibfk_6` FOREIGN KEY (`jury_id`) REFERENCES `jury` (`id`);

--
-- Contraintes pour la table `salle_epreuve`
--
ALTER TABLE `salle_epreuve`
  ADD CONSTRAINT `salle_epreuve_ibfk_2` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id`),
  ADD CONSTRAINT `salle_epreuve_ibfk_1` FOREIGN KEY (`epreuve_id`) REFERENCES `epreuve` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
