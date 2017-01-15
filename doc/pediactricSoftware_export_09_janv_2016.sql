-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 09 Janvier 2017 à 21:31
-- Version du serveur :  5.7.16-0ubuntu0.16.04.1
-- Version de PHP :  7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pediactricSoftware`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `homePhone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homeFullAddress` longtext COLLATE utf8_unicode_ci NOT NULL,
  `homeSlugAdress` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ps_father`
--

CREATE TABLE `ps_father` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` datetime DEFAULT NULL,
  `personal_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ps_father`
--

INSERT INTO `ps_father` (`id`, `name`, `surname`, `sex`, `birthday`, `personal_phone`, `comment`) VALUES
(1, 'father1', NULL, 'male', '1901-04-14 00:00:00', NULL, NULL),
(2, 'father1', NULL, 'male', NULL, NULL, NULL),
(3, 'test', 'qte', 'male', '1995-02-15 00:00:00', NULL, NULL),
(4, 'Pere 0', 'Prenom Pere 0', 'male', '1985-06-28 00:00:00', '154896', 'commentaire père 0');

-- --------------------------------------------------------

--
-- Structure de la table `ps_mother`
--

CREATE TABLE `ps_mother` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` datetime DEFAULT NULL,
  `personal_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ps_mother`
--

INSERT INTO `ps_mother` (`id`, `name`, `surname`, `sex`, `birthday`, `personal_phone`, `comment`) VALUES
(1, 'test', NULL, 'female', NULL, NULL, NULL),
(2, 'mother1', NULL, 'female', NULL, NULL, NULL),
(3, 'Mère189', NULL, 'female', NULL, NULL, NULL),
(4, 'test', 'qte', 'female', NULL, NULL, NULL),
(5, 'mother15', NULL, 'female', NULL, NULL, NULL),
(6, 'mother17', NULL, 'female', NULL, NULL, NULL),
(7, 'Mère18', NULL, 'female', NULL, NULL, NULL),
(8, 'Mère20', NULL, 'female', NULL, NULL, NULL),
(9, 'Mère191', NULL, 'female', NULL, NULL, NULL),
(10, 'Mère192', NULL, 'female', NULL, NULL, NULL),
(11, 'Mère193', NULL, 'female', NULL, NULL, NULL),
(12, 'mother194', NULL, 'female', NULL, NULL, NULL),
(13, 'mother195', NULL, 'female', NULL, NULL, NULL),
(14, 'mere200', NULL, 'female', NULL, NULL, NULL),
(15, 'mere201', NULL, 'female', NULL, NULL, NULL),
(16, 'mere202', NULL, 'female', NULL, NULL, NULL),
(17, 'mere219', NULL, 'female', NULL, NULL, NULL),
(18, 'mere203', NULL, 'female', NULL, NULL, NULL),
(19, 'mother300titi', NULL, 'female', NULL, NULL, NULL),
(20, 'mere260', NULL, 'female', NULL, NULL, NULL),
(21, 'mother300titi30', NULL, 'female', NULL, NULL, NULL),
(22, 'mother300titi300', NULL, 'female', NULL, NULL, NULL),
(25, 'Mere303', NULL, 'female', NULL, NULL, NULL),
(26, 'maman1', NULL, 'female', NULL, NULL, NULL),
(27, 'Mere0', 'Prenom Mere0', 'female', '1980-08-14 00:00:00', '0425698965', 'commentaire mère 0');

-- --------------------------------------------------------

--
-- Structure de la table `ps_patient`
--

