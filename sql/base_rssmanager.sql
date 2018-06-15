-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 15 juin 2018 à 14:27
-- Version du serveur :  10.1.32-MariaDB
-- Version de PHP :  7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `base_rssmanager`
--

-- --------------------------------------------------------

--
-- Structure de la table `accounts`
--

CREATE TABLE `accounts` (
  `idAccount` int(11) NOT NULL,
  `pseudoAccount` varchar(60) NOT NULL,
  `emailAccount` varchar(60) NOT NULL,
  `avatarAccount` varchar(275) NOT NULL,
  `statusAccount` varchar(25) NOT NULL,
  `passAccount` varchar(255) NOT NULL,
  `warningAccount` int(60) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cerclelink`
--

CREATE TABLE `cerclelink` (
  `idCercleLink` int(11) NOT NULL,
  `nameCircle` varchar(275) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chats`
--

CREATE TABLE `chats` (
  `idChat` int(11) NOT NULL,
  `contentChat` varchar(275) NOT NULL,
  `dateChat` datetime NOT NULL,
  `idAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `idComment` int(11) NOT NULL,
  `contentComment` varchar(1000) NOT NULL,
  `dateComment` datetime NOT NULL,
  `idAccount` int(11) NOT NULL,
  `idCercleLink` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `connect`
--

CREATE TABLE `connect` (
  `idAccount` int(11) NOT NULL,
  `idCercleLink` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `deffine`
--

CREATE TABLE `deffine` (
  `idRssCategory` int(11) NOT NULL,
  `idRss` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

CREATE TABLE `invitation` (
  `idInvitation` int(11) NOT NULL,
  `contentInvitation` varchar(275) NOT NULL,
  `dateInvitation` date NOT NULL,
  `idCercleLink` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `invite`
--

CREATE TABLE `invite` (
  `idAccount` int(11) NOT NULL,
  `idInvitation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rss`
--

CREATE TABLE `rss` (
  `idRss` int(11) NOT NULL,
  `urlRss` varchar(275) NOT NULL,
  `nameRss` varchar(275) NOT NULL,
  `momentRss` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rss`
--

INSERT INTO `rss` (`idRss`, `urlRss`, `nameRss`, `momentRss`) VALUES
(6, 'https://www.cert.ssi.gouv.fr/feed/', 'ANSSI', 'Light');

-- --------------------------------------------------------

--
-- Structure de la table `rsscategories`
--

CREATE TABLE `rsscategories` (
  `idRssCategory` int(11) NOT NULL,
  `nameRssCategory` varchar(275) NOT NULL,
  `idAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`idAccount`);

--
-- Index pour la table `cerclelink`
--
ALTER TABLE `cerclelink`
  ADD PRIMARY KEY (`idCercleLink`);

--
-- Index pour la table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`idChat`),
  ADD KEY `FK_chats_idAccount` (`idAccount`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `FK_comments_idAccount` (`idAccount`),
  ADD KEY `FK_comments_idCercleLink` (`idCercleLink`);

--
-- Index pour la table `connect`
--
ALTER TABLE `connect`
  ADD PRIMARY KEY (`idAccount`,`idCercleLink`),
  ADD KEY `FK_connect_idCercleLink` (`idCercleLink`);

--
-- Index pour la table `deffine`
--
ALTER TABLE `deffine`
  ADD PRIMARY KEY (`idRssCategory`,`idRss`),
  ADD KEY `FK_deffine_idRss` (`idRss`);

--
-- Index pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`idInvitation`),
  ADD KEY `FK_invitation_idCercleLink` (`idCercleLink`);

--
-- Index pour la table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`idAccount`,`idInvitation`),
  ADD KEY `FK_invite_idInvitation` (`idInvitation`);

--
-- Index pour la table `rss`
--
ALTER TABLE `rss`
  ADD PRIMARY KEY (`idRss`);

--
-- Index pour la table `rsscategories`
--
ALTER TABLE `rsscategories`
  ADD PRIMARY KEY (`idRssCategory`),
  ADD KEY `FK_rssCategories_idAccount` (`idAccount`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `cerclelink`
--
ALTER TABLE `cerclelink`
  MODIFY `idCercleLink` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `chats`
--
ALTER TABLE `chats`
  MODIFY `idChat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `idInvitation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `rss`
--
ALTER TABLE `rss`
  MODIFY `idRss` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `rsscategories`
--
ALTER TABLE `rsscategories`
  MODIFY `idRssCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `FK_chats_idAccount` FOREIGN KEY (`idAccount`) REFERENCES `accounts` (`idAccount`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_comments_idAccount` FOREIGN KEY (`idAccount`) REFERENCES `accounts` (`idAccount`),
  ADD CONSTRAINT `FK_comments_idCercleLink` FOREIGN KEY (`idCercleLink`) REFERENCES `cerclelink` (`idCercleLink`);

--
-- Contraintes pour la table `connect`
--
ALTER TABLE `connect`
  ADD CONSTRAINT `FK_connect_idAccount` FOREIGN KEY (`idAccount`) REFERENCES `accounts` (`idAccount`),
  ADD CONSTRAINT `FK_connect_idCercleLink` FOREIGN KEY (`idCercleLink`) REFERENCES `cerclelink` (`idCercleLink`);

--
-- Contraintes pour la table `deffine`
--
ALTER TABLE `deffine`
  ADD CONSTRAINT `FK_deffine_idRss` FOREIGN KEY (`idRss`) REFERENCES `rss` (`idRss`),
  ADD CONSTRAINT `FK_deffine_idRssCategory` FOREIGN KEY (`idRssCategory`) REFERENCES `rsscategories` (`idRssCategory`);

--
-- Contraintes pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD CONSTRAINT `FK_invitation_idCercleLink` FOREIGN KEY (`idCercleLink`) REFERENCES `cerclelink` (`idCercleLink`);

--
-- Contraintes pour la table `invite`
--
ALTER TABLE `invite`
  ADD CONSTRAINT `FK_invite_idAccount` FOREIGN KEY (`idAccount`) REFERENCES `accounts` (`idAccount`),
  ADD CONSTRAINT `FK_invite_idInvitation` FOREIGN KEY (`idInvitation`) REFERENCES `invitation` (`idInvitation`);

--
-- Contraintes pour la table `rsscategories`
--
ALTER TABLE `rsscategories`
  ADD CONSTRAINT `FK_rssCategories_idAccount` FOREIGN KEY (`idAccount`) REFERENCES `accounts` (`idAccount`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
