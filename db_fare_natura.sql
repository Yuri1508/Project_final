-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 10 sep. 2021 à 22:05
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_fare_natura`
--

-- --------------------------------------------------------

--
-- Structure de la table `tab_shop`
--

CREATE TABLE `tab_shop` (
  `id` int(11) NOT NULL,
  `name_product` text NOT NULL,
  `description_product` text NOT NULL,
  `price_product` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tab_shop`
--

INSERT INTO `tab_shop` (`id`, `name_product`, `description_product`, `price_product`) VALUES
(67, 'Talons', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, consectetur ducimus recusandae commodi reiciendis modi officiis ipsam quis nam neque pariatur, dolorum provident similique, eius suscipit consequatur porro iure ad.', '6000 xpf'),
(69, 'Rangrers', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, consectetur ducimus recusandae commodi reiciendis modi officiis ipsam quis nam neque pariatur, dolorum provident similique, eius suscipit consequatur porro iure ad.', '10000 xpf'),
(70, 'Tennis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, consectetur ducimus recusandae commodi reiciendis modi officiis ipsam quis nam neque pariatur, dolorum provident similique, eius suscipit consequatur porro iure ad.', '5000 xpf'),
(71, 'Chausure', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, consectetur ducimus recusandae commodi reiciendis modi officiis ipsam quis nam neque pariatur, dolorum provident similique, eius suscipit consequatur porro iure ad.', '2000 xpf'),
(72, 'Pantalon', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, consectetur ducimus recusandae commodi reiciendis modi officiis ipsam quis nam neque pariatur, dolorum provident similique, eius suscipit consequatur porro iure ad.', '4000 xpf');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tab_shop`
--
ALTER TABLE `tab_shop`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tab_shop`
--
ALTER TABLE `tab_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