CREATE TABLE `ps_patient` (
  `id` int(11) NOT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `father_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` datetime DEFAULT NULL,
  `personal_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_siblings` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personal_diseases_history` longtext COLLATE utf8_unicode_ci,
  `family_diseases_history` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ps_patient`
--

INSERT INTO `ps_patient` (`id`, `mother_id`, `father_id`, `name`, `surname`, `sex`, `birthday`, `personal_phone`, `comment`, `code_siblings`, `personal_diseases_history`, `family_diseases_history`) VALUES
(1, 5, 1, 'test', 'qte', 'female', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 2, 'Patient1', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, NULL, 'patient2', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, NULL, 'test', 'qte', 'male', '1911-02-17 00:00:00', NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, 'test', 'qte', 'male', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, NULL, 'test', 'qte', 'female', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 3, NULL, 'Patient14', 'prenom P14', 'male', '2012-02-16 00:00:00', NULL, NULL, NULL, NULL, NULL),
(8, 5, NULL, 'Patient15', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 3, NULL, 'Patient16', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 6, NULL, 'Patient17', NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, NULL, 'qdfq', NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 7, NULL, 'Patient18', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 7, NULL, 'Patient19', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 8, NULL, 'Patient20', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 3, 3, 'qdfe', 'qdfeqef', 'female', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 3, NULL, 'patient05janv2017', NULL, 'female', '2017-01-05 00:00:00', NULL, NULL, NULL, NULL, NULL),
(17, 7, NULL, 'eq vrdqdf', 'qerezr', 'female', '2017-01-04 00:00:00', NULL, NULL, NULL, NULL, NULL),
(18, 4, NULL, 'qfeqc', 'dqfqe', 'male', '2017-04-03 00:00:00', NULL, NULL, NULL, NULL, NULL),
(19, 5, NULL, 'eq', 'qdfqfe', 'female', '2017-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL),
(20, 3, NULL, 'qdfe', 'qdfqe', 'male', '2016-04-14 00:00:00', NULL, NULL, NULL, NULL, NULL),
(21, 25, NULL, 'Patient548', NULL, 'female', '2017-01-06 00:00:00', NULL, NULL, NULL, NULL, NULL),
(22, 3, NULL, 'Patient87', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 26, NULL, 'Patient88', NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 27, 4, 'patient0', 'prenom patient0', 'female', '2010-10-12 00:00:00', NULL, 'commentaire patient 0', '2MOE21', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ps_tutor`
--

CREATE TABLE `ps_tutor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` datetime DEFAULT NULL,
  `personal_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ps_user`
--

CREATE TABLE `ps_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ps_user`
--

INSERT INTO `ps_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'fafa', 'fafa', 'fafadji.gnofame@gmail.com', 'fafadji.gnofame@gmail.com', 1, 'qbAnyIGRKsNxFEWqil4Q68hBHRtjuZuQu645vcg2GjA', 'oM/7Gpk/qJm/R5xisrcue2HbUUE9QLxc5ixnRw2pp3PLHJhpgk/gGNMm4kbcV2v5iVsMad9sbMGEFBPcSpnf/w==', '2016-12-26 17:24:40', NULL, NULL, 'a:0:{}');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D4E6F8178957160` (`homeSlugAdress`);

--
-- Index pour la table `ps_father`
--
ALTER TABLE `ps_father`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ps_mother`
--
ALTER TABLE `ps_mother`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ps_patient`
--
ALTER TABLE `ps_patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D75DFB01B78A354D` (`mother_id`),
  ADD KEY `IDX_D75DFB012055B9A2` (`father_id`);

--
-- Index pour la table `ps_tutor`
--
ALTER TABLE `ps_tutor`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ps_user`
--
ALTER TABLE `ps_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_EA26217592FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_EA262175A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_EA262175C05FB297` (`confirmation_token`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ps_father`
--
ALTER TABLE `ps_father`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `ps_mother`
--
ALTER TABLE `ps_mother`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `ps_patient`
--
ALTER TABLE `ps_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `ps_tutor`
--
ALTER TABLE `ps_tutor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ps_user`
--
ALTER TABLE `ps_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ps_patient`
--
ALTER TABLE `ps_patient`
  ADD CONSTRAINT `FK_D75DFB012055B9A2` FOREIGN KEY (`father_id`) REFERENCES `ps_father` (`id`),
  ADD CONSTRAINT `FK_D75DFB01B78A354D` FOREIGN KEY (`mother_id`) REFERENCES `ps_mother` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
