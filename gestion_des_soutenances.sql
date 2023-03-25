-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 25 mars 2023 à 07:55
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_des_soutenances`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `matricule` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenoms` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `niveau` enum('L1','L2','L3','M1','M2') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parcours` enum('GB','SR','IG') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adr_email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`matricule`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `matricule`, `nom`, `prenoms`, `niveau`, `parcours`, `adr_email`) VALUES
(2, '2669', 'FENO', 'grgdsgrwrgfgsrg', 'L3', 'GB', 'wewew@gmail.com'),
(7, '655', 'Charles ', 'dfdfsef', 'L3', 'SR', 'wewew@gmail.com'),
(4, '6666', 'bvfg', 'nsvdsg', 'L2', 'IG', 'gfdsgrg@gmail.com'),
(8, 'jd', 'bvfg', 'carlie', 'L1', 'IG', 'rabe@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `organisme`
--

DROP TABLE IF EXISTS `organisme`;
CREATE TABLE IF NOT EXISTS `organisme` (
  `idorg` int NOT NULL AUTO_INCREMENT,
  `design` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lieu` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idorg`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `organisme`
--

INSERT INTO `organisme` (`idorg`, `design`, `lieu`) VALUES
(5, 'ENI', 'Tanambao');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `idprof` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenoms` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `civilite` enum('Mr','Mlle','Mme') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `grade` enum('Professeur titulaire','Maître de Conférences','Assistant d’Enseignement Supérieur et de Recherche','Docteur HDR','Docteur en Informatique','Doctorant en informatique') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idprof`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`idprof`, `nom`, `prenoms`, `civilite`, `grade`) VALUES
(5, 'FENO', 'dfdfsef', 'Mr', 'Maître de Conférences'),
(6, 'Charles ', 'grgdsgrwrgfgsrg', 'Mlle', 'Assistant d’Enseignement Supérieur et de Recherche'),
(7, 'bako', 'dfdfsef', 'Mme', 'Docteur HDR');

-- --------------------------------------------------------

--
-- Structure de la table `soutenir`
--

DROP TABLE IF EXISTS `soutenir`;
CREATE TABLE IF NOT EXISTS `soutenir` (
  `id` int NOT NULL AUTO_INCREMENT,
  `matricule` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `idorg` int NOT NULL,
  `annee_univ` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `note` int DEFAULT NULL,
  `president` int DEFAULT NULL,
  `examinateur` int DEFAULT NULL,
  `rapporteur_int` int DEFAULT NULL,
  `rapporteur_ext` varchar(175) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `matricule` (`matricule`),
  KEY `idorg` (`idorg`),
  KEY `president` (`president`),
  KEY `examinateur` (`examinateur`),
  KEY `rapporteur_int` (`rapporteur_int`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déclencheurs `soutenir`
--
DROP TRIGGER IF EXISTS `soutenance_tg_update`;
DELIMITER $$
CREATE TRIGGER `soutenance_tg_update` BEFORE UPDATE ON `soutenir` FOR EACH ROW BEGIN
  DECLARE examinateur varchar(155);
  DECLARE president varchar(155);
  DECLARE rapporteur varchar(155);
    
    DECLARE ex_civ varchar(5);
    DECLARE ex_nom varchar(50);
    DECLARE ex_prenoms varchar(100);
    
    DECLARE rap_civ varchar(5);
    DECLARE rap_nom varchar(50);
    DECLARE rap_prenoms varchar(100);
    
    
    DECLARE pdt_civ varchar(5);
    DECLARE pdt_nom varchar(50);
    DECLARE pdt_prenoms varchar(100);
    
    SELECT civilite INTO ex_civ FROM professeur where idprof=New.examinateur;
    SELECT Nom INTO ex_nom FROM professeur where idprof=New.examinateur;
    SELECT prenoms INTO ex_prenoms FROM professeur where idprof=New.examinateur;
    
    SELECT civilite INTO rap_civ FROM professeur where idprof=New.rapporteur_int;
    SELECT Nom INTO rap_nom FROM professeur where idprof=New.rapporteur_int;
    SELECT prenoms INTO rap_prenoms FROM professeur where idprof=New.rapporteur_int;
    
    SELECT civilite INTO pdt_civ FROM professeur where idprof=New.president;
    SELECT Nom INTO pdt_nom FROM professeur where  idprof=New.president;
    SELECT prenoms INTO pdt_prenoms FROM professeur where  idprof=New.president;
    
    
    SET examinateur = set_name_fc(ex_civ, ex_nom, ex_prenoms);
    SET president = set_name_fc(pdt_civ, pdt_nom, pdt_prenoms);
    SET rapporteur = set_name_fc(rap_civ, rap_nom, rap_prenoms);
   
    SET New.nom_examinateur= examinateur;
    SET New.nom_president= president;
    SET New.nom_rap_int = rapporteur;
END
$$
DELIMITER ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `soutenir`
--
ALTER TABLE `soutenir`
  ADD CONSTRAINT `soutenir_ibfk_1` FOREIGN KEY (`matricule`) REFERENCES `etudiant` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `soutenir_ibfk_2` FOREIGN KEY (`idorg`) REFERENCES `organisme` (`idorg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `soutenir_ibfk_3` FOREIGN KEY (`president`) REFERENCES `professeur` (`idprof`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `soutenir_ibfk_4` FOREIGN KEY (`examinateur`) REFERENCES `professeur` (`idprof`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `soutenir_ibfk_5` FOREIGN KEY (`rapporteur_int`) REFERENCES `professeur` (`idprof`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
