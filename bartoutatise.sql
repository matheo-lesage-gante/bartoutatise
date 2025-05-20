-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2025 at 02:46 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bartoutatise`
--

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `Id_avis` int(10) NOT NULL,
  `Id_profil` int(5) NOT NULL,
  `Nom_bar` varchar(64) NOT NULL,
  `note` int(1) NOT NULL,
  `avis` varchar(255) NOT NULL,
  `date_avis` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`Id_avis`, `Id_profil`, `Nom_bar`, `note`, `avis`, `date_avis`) VALUES
(1, 4, 'PDD', 5, 'Ambiance incroyable !', '2025-05-19 08:59:57'),
(2, 4, 'Dernier Bar avant la Fin du Monde', 4, 'Une ambiance top pour tous les fans de pop culture. La déco est incroyable, les cocktails et planches nickels et le service super agréable. Des jeux sont à disposition pour accompagner votre verre et passer encore un meilleur moment entre amis.', '2025-05-09 11:01:28'),
(3, 3, 'SPEAKEASY', 5, 'Pas mal mais peut mieux faire.', '2023-05-19 00:00:00'),
(4, 6, 'ZEBULAN', 5, 'Ambiance moyenne mais bons prix.', '2023-11-01 00:00:00'),
(5, 3, 'BASE CAMP', 3, 'Le service était rapide et efficace.', '2024-02-03 00:00:00'),
(6, 4, 'LE PRIVILEGE', 5, 'Pas mal mais peut mieux faire.', '2024-01-16 00:00:00'),
(7, 4, 'CAFE OZ', 4, 'Pas mal mais peut mieux faire.', '2024-06-15 00:00:00'),
(8, 5, 'SPEAKEASY', 5, 'Super ambiance et personnel très sympa.', '2023-04-12 00:00:00'),
(9, 4, 'L ESPRIT CHUPITOS', 3, 'Pas mal mais peut mieux faire.', '2024-05-27 00:00:00'),
(10, 5, 'BARBEROUSSE', 3, 'Lieu agréable pour sortir entre amis.', '2025-03-02 00:00:00'),
(11, 2, 'CANTINA', 5, 'Top pour un afterwork !', '2024-04-21 00:00:00'),
(12, 3, 'MAGNUM', 3, 'Super ambiance et personnel très sympa.', '2023-06-02 00:00:00'),
(13, 6, 'SPEAKEASY', 5, 'Bonne musique mais un peu trop de monde.', '2024-09-10 00:00:00'),
(14, 4, 'TCHA TCHA', 4, 'Une bonne adresse, j’y reviendrai.', '2023-10-01 00:00:00'),
(15, 2, 'LE MADRE', 3, 'Bonne musique mais un peu trop de monde.', '2024-03-24 00:00:00'),
(16, 2, 'BASE CAMP', 5, 'Top pour un afterwork !', '2023-04-22 00:00:00'),
(17, 5, 'LE CARTEL', 3, 'Une bonne adresse, j’y reviendrai.', '2024-01-26 00:00:00'),
(18, 4, 'LE PRIVILEGE', 4, 'Le service était rapide et efficace.', '2025-05-19 00:00:00'),
(19, 7, 'L IRLANDAIS', 4, 'Le service était rapide et efficace.', '2024-05-27 00:00:00'),
(20, 6, 'L IRLANDAIS', 4, 'Pas mal mais peut mieux faire.', '2024-07-01 00:00:00'),
(21, 6, 'LE KOLOR BAR', 5, 'Une bonne adresse, j’y reviendrai.', '2023-06-28 00:00:00'),
(22, 7, 'LE FRIDGE', 5, 'Une bonne adresse, j’y reviendrai.', '2024-09-16 00:00:00'),
(23, 4, 'ZEBULAN', 4, 'Les cocktails sont excellents, je recommande !', '2024-07-30 00:00:00'),
(24, 7, 'O QAUI', 3, 'J’ai adoré la déco et les boissons.', '2023-03-27 00:00:00'),
(25, 3, 'L IRLANDAIS', 5, 'Ambiance moyenne mais bons prix.', '2023-09-08 00:00:00'),
(26, 3, 'KOKALAN', 5, 'J’ai adoré la déco et les boissons.', '2025-01-15 00:00:00'),
(27, 6, 'BARBEROUSSE', 4, 'Super ambiance et personnel très sympa.', '2024-04-30 00:00:00'),
(28, 1, 'SPEAKEASY', 4, 'Bonne musique mais un peu trop de monde.', '2023-08-21 00:00:00'),
(29, 7, 'ZEBULAN', 5, 'Ambiance moyenne mais bons prix.', '2024-02-25 00:00:00'),
(30, 6, 'L IRLANDAIS', 5, 'Pas mal mais peut mieux faire.', '2024-07-02 00:00:00'),
(31, 1, 'LE FRIDGE', 5, 'Super ambiance et personnel très sympa.', '2024-04-02 00:00:00'),
(32, 2, 'CANTINA', 4, 'Ambiance moyenne mais bons prix.', '2023-05-20 00:00:00'),
(33, 1, 'CAFE OZ', 4, 'Le service était rapide et efficace.', '2024-07-24 00:00:00'),
(34, 7, 'LA PLANQUE', 3, 'Le service était rapide et efficace.', '2023-07-07 00:00:00'),
(35, 7, 'LE KOLOR BAR', 5, 'Bonne musique mais un peu trop de monde.', '2024-03-07 00:00:00'),
(36, 3, 'BERNADETTE', 4, 'Ambiance moyenne mais bons prix.', '2023-08-02 00:00:00'),
(37, 7, 'TCHA TCHA', 3, 'Les cocktails sont excellents, je recommande !', '2024-06-07 00:00:00'),
(38, 3, 'LE CARTEL', 5, 'Bonne musique mais un peu trop de monde.', '2024-09-08 00:00:00'),
(39, 5, 'CAFE OZ', 4, 'Ambiance moyenne mais bons prix.', '2024-06-08 00:00:00'),
(40, 4, 'BASE CAMP', 3, 'Une bonne adresse, j’y reviendrai.', '2023-01-09 00:00:00'),
(41, 5, 'LE KOLOR BAR', 3, 'Super ambiance et personnel très sympa.', '2024-02-01 00:00:00'),
(42, 7, 'LA PLAGE', 3, 'J’ai adoré la déco et les boissons.', '2024-08-01 00:00:00'),
(43, 2, 'KOKALAN', 5, 'Bonne musique mais un peu trop de monde.', '2023-08-23 00:00:00'),
(44, 6, 'BERNADETTE', 3, 'Super ambiance et personnel très sympa.', '2024-05-07 00:00:00'),
(45, 4, 'L IRLANDAIS', 3, 'Le service était rapide et efficace.', '2024-04-30 00:00:00'),
(46, 2, 'LE FRIDGE', 4, 'Le service était rapide et efficace.', '2024-12-21 00:00:00'),
(47, 1, 'LE FRIDGE', 5, 'Une bonne adresse, j’y reviendrai.', '2023-12-27 00:00:00'),
(48, 3, 'CANTINA', 5, 'Le service était rapide et efficace.', '2024-12-12 00:00:00'),
(49, 2, 'BISTROT DE LA REINE', 5, 'Pas mal mais peut mieux faire.', '2023-04-07 00:00:00'),
(50, 3, 'LE MADRE', 3, 'Lieu agréable pour sortir entre amis.', '2024-07-11 00:00:00'),
(51, 7, 'L IRLANDAIS', 3, 'Lieu agréable pour sortir entre amis.', '2023-10-22 00:00:00'),
(52, 1, 'LE BISTROT DE ST SO', 3, 'Pas mal mais peut mieux faire.', '2024-12-02 00:00:00'),
(53, 5, 'PHARMACIE BAR', 4, 'Le service était rapide et efficace.', '2024-08-08 00:00:00'),
(54, 2, 'LA PLANQUE', 4, 'Les cocktails sont excellents, je recommande !', '2024-03-14 00:00:00'),
(55, 3, 'TCHA TCHA', 3, 'Les cocktails sont excellents, je recommande !', '2024-03-13 00:00:00'),
(56, 2, 'ZEBULAN', 5, 'Top pour un afterwork !', '2024-06-20 00:00:00'),
(57, 7, 'LA PLANQUE', 5, 'Ambiance moyenne mais bons prix.', '2024-07-17 00:00:00'),
(58, 3, 'SPEAKEASY', 3, 'Bonne musique mais un peu trop de monde.', '2023-07-20 00:00:00'),
(59, 7, 'L ESPRIT CHUPITOS', 5, 'Bonne musique mais un peu trop de monde.', '2023-11-14 00:00:00'),
(60, 2, 'LOBBY', 5, 'Pas mal mais peut mieux faire.', '2024-04-20 00:00:00'),
(61, 3, 'BISTROT DE LA REINE', 4, 'J’ai adoré la déco et les boissons.', '2024-12-13 00:00:00'),
(62, 2, 'BASE CAMP', 5, 'Ambiance moyenne mais bons prix.', '2023-08-18 00:00:00'),
(63, 3, 'LOBBY', 4, 'Bonne musique mais un peu trop de monde.', '2025-01-19 00:00:00'),
(64, 5, 'BERNADETTE', 5, 'Une bonne adresse, j’y reviendrai.', '2023-04-27 00:00:00'),
(65, 6, 'LE PRIVILEGE', 3, 'Pas mal mais peut mieux faire.', '2025-03-28 00:00:00'),
(66, 1, 'LE PRIVILEGE', 5, 'Lieu agréable pour sortir entre amis.', '2024-01-02 00:00:00'),
(67, 5, 'LE FRIDGE', 4, 'Une bonne adresse, j’y reviendrai.', '2023-03-26 00:00:00'),
(68, 6, 'CANTINA', 5, 'Les cocktails sont excellents, je recommande !', '2025-03-30 00:00:00'),
(69, 6, 'CANTINA', 3, 'Pas mal mais peut mieux faire.', '2024-12-03 00:00:00'),
(70, 2, 'CAFE OZ', 3, 'Bonne musique mais un peu trop de monde.', '2023-09-04 00:00:00'),
(71, 4, 'LE FRIDGE', 4, 'Une bonne adresse, j’y reviendrai.', '2023-10-26 00:00:00'),
(72, 1, 'L ESPRIT CHUPITOS', 3, 'Une bonne adresse, j’y reviendrai.', '2024-12-11 00:00:00'),
(73, 4, 'LA BASE ARRIERE', 3, 'Pas mal mais peut mieux faire.', '2024-11-28 00:00:00'),
(74, 2, 'MAGNUM', 3, 'Lieu agréable pour sortir entre amis.', '2024-03-25 00:00:00'),
(75, 4, 'O QAUI', 4, 'Le service était rapide et efficace.', '2023-02-12 00:00:00'),
(76, 7, 'SPEAKEASY', 4, 'Top pour un afterwork !', '2024-10-26 00:00:00'),
(77, 5, 'LE MADRE', 3, 'Super ambiance et personnel très sympa.', '2024-07-28 00:00:00'),
(78, 1, 'LOBBY', 3, 'Bonne musique mais un peu trop de monde.', '2023-09-21 00:00:00'),
(79, 7, 'TCHA TCHA', 5, 'Super ambiance et personnel très sympa.', '2024-07-11 00:00:00'),
(80, 4, 'LE KOLOR BAR', 4, 'Ambiance moyenne mais bons prix.', '2023-12-04 00:00:00'),
(81, 3, 'CANTINA', 4, 'Bonne musique mais un peu trop de monde.', '2024-04-16 00:00:00'),
(82, 4, 'BISTROT DE LA REINE', 4, 'Le service était rapide et efficace.', '2024-02-05 00:00:00'),
(83, 7, 'PHARMACIE BAR', 3, 'Super ambiance et personnel très sympa.', '2025-05-20 00:00:00'),
(84, 7, 'LOBBY', 5, 'Les cocktails sont excellents, je recommande !', '2023-09-20 00:00:00'),
(85, 4, 'TCHA TCHA', 4, 'Bonne musique mais un peu trop de monde.', '2024-03-03 00:00:00'),
(86, 3, 'BISTROT DE LA REINE', 4, 'Une bonne adresse, j’y reviendrai.', '2025-05-14 00:00:00'),
(87, 3, 'LE CARTEL', 5, 'Le service était rapide et efficace.', '2024-12-07 00:00:00'),
(88, 3, 'LE KOLOR BAR', 5, 'Pas mal mais peut mieux faire.', '2025-01-27 00:00:00'),
(89, 7, 'BASE CAMP', 4, 'Pas mal mais peut mieux faire.', '2024-10-25 00:00:00'),
(90, 1, 'TCHA TCHA', 4, 'Super ambiance et personnel très sympa.', '2024-03-08 00:00:00'),
(91, 4, 'LE MADRE', 5, 'Une bonne adresse, j’y reviendrai.', '2024-11-09 00:00:00'),
(92, 1, 'BARBEROUSSE', 5, 'Super ambiance et personnel très sympa.', '2023-07-18 00:00:00'),
(93, 4, 'L ESPRIT CHUPITOS', 4, 'Top pour un afterwork !', '2024-05-08 00:00:00'),
(94, 4, 'LA BASE ARRIERE', 3, 'Pas mal mais peut mieux faire.', '2023-09-23 00:00:00'),
(95, 4, 'BERNADETTE', 5, 'Bonne musique mais un peu trop de monde.', '2023-11-10 00:00:00'),
(96, 4, 'ZEBULAN', 4, 'Pas mal mais peut mieux faire.', '2024-11-22 00:00:00'),
(97, 6, 'BASE CAMP', 4, 'Bonne musique mais un peu trop de monde.', '2023-08-19 00:00:00'),
(98, 3, 'BISTROT DE LA REINE', 3, 'J’ai adoré la déco et les boissons.', '2025-02-02 00:00:00'),
(99, 6, 'LE PRIVILEGE', 4, 'Lieu agréable pour sortir entre amis.', '2023-02-12 00:00:00'),
(100, 3, 'LOBBY', 4, 'Une bonne adresse, j’y reviendrai.', '2025-03-18 00:00:00'),
(101, 3, 'LE KOLOR BAR', 5, 'Les cocktails sont excellents, je recommande !', '2024-10-22 00:00:00'),
(102, 3, 'BARBEROUSSE', 3, 'Le service était rapide et efficace.', '2025-03-31 00:00:00'),
(103, 1, 'CAFE OZ', 5, 'Pas mal mais peut mieux faire.', '2023-06-19 00:00:00'),
(104, 6, 'LA PLAGE', 5, 'Les cocktails sont excellents, je recommande !', '2024-06-19 00:00:00'),
(105, 6, 'BARBEROUSSE', 5, 'Une bonne adresse, j’y reviendrai.', '2024-12-03 00:00:00'),
(106, 5, 'ZEBULAN', 4, 'Lieu agréable pour sortir entre amis.', '2023-04-01 00:00:00'),
(107, 6, 'PHARMACIE BAR', 4, 'Bonne musique mais un peu trop de monde.', '2023-04-01 00:00:00'),
(108, 3, 'KOKALAN', 5, 'Ambiance moyenne mais bons prix.', '2024-08-02 00:00:00'),
(109, 4, 'LA PLAGE', 4, 'J’ai adoré la déco et les boissons.', '2024-02-06 00:00:00'),
(110, 7, 'LE BISTROT DE ST SO', 3, 'Une bonne adresse, j’y reviendrai.', '2025-03-04 00:00:00'),
(111, 7, 'LA PLANQUE', 4, 'Le service était rapide et efficace.', '2024-07-11 00:00:00'),
(112, 3, 'MAGNUM', 5, 'Pas mal mais peut mieux faire.', '2023-12-30 00:00:00'),
(113, 6, 'LA PLANQUE', 5, 'Bonne musique mais un peu trop de monde.', '2023-01-31 00:00:00'),
(114, 7, 'MAGNUM', 4, 'Pas mal mais peut mieux faire.', '2025-03-24 00:00:00'),
(115, 7, 'PHARMACIE BAR', 4, 'J’ai adoré la déco et les boissons.', '2024-03-08 00:00:00'),
(116, 3, 'CAFE OZ', 4, 'Lieu agréable pour sortir entre amis.', '2024-10-13 00:00:00'),
(117, 6, 'BISTROT DE LA REINE', 4, 'J’ai adoré la déco et les boissons.', '2024-07-07 00:00:00'),
(118, 2, 'BERNADETTE', 5, 'Top pour un afterwork !', '2023-05-27 00:00:00'),
(119, 5, 'BERNADETTE', 4, 'Ambiance moyenne mais bons prix.', '2024-07-16 00:00:00'),
(120, 1, 'LA PLAGE', 5, 'Pas mal mais peut mieux faire.', '2025-05-09 00:00:00'),
(121, 1, 'LA PLANQUE', 4, 'Pas mal mais peut mieux faire.', '2023-12-09 00:00:00'),
(122, 4, 'O QAUI', 4, 'Pas mal mais peut mieux faire.', '2023-07-08 00:00:00'),
(123, 1, 'LE CARTEL', 4, 'Top pour un afterwork !', '2024-06-14 00:00:00'),
(124, 7, 'LA BASE ARRIERE', 5, 'J’ai adoré la déco et les boissons.', '2025-01-25 00:00:00'),
(125, 1, 'LE BISTROT DE ST SO', 4, 'Ambiance moyenne mais bons prix.', '2025-01-30 00:00:00'),
(126, 3, 'MAGNUM', 3, 'Lieu agréable pour sortir entre amis.', '2024-08-17 00:00:00'),
(127, 4, 'LA PLAGE', 3, 'Le service était rapide et efficace.', '2023-04-10 00:00:00'),
(128, 2, 'MAGNUM', 4, 'Lieu agréable pour sortir entre amis.', '2024-07-28 00:00:00'),
(129, 4, 'PHARMACIE BAR', 4, 'Une bonne adresse, j’y reviendrai.', '2023-10-15 00:00:00'),
(130, 1, 'LA BASE ARRIERE', 5, 'Le service était rapide et efficace.', '2024-09-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bar`
--

