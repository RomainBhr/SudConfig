-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 02 mars 2021 à 00:11
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sudconfig`
--

-- --------------------------------------------------------

--
-- Structure de la table `actionarticle`
--

DROP TABLE IF EXISTS `actionarticle`;
CREATE TABLE IF NOT EXISTS `actionarticle` (
  `idAction` int NOT NULL AUTO_INCREMENT,
  `idArticles` int NOT NULL,
  `text` text NOT NULL,
  `positif` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAction`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `actionarticle`
--

INSERT INTO `actionarticle` (`idAction`, `idArticles`, `text`, `positif`) VALUES
(1, 1, 'Nous montons ta machine', 0),
(2, 1, 'On lui fait subir une série de tests', 0),
(3, 1, 'Mais aucun système d\'exploitation n\'est installé', 1),
(4, 2, 'Nous montons ton pc', 0),
(5, 2, 'On lui fait subir une série de tests', 0),
(6, 2, 'On installe le système d\'exploitation de ton choix ', 0),
(7, 2, 'Le PC arrive chez toi, tu n\'as plus qu\'à le brancher et à le démarrer, il est prêt !', 0),
(8, 3, 'Nous montons ta machine', 0),
(9, 3, 'On lui fait subir une série de tests', 0),
(10, 3, 'On installe le système d\'exploitation de ton choix', 0),
(11, 3, 'On installe les derniers drivers pour ta config ', 0),
(12, 3, 'On te personnalise ta tours avec un ou plusieurs stickers de ton choix et on t\'ajoute un peu de RGB', 0),
(13, 3, 'Le PC arrive chez toi, tu n\'as plus qu\'à le brancher et à le démarrer, il est prêt et optimisé', 0);

-- --------------------------------------------------------

--
-- Structure de la table `articlecategorie`
--

