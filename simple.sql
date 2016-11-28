-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 26 Août 2015 à 03:08
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `simple`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(25) NOT NULL,
  `sujet` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `users_id` int(11) NOT NULL,
  `file` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `email`, `tel`, `sujet`, `message`, `users_id`, `file`, `created_at`) VALUES
(1, 'momo', 'fake', 'abrat@gmail.com', '0201050807', 'j''ai un probleme', 'Je voudrais vous faire imaginer que le truc est vraiment ', 1, '', '0000-00-00 00:00:00'),
(2, 'BA', 'MOUHAMED', 'moktarba@hotmail.fr', '0781032929', 'bonjour', 'sxcvvksqldcsfv,fl', 1, '', '2015-08-07 04:26:37');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `titre` varchar(45) NOT NULL,
  `contenu` text NOT NULL,
  `afficher` tinyint(11) NOT NULL DEFAULT '0',
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `menu`
--

INSERT INTO `menu` (`id`, `nom`, `titre`, `contenu`, `afficher`, `users_id`) VALUES
(1, 'accueil', 'titre de accueil', 'contenu accueil', 1, 1),
(2, 'magie', 'titre magie', 'contenu magie', 0, 1),
(3, 'voyance', 'titre voyance', 'contenu voyance', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `temoignages`
--

CREATE TABLE IF NOT EXISTS `temoignages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `created_at` datetime NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Contenu de la table `temoignages`
--

INSERT INTO `temoignages` (`id`, `pseudo`, `email`, `contenu`, `created_at`, `users_id`) VALUES
(48, 'moktar', 'moktarba@hotmail.fr', 'je veux il est trop drop', '2015-08-03 03:21:05', 1),
(49, 'abratkom', 'moktarba@hotmail.fr', 'je n\\''ai rien dit', '2015-08-26 03:02:10', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(25) NOT NULL,
  `intro` text NOT NULL,
  `rue` varchar(200) NOT NULL,
  `cp` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `pays` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `musique` varchar(1000) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `token` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `titre1` varchar(45) NOT NULL,
  `titre2` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `tel`, `intro`, `rue`, `cp`, `ville`, `pays`, `password`, `created_at`, `updated_at`, `avatar`, `musique`, `active`, `token`, `last_login`, `nom`, `prenom`, `titre1`, `titre2`) VALUES
(1, 'Tima', 'tima@tima.fr', '0602030405', 'reerrtrzt', 'rue amoul faye', '37000', 'tours', 'france', '6948fda2a4eba67de4c013c25cce73953dcc1707', '2015-08-02 01:58:45', '2015-08-07 07:13:44', 'UPLOADe9af4a3ee0c35cd0eea73cf5b9bfdd8f.jpg', '', 1, '', '2015-08-26 03:01:41', 'titre de voyance', 'voyance', 'marabout voyant', 'puissance et détermination');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