CREATE TABLE `bar` (
  `Id_bar` int(10) NOT NULL,
  `Nom` varchar(64) NOT NULL,
  `Avis` int(1) NOT NULL,
  `Description` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `Id` int(5) NOT NULL,
  `Pseudo` varchar(15) NOT NULL,
  `Mail` varchar(64) NOT NULL,
  `Mdp` varchar(15) NOT NULL,
  `Admin` int(3) NOT NULL DEFAULT '0',
  `Ami1` int(5) DEFAULT NULL,
  `Ami2` int(5) DEFAULT NULL,
  `Ami3` int(5) DEFAULT NULL,
  `Ami4` int(5) DEFAULT NULL,
  `Ami5` int(5) DEFAULT NULL,
  `Ami6` int(5) DEFAULT NULL,
  `Ami7` int(5) DEFAULT NULL,
  `Ami8` int(5) DEFAULT NULL,
  `Ami9` int(5) DEFAULT NULL,
  `Ami10` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`Id`, `Pseudo`, `Mail`, `Mdp`, `Admin`, `Ami1`, `Ami2`, `Ami3`, `Ami4`, `Ami5`, `Ami6`, `Ami7`, `Ami8`, `Ami9`, `Ami10`) VALUES
(1, 'Bart', 'corentin.bondeau@gmail.com', 'Bart', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Ralph', 'Angus@student.junia.com', 'aaa', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Angus', 'Angus@student.junia.com', 'azerty', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Admin', 'admin@admin.com', 'admin', 2, 1, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Maxime', 'maxime.leclerc@gmail.com', 'motdepasse6', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Camille', 'camille.moreau@yahoo.com', 'motdepasse7', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Julie', 'julie.petit@gmail.com', 'motdepasse5', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`Id_avis`);

--
-- Indexes for table `bar`
--
ALTER TABLE `bar`
  ADD PRIMARY KEY (`Id_bar`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `Id_avis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `bar`
--
ALTER TABLE `bar`
  MODIFY `Id_bar` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