DROP TABLE IF EXISTS `articlecategorie`;
CREATE TABLE IF NOT EXISTS `articlecategorie` (
  `idCat` int NOT NULL,
  `libelleCat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idCat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articlecategorie`
--

INSERT INTO `articlecategorie` (`idCat`, `libelleCat`) VALUES
(1, 'Montage'),
(2, 'WaterCooling'),
(3, 'Custom ton clavier'),
(4, 'Site Web');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `idArticle` int NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `dateDePublication` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `prix` decimal(15,2) DEFAULT NULL,
  `recommander` int DEFAULT NULL,
  `idCat` int NOT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `idCat` (`idCat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`idArticle`, `libelle`, `dateDePublication`, `Description`, `prix`, `recommander`, `idCat`) VALUES
(1, 'Basic', '17/02/2021', 'description test', '20.00', 0, 1),
(2, 'Standar', '11/02/2021', 'test', '30.00', 1, 1),
(3, 'XXL', '18/02/2021', 'La c\'est du lourd', '49.00', 0, 1),
(4, 'Premium', '18/02/2021', 'La c\'est du lourd mon pote', '89.99', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `clavier`
--

DROP TABLE IF EXISTS `clavier`;
CREATE TABLE IF NOT EXISTS `clavier` (
  `idClavier` int NOT NULL AUTO_INCREMENT,
  `libelleClavier` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `prix` decimal(11,0) NOT NULL,
  `recommander` int NOT NULL DEFAULT '0',
  `idCat` int NOT NULL DEFAULT '3',
  PRIMARY KEY (`idClavier`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clavier`
--

INSERT INTO `clavier` (`idClavier`, `libelleClavier`, `description`, `prix`, `recommander`, `idCat`) VALUES
(1, '100%', 'clavier de taille normal', '10', 0, 3),
(2, '60%', 'Le clavier est plus petit de 40% qu\'un clavier normal', '12', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `commandeclavier`
--

DROP TABLE IF EXISTS `commandeclavier`;
CREATE TABLE IF NOT EXISTS `commandeclavier` (
  `idCommande` int NOT NULL AUTO_INCREMENT,
  `materiaux` varchar(255) DEFAULT NULL,
  `idUti` int NOT NULL,
  `idClavier` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idCommande`),
  KEY `idUti` (`idUti`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandeclavier`
--

INSERT INTO `commandeclavier` (`idCommande`, `materiaux`, `idUti`, `idClavier`) VALUES
(1, 'bois', 1, 1),
(15, NULL, 11, 2),
(14, NULL, 11, 1),
(11, NULL, 11, 1),
(12, NULL, 4, 1),
(13, NULL, 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `idCommentaire` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `note` int NOT NULL DEFAULT '0',
  `idArticles` int NOT NULL,
  `idUser` int NOT NULL,
  PRIMARY KEY (`idCommentaire`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`idCommentaire`, `titre`, `text`, `note`, `idArticles`, `idUser`) VALUES
(1, 'Super ! ', 'Et quia Mesopotamiae tractus omnes crebro inquietari sueti praetenturis et stationibus servabantur agrariis, laevorsum flexo itinere Osdroenae subsederat extimas partes, novum parumque aliquando temptatum commentum adgressus. quod si impetrasset, fulminis', 5, 1, 1),
(2, 'Bof', 'lol', 3, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contenu_panier`
--

DROP TABLE IF EXISTS `contenu_panier`;
CREATE TABLE IF NOT EXISTS `contenu_panier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_panier` int NOT NULL,
  `articles_id` int NOT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_contenu_panier_articles1_idx` (`articles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contenu_panier`
--

INSERT INTO `contenu_panier` (`id`, `id_panier`, `articles_id`, `quantite`) VALUES
(11, 2, 1, 5),
(12, 2, 2, 10),
(13, 2, 1, 1),
(14, 2, 1, 1),
(15, 2, 1, 1),
(16, 2, 1, 1),
(17, 2, 1, 1),
(18, 2, 1, 1),
(19, 2, 1, 1),
(20, 2, 1, 1),
(21, 2, 1, 1),
(22, 2, 1, 1),
(23, 2, 1, 1),
(24, 2, 1, 1),
(25, 2, 1, 1),
(28, 11, 1, 1),
(29, 4, 1, 1),
(30, 11, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `idCouleur` int NOT NULL,
  `libelleCouleur` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idCouleur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `IdImage` int NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `idArtic` int NOT NULL,
  PRIMARY KEY (`IdImage`),
  KEY `idArticle` (`idArtic`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`IdImage`, `url`, `nom`, `idArtic`) VALUES
(1, '1.jpg', 'test', 1),
(2, '3.jpg', 'test', 1),
(3, '2.jpg', 'test', 2);

-- --------------------------------------------------------

--
-- Structure de la table `membrepermission`
--

DROP TABLE IF EXISTS `membrepermission`;
CREATE TABLE IF NOT EXISTS `membrepermission` (
  `idPerm` int NOT NULL,
  `permission` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idPerm`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membrepermission`
--

INSERT INTO `membrepermission` (`idPerm`, `permission`) VALUES
(1, 'Utilisateur'),
(2, 'Modérateur'),
(99921, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference` char(100) NOT NULL DEFAULT 'client',
  `dateCreation` varchar(255) NOT NULL,
  `statut` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `reference`, `dateCreation`, `statut`) VALUES
(1, '', '2021-01-15 18:17:51', 1),
(2, 'client', '2021-01-25 23:43:15', 0),
(3, 'client', 'test', 0),
(4, 'client', '2021-02-25 00:41:31', 0),
(11, 'client', '2021-02-25 00:44:02', 0),
(12, 'client', '2021-03-01 14:16:48', 0);

-- --------------------------------------------------------

--
-- Structure de la table `personnalisation`
--

DROP TABLE IF EXISTS `personnalisation`;
CREATE TABLE IF NOT EXISTS `personnalisation` (
  `idTouches` int NOT NULL,
  `idCommande` int NOT NULL,
  `couleurperso` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`idTouches`,`idCommande`),
  KEY `idCommande` (`idCommande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `personnalisation`
--

INSERT INTO `personnalisation` (`idTouches`, `idCommande`, `couleurperso`) VALUES
(1, 1, 'black'),
(2, 1, 'white'),
(100, 6, '#000'),
(101, 6, '#00C5FF'),
(102, 6, '#000'),
(103, 6, '#000'),
(104, 6, '#000'),
(105, 6, '#000'),
(106, 6, '#000'),
(107, 6, '#000'),
(108, 6, '#000'),
(109, 6, '#000'),
(110, 6, '#000'),
(111, 6, '#000'),
(112, 6, '#000'),
(113, 6, '#000'),
(114, 6, '#000'),
(115, 6, '#000'),
(116, 6, '#000'),
(117, 6, '#000'),
(118, 6, '#000'),
(119, 6, '#000'),
(120, 6, '#000'),
(121, 6, '#000'),
(122, 6, '#000'),
(123, 6, '#000'),
(124, 6, '#000'),
(125, 6, '#000'),
(126, 6, '#000'),
(127, 6, '#000'),
(128, 6, '#000'),
(129, 6, '#000'),
(130, 6, '#000'),
(131, 6, '#000'),
(132, 6, '#000'),
(133, 6, '#000'),
(134, 6, '#000'),
(135, 6, '#000'),
(136, 6, '#000'),
(137, 6, '#000'),
(138, 6, '#000'),
(139, 6, '#000'),
(140, 6, '#000'),
(141, 6, '#000'),
(142, 6, '#000'),
(143, 6, '#000'),
(144, 6, '#000'),
(145, 6, '#000'),
(146, 6, '#000'),
(147, 6, '#000'),
(148, 6, '#000'),
(149, 6, '#000'),
(150, 6, '#000'),
(151, 6, '#000'),
(152, 6, '#000'),
(153, 6, '#000'),
(154, 6, '#000'),
(155, 6, '#000'),
(156, 6, '#000'),
(157, 6, '#000'),
(158, 6, '#000'),
(159, 6, '#000'),
(160, 6, '#000'),
(161, 6, '#000'),
(162, 6, '#000'),
(163, 6, '#000'),
(164, 6, '#000'),
(165, 6, '#000'),
(166, 6, '#000'),
(167, 6, '#000'),
(168, 6, '#000'),
(169, 6, '#00C5FF'),
(170, 6, '#00C5FF'),
(171, 6, '#000'),
(172, 6, '#000'),
(173, 6, '#000'),
(174, 6, '#000'),
(175, 6, '#000'),
(176, 6, '#000'),
(177, 6, '#000'),
(178, 6, '#000'),
(100, 7, '#000'),
(101, 7, '#00C5FF'),
(102, 7, '#000'),
(103, 7, '#000'),
(104, 7, '#000'),
(105, 7, '#000'),
(106, 7, '#000'),
(107, 7, '#000'),
(108, 7, '#000'),
(109, 7, '#000'),
(110, 7, '#000'),
(111, 7, '#000'),
(112, 7, '#000'),
(113, 7, '#000'),
(114, 7, '#000'),
(115, 7, '#000'),
(116, 7, '#000'),
(117, 7, '#000'),
(118, 7, '#000'),
(119, 7, '#000'),
(120, 7, '#000'),
(121, 7, '#000'),
(122, 7, '#000'),
(123, 7, '#000'),
(124, 7, '#000'),
(125, 7, '#000'),
(126, 7, '#000'),
(127, 7, '#000'),
(128, 7, '#000'),
(129, 7, '#000'),
(130, 7, '#000'),
(131, 7, '#000'),
(132, 7, '#000'),
(133, 7, '#000'),
(134, 7, '#000'),
(135, 7, '#000'),
(136, 7, '#000'),
(137, 7, '#000'),
(138, 7, '#000'),
(139, 7, '#000'),
(140, 7, '#000'),
(141, 7, '#000'),
(142, 7, '#000'),
(143, 7, '#000'),
(144, 7, '#000'),
(145, 7, '#000'),
(146, 7, '#000'),
(147, 7, '#000'),
(148, 7, '#000'),
(149, 7, '#000'),
(150, 7, '#000'),
(151, 7, '#000'),
(152, 7, '#000'),
(153, 7, '#000'),
(154, 7, '#000'),
(155, 7, '#000'),
(156, 7, '#000'),
(157, 7, '#000'),
(158, 7, '#000'),
(159, 7, '#000'),
(160, 7, '#000'),
(161, 7, '#000'),
(162, 7, '#000'),
(163, 7, '#000'),
(164, 7, '#000'),
(165, 7, '#000'),
(166, 7, '#000'),
(167, 7, '#000'),
(168, 7, '#000'),
(169, 7, '#00C5FF'),
(170, 7, '#00C5FF'),
(171, 7, '#000'),
(172, 7, '#000'),
(173, 7, '#000'),
(174, 7, '#000'),
(175, 7, '#000'),
(176, 7, '#000'),
(177, 7, '#000'),
(178, 7, '#000'),
(100, 8, '#000'),
(101, 8, '#00C5FF'),
(102, 8, '#000'),
(103, 8, '#000'),
(104, 8, '#000'),
(105, 8, '#000'),
(106, 8, '#000'),
(107, 8, '#000'),
(108, 8, '#000'),
(109, 8, '#000'),
(110, 8, '#000'),
(111, 8, '#000'),
(112, 8, '#000'),
(113, 8, '#000'),
(114, 8, '#000'),
(115, 8, '#000'),
(116, 8, '#000'),
(117, 8, '#000'),
(118, 8, '#000'),
(119, 8, '#000'),
(120, 8, '#000'),
(121, 8, '#000'),
(122, 8, '#000'),
(123, 8, '#000'),
(124, 8, '#000'),
(125, 8, '#000'),
(126, 8, '#000'),
(127, 8, '#000'),
(128, 8, '#000'),
(129, 8, '#000'),
(130, 8, '#000'),
(131, 8, '#000'),
(132, 8, '#000'),
(133, 8, '#000'),
(134, 8, '#000'),
(135, 8, '#000'),
(136, 8, '#000'),
(137, 8, '#000'),
(138, 8, '#000'),
(139, 8, '#000'),
(140, 8, '#000'),
(141, 8, '#000'),
(142, 8, '#000'),
(143, 8, '#000'),
(144, 8, '#000'),
(145, 8, '#000'),
(146, 8, '#000'),
(147, 8, '#000'),
(148, 8, '#000'),
(149, 8, '#000'),
(150, 8, '#000'),
(151, 8, '#000'),
(152, 8, '#000'),
(153, 8, '#000'),
(154, 8, '#000'),
(155, 8, '#000'),
(156, 8, '#000'),
(157, 8, '#000'),
(158, 8, '#000'),
(159, 8, '#000'),
(160, 8, '#000'),
(161, 8, '#000'),
(162, 8, '#000'),
(163, 8, '#000'),
(164, 8, '#000'),
(165, 8, '#000'),
(166, 8, '#000'),
(167, 8, '#000'),
(168, 8, '#000'),
(169, 8, '#00C5FF'),
(170, 8, '#00C5FF'),
(171, 8, '#000'),
(172, 8, '#000'),
(173, 8, '#000'),
(174, 8, '#000'),
(175, 8, '#000'),
(176, 8, '#000'),
(177, 8, '#000'),
(178, 8, '#000'),
(100, 9, '#000'),
(101, 9, '#00C5FF'),
(102, 9, '#000'),
(103, 9, '#000'),
(104, 9, '#000'),
(105, 9, '#000'),
(106, 9, '#000'),
(107, 9, '#000'),
(108, 9, '#000'),
(109, 9, '#000'),
(110, 9, '#000'),
(111, 9, '#000'),
(112, 9, '#000'),
(113, 9, '#000'),
(114, 9, '#000'),
(115, 9, '#000'),
(116, 9, '#000'),
(117, 9, '#000'),
(118, 9, '#000'),
(119, 9, '#000'),
(120, 9, '#000'),
(121, 9, '#000'),
(122, 9, '#000'),
(123, 9, '#000'),
(124, 9, '#000'),
(125, 9, '#000'),
(126, 9, '#000'),
(127, 9, '#000'),
(128, 9, '#000'),
(129, 9, '#000'),
(130, 9, '#000'),
(131, 9, '#000'),
(132, 9, '#000'),
(133, 9, '#000'),
(134, 9, '#000'),
(135, 9, '#000'),
(136, 9, '#000'),
(137, 9, '#000'),
(138, 9, '#000'),
(139, 9, '#000'),
(140, 9, '#000'),
(141, 9, '#000'),
(142, 9, '#000'),
(143, 9, '#000'),
(144, 9, '#000'),
(145, 9, '#000'),
(146, 9, '#000'),
(147, 9, '#000'),
(148, 9, '#000'),
(149, 9, '#000'),
(150, 9, '#000'),
(151, 9, '#000'),
(152, 9, '#000'),
(153, 9, '#000'),
(154, 9, '#000'),
(155, 9, '#000'),
(156, 9, '#000'),
(157, 9, '#000'),
(158, 9, '#000'),
(159, 9, '#000'),
(160, 9, '#000'),
(161, 9, '#000'),
(162, 9, '#000'),
(163, 9, '#000'),
(164, 9, '#000'),
(165, 9, '#000'),
(166, 9, '#000'),
(167, 9, '#000'),
(168, 9, '#000'),
(169, 9, '#00C5FF'),
(170, 9, '#00C5FF'),
(171, 9, '#000'),
(172, 9, '#000'),
(173, 9, '#000'),
(174, 9, '#000'),
(175, 9, '#000'),
(176, 9, '#000'),
(177, 9, '#000'),
(178, 9, '#000'),
(100, 10, '#000'),
(101, 10, '#00C5FF'),
(102, 10, '#000'),
(103, 10, '#000'),
(104, 10, '#000'),
(105, 10, '#000'),
(106, 10, '#000'),
(107, 10, '#000'),
(108, 10, '#000'),
(109, 10, '#000'),
(110, 10, '#000'),
(111, 10, '#000'),
(112, 10, '#000'),
(113, 10, '#000'),
(114, 10, '#000'),
(115, 10, '#000'),
(116, 10, '#000'),
(117, 10, '#000'),
(118, 10, '#000'),
(119, 10, '#000'),
(120, 10, '#000'),
(121, 10, '#000'),
(122, 10, '#000'),
(123, 10, '#000'),
(124, 10, '#000'),
(125, 10, '#000'),
(126, 10, '#000'),
(127, 10, '#000'),
(128, 10, '#000'),
(129, 10, '#000'),
(130, 10, '#000'),
(131, 10, '#000'),
(132, 10, '#000'),
(133, 10, '#000'),
(134, 10, '#000'),
(135, 10, '#000'),
(136, 10, '#000'),
(137, 10, '#000'),
(138, 10, '#000'),
(139, 10, '#000'),
(140, 10, '#000'),
(141, 10, '#000'),
(142, 10, '#000'),
(143, 10, '#000'),
(144, 10, '#000'),
(145, 10, '#000'),
(146, 10, '#000'),
(147, 10, '#000'),
(148, 10, '#000'),
(149, 10, '#000'),
(150, 10, '#000'),
(151, 10, '#000'),
(152, 10, '#000'),
(153, 10, '#000'),
(154, 10, '#000'),
(155, 10, '#000'),
(156, 10, '#000'),
(157, 10, '#000'),
(158, 10, '#000'),
(159, 10, '#000'),
(160, 10, '#000'),
(161, 10, '#000'),
(162, 10, '#000'),
(163, 10, '#000'),
(164, 10, '#000'),
(165, 10, '#000'),
(166, 10, '#000'),
(167, 10, '#000'),
(168, 10, '#000'),
(169, 10, '#00C5FF'),
(170, 10, '#00C5FF'),
(171, 10, '#000'),
(172, 10, '#000'),
(173, 10, '#000'),
(174, 10, '#000'),
(175, 10, '#000'),
(176, 10, '#000'),
(177, 10, '#000'),
(178, 10, '#000'),
(100, 11, NULL),
(101, 11, '#00C5FF'),
(102, 11, NULL),
(103, 11, NULL),
(104, 11, NULL),
(105, 11, NULL),
(106, 11, '#042756'),
(107, 11, NULL),
(108, 11, NULL),
(109, 11, NULL),
(110, 11, NULL),
(111, 11, NULL),
(112, 11, NULL),
(113, 11, NULL),
(114, 11, NULL),
(115, 11, NULL),
(116, 11, NULL),
(117, 11, NULL),
(118, 11, NULL),
(119, 11, NULL),
(120, 11, NULL),
(121, 11, NULL),
(122, 11, NULL),
(123, 11, NULL),
(124, 11, NULL),
(125, 11, NULL),
(126, 11, NULL),
(127, 11, NULL),
(128, 11, NULL),
(129, 11, NULL),
(130, 11, NULL),
(131, 11, NULL),
(132, 11, NULL),
(133, 11, NULL),
(134, 11, NULL),
(135, 11, NULL),
(136, 11, NULL),
(137, 11, NULL),
(138, 11, NULL),
(139, 11, NULL),
(140, 11, NULL),
(141, 11, NULL),
(142, 11, NULL),
(143, 11, NULL),
(144, 11, NULL),
(145, 11, NULL),
(146, 11, NULL),
(147, 11, NULL),
(148, 11, NULL),
(149, 11, NULL),
(150, 11, NULL),
(151, 11, NULL),
(152, 11, NULL),
(153, 11, NULL),
(154, 11, NULL),
(155, 11, NULL),
(156, 11, NULL),
(157, 11, NULL),
(158, 11, NULL),
(159, 11, NULL),
(160, 11, NULL),
(161, 11, NULL),
(162, 11, NULL),
(163, 11, NULL),
(164, 11, NULL),
(165, 11, NULL),
(166, 11, NULL),
(167, 11, NULL),
(168, 11, NULL),
(169, 11, '#00C5FF'),
(170, 11, '#00C5FF'),
(171, 11, NULL),
(172, 11, NULL),
(173, 11, NULL),
(174, 11, NULL),
(175, 11, NULL),
(176, 11, '#177E07'),
(177, 11, NULL),
(178, 11, NULL),
(100, 12, '#000'),
(101, 12, '#00C5FF'),
(102, 12, '#000'),
(103, 12, '#000'),
(104, 12, '#000'),
(105, 12, '#000'),
(106, 12, '#000'),
(107, 12, '#000'),
(108, 12, '#000'),
(109, 12, '#000'),
(110, 12, '#000'),
(111, 12, '#000'),
(112, 12, '#000'),
(113, 12, '#000'),
(114, 12, '#000'),
(115, 12, '#000'),
(116, 12, '#000'),
(117, 12, '#000'),
(118, 12, '#000'),
(119, 12, '#000'),
(120, 12, '#000'),
(121, 12, '#000'),
(122, 12, '#000'),
(123, 12, '#000'),
(124, 12, '#000'),
(125, 12, '#000'),
(126, 12, '#000'),
(127, 12, '#000'),
(128, 12, '#000'),
(129, 12, '#000'),
(130, 12, '#000'),
(131, 12, '#000'),
(132, 12, '#000'),
(133, 12, '#000'),
(134, 12, '#000'),
(135, 12, '#000'),
(136, 12, '#000'),
(137, 12, '#000'),
(138, 12, '#000'),
(139, 12, '#000'),
(140, 12, '#000'),
(141, 12, '#000'),
(142, 12, '#000'),
(143, 12, '#000'),
(144, 12, '#000'),
(145, 12, '#000'),
(146, 12, '#000'),
(147, 12, '#000'),
(148, 12, '#000'),
(149, 12, '#000'),
(150, 12, '#000'),
(151, 12, '#000'),
(152, 12, '#000'),
(153, 12, '#000'),
(154, 12, '#000'),
(155, 12, '#000'),
(156, 12, '#000'),
(157, 12, '#000'),
(158, 12, '#000'),
(159, 12, '#000'),
(160, 12, '#000'),
(161, 12, '#000'),
(162, 12, '#000'),
(163, 12, '#000'),
(164, 12, '#000'),
(165, 12, '#000'),
(166, 12, '#000'),
(167, 12, '#000'),
(168, 12, '#000'),
(169, 12, '#00C5FF'),
(170, 12, '#00C5FF'),
(171, 12, '#000'),
(172, 12, '#000'),
(173, 12, '#000'),
(174, 12, '#000'),
(175, 12, '#000'),
(176, 12, '#000'),
(177, 12, '#000'),
(178, 12, '#000'),
(100, 13, '#000'),
(101, 13, '#00C5FF'),
(102, 13, '#000'),
(103, 13, '#000'),
(104, 13, '#000'),
(105, 13, '#000'),
(106, 13, '#17FF00'),
(107, 13, '#000'),
(108, 13, '#FF0000'),
(109, 13, '#000'),
(110, 13, '#00C5FF'),
(111, 13, '#000'),
(112, 13, '#00C5FF'),
(113, 13, '#000'),
(114, 13, '#000'),
(115, 13, '#000'),
(116, 13, '#000'),
(117, 13, '#FF0000'),
(118, 13, '#FF0000'),
(119, 13, '#000'),
(120, 13, '#000'),
(121, 13, '#000'),
(122, 13, '#000'),
(123, 13, '#000'),
(124, 13, '#042756'),
(125, 13, '#000'),
(126, 13, '#000'),
(127, 13, '#000'),
(128, 13, '#000'),
(129, 13, '#000'),
(130, 13, '#000'),
(131, 13, '#000'),
(132, 13, '#000'),
(133, 13, '#00C5FF'),
(134, 13, '#000'),
(135, 13, '#000'),
(136, 13, '#00C5FF'),
(137, 13, '#000'),
(138, 13, '#000'),
(139, 13, '#000'),
(140, 13, '#000'),
(141, 13, '#000'),
(142, 13, '#000'),
(143, 13, '#000'),
(144, 13, '#000'),
(145, 13, '#000'),
(146, 13, '#000'),
(147, 13, '#000'),
(148, 13, '#000'),
(149, 13, '#000'),
(150, 13, '#000'),
(151, 13, '#000'),
(152, 13, '#000'),
(153, 13, '#000'),
(154, 13, '#000'),
(155, 13, '#000'),
(156, 13, '#000'),
(157, 13, '#000'),
(158, 13, '#000'),
(159, 13, '#000'),
(160, 13, '#000'),
(161, 13, '#000'),
(162, 13, '#000'),
(163, 13, '#000'),
(164, 13, '#000'),
(165, 13, '#000'),
(166, 13, '#000'),
(167, 13, '#000'),
(168, 13, '#000'),
(169, 13, '#00C5FF'),
(170, 13, '#00C5FF'),
(171, 13, '#000'),
(172, 13, '#000'),
(173, 13, '#000'),
(174, 13, '#000'),
(175, 13, '#000'),
(176, 13, '#000'),
(177, 13, '#000'),
(178, 13, '#000');

-- --------------------------------------------------------

--
-- Structure de la table `stockdisponibiliter`
--

DROP TABLE IF EXISTS `stockdisponibiliter`;
CREATE TABLE IF NOT EXISTS `stockdisponibiliter` (
  `idStock` int NOT NULL,
  `nbStock` int DEFAULT NULL,
  `idArticle` int NOT NULL,
  PRIMARY KEY (`idStock`),
  KEY `idArticle` (`idArticle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stockdisponibiliter`
--

INSERT INTO `stockdisponibiliter` (`idStock`, `nbStock`, `idArticle`) VALUES
(1, 1, 1),
(2, 0, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `touche`
--

DROP TABLE IF EXISTS `touche`;
CREATE TABLE IF NOT EXISTS `touche` (
  `idTouche` int NOT NULL AUTO_INCREMENT,
  `libelleTou` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `couleur` varchar(255) NOT NULL DEFAULT '#000',
  `txtcouleur` varchar(255) NOT NULL DEFAULT '#fff',
  `idClavier` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTouche`),
  KEY `idClavier` (`idClavier`)
) ENGINE=MyISAM AUTO_INCREMENT=179 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `touche`
--

INSERT INTO `touche` (`idTouche`, `libelleTou`, `couleur`, `txtcouleur`, `idClavier`) VALUES
(100, 'echap', '#000', '#fff', 1),
(101, 'f1', '#000', '#fff', 1),
(102, 'f2', '#000', '#fff', 1),
(103, 'f3', '#000', '#fff', 1),
(104, 'f4', '#000', '#fff', 1),
(105, 'f5', '#000', '#fff', 1),
(106, 'f6', '#000', '#fff', 1),
(107, 'f7', '#000', '#fff', 1),
(108, 'f8', '#000', '#fff', 1),
(109, 'f9', '#000', '#fff', 1),
(110, 'f10', '#000', '#fff', 1),
(111, 'f11', '#000', '#fff', 1),
(112, 'f12', '#000', '#fff', 1),
(113, '²', '#000', '#fff', 1),
(114, '1', '#000', '#fff', 1),
(115, '2', '#000', '#fff', 1),
(116, '3', '#000', '#fff', 1),
(117, '4', '#000', '#fff', 1),
(118, '5', '#000', '#fff', 1),
(119, '6', '#000', '#fff', 1),
(120, '7', '#000', '#fff', 1),
(121, '8', '#000', '#fff', 1),
(122, '9', '#000', '#fff', 1),
(123, '0', '#000', '#fff', 1),
(124, ')', '#000', '#fff', 1),
(125, '=', '#000', '#fff', 1),
(126, 'tab', '#000', '#fff', 1),
(127, 'a', '#000', '#fff', 1),
(128, 'z', '#000', '#fff', 1),
(129, 'e', '#000', '#fff', 1),
(130, 'r', '#000', '#fff', 1),
(131, 't', '#000', '#fff', 1),
(132, 'y', '#000', '#fff', 1),
(133, 'u', '#000', '#fff', 1),
(134, 'i', '#000', '#fff', 1),
(135, 'o', '#000', '#fff', 1),
(136, 'p', '#000', '#fff', 1),
(137, '^', '#000', '#fff', 1),
(138, '$', '#000', '#fff', 1),
(139, 'entrée', '#000', '#fff', 1),
(140, 'maj', '#000', '#fff', 1),
(141, 'q', '#000', '#fff', 1),
(142, 's', '#000', '#fff', 1),
(143, 'd', '#000', '#fff', 1),
(144, 'f', '#000', '#fff', 1),
(145, 'g', '#000', '#fff', 1),
(146, 'h', '#000', '#fff', 1),
(147, 'j', '#000', '#fff', 1),
(148, 'k', '#000', '#fff', 1),
(149, 'l', '#000', '#fff', 1),
(150, 'm', '#000', '#fff', 1),
(151, 'ù', '#000', '#fff', 1),
(152, '*', '#000', '#fff', 1),
(153, '▲', '#000', '#fff', 1),
(154, '<>', '#000', '#fff', 1),
(155, 'w', '#000', '#fff', 1),
(156, 'x', '#000', '#fff', 1),
(157, 'c', '#000', '#fff', 1),
(158, 'v', '#000', '#fff', 1),
(159, 'b', '#000', '#fff', 1),
(160, 'n', '#000', '#fff', 1),
(161, '?', '#000', '#fff', 1),
(162, ';', '#000', '#fff', 1),
(163, ':', '#000', '#fff', 1),
(164, '!', '#000', '#fff', 1),
(165, '▼', '#000', '#fff', 1),
(166, 'ctrl1', '#000', '#fff', 1),
(167, 'win', '#000', '#fff', 1),
(168, 'alt1', '#000', '#fff', 1),
(169, 'space', '#000', '#fff', 1),
(170, 'altgr', '#000', '#fff', 1),
(171, 'autre', '#000', '#fff', 1),
(172, 'fn', '#000', '#fff', 1),
(173, 'ctrl2', '#000', '#fff', 1),
(174, '↑', '#000', '#fff', 1),
(175, '←', '#000', '#fff', 1),
(176, '↓', '#000', '#fff', 1),
(177, '→', '#000', '#fff', 1),
(178, 'supp', '#000', '#fff', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUti` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) DEFAULT NULL,
  `pseudo` varchar(255) NOT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `DateNaiss` varchar(255) DEFAULT NULL,
  `Tel` int DEFAULT NULL,
  `Mail` varchar(255) DEFAULT NULL,
  `Ville` varchar(255) DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `pays` varchar(255) NOT NULL,
  `Codepostal` int DEFAULT NULL,
  `ComplementAdresse` varchar(255) DEFAULT NULL,
  `Civilite` varchar(255) DEFAULT NULL,
  `DateInscription` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) NOT NULL,
  `idPerm` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idUti`),
  KEY `idPerm` (`idPerm`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUti`, `Nom`, `pseudo`, `Prenom`, `DateNaiss`, `Tel`, `Mail`, `Ville`, `Adresse`, `pays`, `Codepostal`, `ComplementAdresse`, `Civilite`, `DateInscription`, `pwd`, `idPerm`) VALUES
(1, 'Michelle', 'MichelleL\'alaphaTesteur', 'Test', '21/06/2001', 6, 'ouais', 'azadadz', 'azdazd', '', 26, 'zadazda', 'alien', '21/02/2001', '1', 1),
(2, 'Boehler', 'Admin', 'romain', '2001-06-21', 643636187, 'romrom210601@gmail.com', 'Avignon', 'ahah', 'France', 84000, 'ahah', 'homme', '2021-02-25 00:06:24', '$2y$10$W6rMwdWZxZpnUp7G7nwc0ejzdz3D0SmIddPmbCGymn9nLih6MIsrG', 0),
(3, 'test', 'test', 'test', '2001-06-21', 0, 'test@test.test', 'test', 'test', 'test', 0, 'test', 'homme', '2021-02-25 00:08:30', '$2y$10$VOwFVsiAuXr5iCg2XJcZvOTzCt3Mmwu0KRCBBX9BELZzR3lMmxoqq', 0),
(4, 'bebe', 'bebe', 'bebe', '2001-06-21', 780348786, 'Audrey@Audrey.Audrey', 'Avignon', 'ahah', 'France', 84000, 'ahah', 'homme', '2021-02-25 00:41:31', '$2y$10$/FPBZS/8XqqPO4.uRyQoSenuJC00iroSbiupgvPSw8WjXqtSV.0iS', 0),
(5, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', 1),
(6, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', 1),
(7, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', 1),
(8, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', 1),
(9, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', 1),
(10, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', 1),
(11, 'uti', 'uti', 'uti', '2001-06-21', 0, 'uti@uti.uti', 'uti', 'uti', 'uti', 0, 'uti', 'homme', '2021-02-25 00:44:02', '$2y$10$kHYySrbs/NxKhDsBeCbM5OlqLyWkc/gKrE5r4MZUPO5UjLQTKkj2C', 1),
(12, 'rrrrrrr', 'Rrrrr', 'rrrrrrrr', '2021-12-31', 6, 'rrrrrr@rr.com', 'rrrrrr', 'rrrrrrrr', 'rrrrr', 6, 'rrrrrrrr', 'homme', '2021-03-01 14:16:48', '$2y$10$pTtx/4qPV.ax79EClUiaP.Ej0j3/xSutetLqvrXuwK1KTkHaJCNVy', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
