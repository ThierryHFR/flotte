-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : fdb1028.atspace.me
-- Généré le : lun. 01 mai 2023 à 09:39
-- Version du serveur : 8.0.32
-- Version de PHP : 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Structure de la table `accident`
--

CREATE TABLE `accident` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `accident`
--

INSERT INTO `accident` (`id`, `nom`) VALUES(1, 'Accident');
INSERT INTO `accident` (`id`, `nom`) VALUES(2, 'Carrosserie');
INSERT INTO `accident` (`id`, `nom`) VALUES(3, 'Voyant moteur');
INSERT INTO `accident` (`id`, `nom`) VALUES(4, 'Retroviseur');
INSERT INTO `accident` (`id`, `nom`) VALUES(5, 'Pneu');
INSERT INTO `accident` (`id`, `nom`) VALUES(6, 'Ampoule grillee');
INSERT INTO `accident` (`id`, `nom`) VALUES(7, 'Essuie glace');
INSERT INTO `accident` (`id`, `nom`) VALUES(8, 'Eclat pare-brise');
INSERT INTO `accident` (`id`, `nom`) VALUES(9, 'Hayon');
INSERT INTO `accident` (`id`, `nom`) VALUES(10, 'Froid');

-- --------------------------------------------------------

--
-- Structure de la table `incident`
--

CREATE TABLE `incident` (
  `id` int NOT NULL,
  `id_vehicule` int NOT NULL,
  `id_user` int NOT NULL,
  `id_accident` int NOT NULL,
  `incident` text NOT NULL,
  `km` int NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- --------------------------------------------------------

--
-- Structure de la table `intervention`
--

CREATE TABLE `intervention` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `intervention`
--

INSERT INTO `intervention` (`id`, `nom`) VALUES(1, 'Releve kilométrique');
INSERT INTO `intervention` (`id`, `nom`) VALUES(2, 'Controle technique');
INSERT INTO `intervention` (`id`, `nom`) VALUES(3, 'Controle pollution');
INSERT INTO `intervention` (`id`, `nom`) VALUES(4, 'Entretient');
INSERT INTO `intervention` (`id`, `nom`) VALUES(5, 'Reparation');
INSERT INTO `intervention` (`id`, `nom`) VALUES(6, 'Accident');
INSERT INTO `intervention` (`id`, `nom`) VALUES(7, 'PV');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `nom`) VALUES(1, 'Citroen');
INSERT INTO `marque` (`id`, `nom`) VALUES(2, 'Peugeot');
INSERT INTO `marque` (`id`, `nom`) VALUES(3, 'Renault');
INSERT INTO `marque` (`id`, `nom`) VALUES(4, 'Volkswagen');
INSERT INTO `marque` (`id`, `nom`) VALUES(5, 'Iveco');
INSERT INTO `marque` (`id`, `nom`) VALUES(6, 'Fiat');
INSERT INTO `marque` (`id`, `nom`) VALUES(7, 'Dacia');
INSERT INTO `marque` (`id`, `nom`) VALUES(8, 'Nissan');
INSERT INTO `marque` (`id`, `nom`) VALUES(9, 'Tesla');

-- --------------------------------------------------------

--
-- Structure de la table `model`
--

CREATE TABLE `model` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `model`
--

INSERT INTO `model` (`id`, `nom`) VALUES(1, 'C3');
INSERT INTO `model` (`id`, `nom`) VALUES(2, 'Kangoo');
INSERT INTO `model` (`id`, `nom`) VALUES(3, 'Crafter');
INSERT INTO `model` (`id`, `nom`) VALUES(4, 'Food Truck');
INSERT INTO `model` (`id`, `nom`) VALUES(5, '35C13A');
INSERT INTO `model` (`id`, `nom`) VALUES(6, 'Trafic');
INSERT INTO `model` (`id`, `nom`) VALUES(7, 'NT400');
INSERT INTO `model` (`id`, `nom`) VALUES(8, 'Lodgy');
INSERT INTO `model` (`id`, `nom`) VALUES(9, 'Doblo');
INSERT INTO `model` (`id`, `nom`) VALUES(10, 'Master');
INSERT INTO `model` (`id`, `nom`) VALUES(11, '35C15');

-- --------------------------------------------------------

--
-- Structure de la table `releve_kilometrique`
--

CREATE TABLE `releve_kilometrique` (
  `id` int NOT NULL,
  `id_vehicule` int NOT NULL,
  `km` int NOT NULL,
  `id_intervention` int NOT NULL,
  `intervention` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `facture` varchar(4096) DEFAULT NULL,
  `id_suivi` int DEFAULT '0',
  `date_suivi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL,
  `actif` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `actif`, `created_at`) VALUES(1, 'admin', '$2y$10$jG6m04LjhfUBipc81GQHVOxvI7RxoaDV9wkN11Wh2cKcTL0kA3S9.', 0, 1, '2023-04-21 11:41:45');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int NOT NULL,
  `plaque` varchar(100) NOT NULL,
  `id_marque` int NOT NULL,
  `id_model` int NOT NULL,
  `date1_immatriculation` varchar(255) NOT NULL,
  `date_cate_grise` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accident`
--
ALTER TABLE `accident`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incident_fk1` (`id_vehicule`),
  ADD KEY `incident_fk2` (`id_accident`),
  ADD KEY `incident_fk3` (`id_user`);

--
-- Index pour la table `intervention`
--
ALTER TABLE `intervention`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `releve_kilometrique`
--
ALTER TABLE `releve_kilometrique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `releve_kilometrique_fk1` (`id_vehicule`),
  ADD KEY `releve_kilometrique_fk2` (`id_intervention`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicule_fk1` (`id_model`),
  ADD KEY `vehicule_fk2` (`id_marque`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `incident_fk1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`),
  ADD CONSTRAINT `incident_fk2` FOREIGN KEY (`id_accident`) REFERENCES `accident` (`id`),
  ADD CONSTRAINT `incident_fk3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `releve_kilometrique`
--
ALTER TABLE `releve_kilometrique`
  ADD CONSTRAINT `releve_kilometrique_fk1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`),
  ADD CONSTRAINT `releve_kilometrique_fk2` FOREIGN KEY (`id_intervention`) REFERENCES `intervention` (`id`);

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `vehicule_fk1` FOREIGN KEY (`id_model`) REFERENCES `model` (`id`),
  ADD CONSTRAINT `vehicule_fk2` FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
