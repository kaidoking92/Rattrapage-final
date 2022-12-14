-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : mer. 13 juil. 2022 à 21:39
-- Version du serveur : 5.7.38
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mvcdocker2`
--

-- --------------------------------------------------------

--
-- Structure de la table `esgi_template`
--

CREATE TABLE  `esgi.template` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `color` varchar(6) NOT NULL,
    `font` varchar(255) NOT NULL,
    `background` varchar(6) NOT NULL,
    `logo` varchar(6) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `esgi_category`
--

INSERT INTO `esgi_template` (`id`, `name`, `color`, `font`, `background`, `logo`) VALUES
(1, 'default', 'black', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap', 'black', null);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `esgi_category`
--
ALTER TABLE `esgi_template`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `esgi_category`
--
ALTER TABLE `esgi_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
