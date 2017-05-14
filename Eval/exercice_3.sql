-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mer 10 Mai 2017 à 16:59
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `exercice_3`
--

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id_movie` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `actors` varchar(20) NOT NULL,
  `director` varchar(20) NOT NULL,
  `producer` varchar(20) NOT NULL,
  `year_of_prod` year(4) NOT NULL,
  `language` varchar(20) NOT NULL,
  `category` enum('rated','nonrated') NOT NULL,
  `storyline` text NOT NULL,
  `video` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `movies`
--

INSERT INTO `movies` (`id_movie`, `title`, `actors`, `director`, `producer`, `year_of_prod`, `language`, `category`, `storyline`, `video`) VALUES
(1, 'ppppppp', 'yyyyyyy', 'ppppppp', 'uuuuuuuu', 2017, 'fr', 'rated', 'ppppppp', 'http://www.economist.com/'),
(2, 'kkkkkkk', 'yyyyyyyyy', 'llllllll', 'eeeeeeeeee', 2011, 'dr', 'nonrated', 'yyyyyyy', 'http://www.economist.com/'),
(3, 'pppppp', 'llllllll', 'iiiiiiiii', 'yyyyyyyyy', 2006, 'rus', 'nonrated', 'uuuuuuuuu', 'http://www.economist.com/');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_movie`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_movie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;