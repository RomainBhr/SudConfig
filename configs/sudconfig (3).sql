-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 28 fév. 2021 à 23:16
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
  PRIMARY KEY (`idCommande`),
  KEY `idUti` (`idUti`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandeclavier`
--

INSERT INTO `commandeclavier` (`idCommande`, `materiaux`, `idUti`) VALUES
(1, 'bois', 1),
(2, NULL, 11),
(3, NULL, 11),
(4, NULL, 11),
(5, NULL, 11),
(6, NULL, 11),
(7, NULL, 11),
(8, NULL, 11);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `reference`, `dateCreation`, `statut`) VALUES
(1, '', '2021-01-15 18:17:51', 1),
(2, 'client', '2021-01-25 23:43:15', 0),
(3, 'client', 'test', 0),
(4, 'client', '2021-02-25 00:41:31', 0),
(11, 'client', '2021-02-25 00:44:02', 0);

-- --------------------------------------------------------

--
-- Structure de la table `personnalisation`
--

DROP TABLE IF EXISTS `personnalisation`;
CREATE TABLE IF NOT EXISTS `personnalisation` (
  `idTouche` int NOT NULL,
  `idCommande` int NOT NULL,
  `couleur` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idTouche`,`idCommande`),
  KEY `idCommande` (`idCommande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `personnalisation`
--

INSERT INTO `personnalisation` (`idTouche`, `idCommande`, `couleur`) VALUES
(1, 1, 'black'),
(2, 1, 'white'),
(100, 6, '#000'),
(101, 6, '#000'),
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
(169, 6, '#000'),
(170, 6, '#000'),
(171, 6, '#000'),
(172, 6, '#000'),
(173, 6, '#000'),
(174, 6, '#000'),
(175, 6, '#000'),
(176, 6, '#000'),
(177, 6, '#000'),
(178, 6, '#000'),
(100, 7, '#000'),
(101, 7, '#000'),
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
(169, 7, '#000'),
(170, 7, '#000'),
(171, 7, '#000'),
(172, 7, '#000'),
(173, 7, '#000'),
(174, 7, '#000'),
(175, 7, '#000'),
(176, 7, '#000'),
(177, 7, '#000'),
(178, 7, '#000'),
(100, 8, '#000'),
(101, 8, '#000'),
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
(169, 8, '#000'),
(170, 8, '#000'),
(171, 8, '#000'),
(172, 8, '#000'),
(173, 8, '#000'),
(174, 8, '#000'),
(175, 8, '#000'),
(176, 8, '#000'),
(177, 8, '#000'),
(178, 8, '#000');

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

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
(11, 'uti', 'uti', 'uti', '2001-06-21', 0, 'uti@uti.uti', 'uti', 'uti', 'uti', 0, 'uti', 'homme', '2021-02-25 00:44:02', '$2y$10$kHYySrbs/NxKhDsBeCbM5OlqLyWkc/gKrE5r4MZUPO5UjLQTKkj2C', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
