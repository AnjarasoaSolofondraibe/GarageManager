-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 15 avr. 2025 à 12:15
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gcm`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `telephone`, `email`, `adresse`, `created_at`, `updated_at`) VALUES
(1, 'UN', 'Unicef', '020 23 300 92', 'rcs-bcr.mg@un.org', 'Maison Commune des Nations Unies\r\nZone Galaxy, Rue du Dr Raseta Andraharo\r\nAntananarivo 101 - Madagascar', '2025-04-12 13:43:02', '2025-04-12 13:43:02'),
(2, 'UN', 'PNUD', '020 23 300 92', 'rcs-bcr.mg@un.org', 'Maison Commune des Nations Unies Zone Galaxy, Rue du Dr Raseta Andraharo Antananarivo 101 - Madagascar', '2025-04-12 13:43:43', '2025-04-12 13:43:43'),
(3, 'UN', 'FAO', '020 23 300 92', 'rcs-bcr.mg@un.org', 'Maison Commune des Nations Unies Zone Galaxy, Rue du Dr Raseta Andraharo Antananarivo 101 - Madagascar', '2025-04-12 13:44:10', '2025-04-12 13:44:10'),
(4, 'FID', 'Fond \'dintervention pour le dévelopement', '020 22 342 36', 'drt@drt.fid.mg', 'Près Lot II Y 39 C Tsiadana Antananarivo 101 – Madagascar Tel : 22 342 36', '2025-04-12 13:46:30', '2025-04-12 13:46:30'),
(7, 'Essai', '2', '0324854306', 'anjara@programmer.net', 'ID 39 Isaha', '2025-04-12 14:34:36', '2025-04-12 18:23:52'),
(10, 'ffff', 'fff', '0324854306', 'anjara@programmer.net', 'ID 39 Isaha', '2025-04-12 14:35:09', '2025-04-12 14:35:09'),
(11, 'hhhh', 'hhhh', '0324854306', 'anjara@programmer.net', 'ID 39 Isaha', '2025-04-12 14:35:19', '2025-04-12 14:35:19'),
(12, 'Solofondraibe', 'Anjarasoa', '0324854306', 'anjara@programmer.net', 'ID 39 Isaha', '2025-04-12 14:35:24', '2025-04-12 14:35:24'),
(13, 'day', 'Anjarasoa', '0324854306', 'anjara@programmer.net', 'ID 39 Isaha', '2025-04-12 14:35:41', '2025-04-12 14:35:41');

-- --------------------------------------------------------

--
-- Structure de la table `mecaniciens`
--

DROP TABLE IF EXISTS `mecaniciens`;
CREATE TABLE IF NOT EXISTS `mecaniciens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mecaniciens`
--

INSERT INTO `mecaniciens` (`id`, `nom`, `email`, `telephone`, `created_at`, `updated_at`) VALUES
(1, 'Lova', 'lova456@gmail.com', '034 56 999 87', '2025-04-12 17:25:37', '2025-04-12 17:25:37'),
(2, 'Tahiry', 'tahiry859rakotonirina@gmail.com', '034 58 789 65', '2025-04-12 17:26:52', '2025-04-12 17:26:52');

-- --------------------------------------------------------

--
-- Structure de la table `mecanicien_reparation`
--

DROP TABLE IF EXISTS `mecanicien_reparation`;
CREATE TABLE IF NOT EXISTS `mecanicien_reparation` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `mecanicien_id` bigint UNSIGNED NOT NULL,
  `reparation_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mecanicien_reparation_mecanicien_id_foreign` (`mecanicien_id`),
  KEY `mecanicien_reparation_reparation_id_foreign` (`reparation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mecanicien_reparation`
--

INSERT INTO `mecanicien_reparation` (`id`, `mecanicien_id`, `reparation_id`, `created_at`, `updated_at`) VALUES
(1, 2, 3, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `mecanicien_specialite`
--

DROP TABLE IF EXISTS `mecanicien_specialite`;
CREATE TABLE IF NOT EXISTS `mecanicien_specialite` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `mecanicien_id` bigint UNSIGNED NOT NULL,
  `specialite_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mecanicien_specialite_mecanicien_id_foreign` (`mecanicien_id`),
  KEY `mecanicien_specialite_specialite_id_foreign` (`specialite_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mecanicien_specialite`
--

INSERT INTO `mecanicien_specialite` (`id`, `mecanicien_id`, `specialite_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 7, NULL, NULL),
(4, 1, 8, NULL, NULL),
(5, 2, 1, NULL, NULL),
(6, 2, 2, NULL, NULL),
(7, 2, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_04_12_135450_create_clients_table', 1),
(2, '2025_04_12_181128_create_reparations_table', 2),
(3, '2025_04_12_183946_add_etat_to_reparations_table', 3),
(4, '2025_04_12_193322_create_mecaniciens_table', 4),
(5, '2025_04_12_193439_create_specialites_table', 5),
(6, '2025_04_12_193728_create_mecanicien_reparation_table', 6),
(7, '2025_04_12_194444_create_mecanicien_specialite_table', 7),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 8);

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reparations`
--

DROP TABLE IF EXISTS `reparations`;
CREATE TABLE IF NOT EXISTS `reparations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicule_id` bigint UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cout` decimal(8,2) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '2025-04-12',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en cours',
  PRIMARY KEY (`id`),
  KEY `reparations_vehicule_id_foreign` (`vehicule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reparations`
--

INSERT INTO `reparations` (`id`, `vehicule_id`, `description`, `cout`, `date`, `created_at`, `updated_at`, `etat`) VALUES
(1, 1, 'Entretien périodique à 354 789km', 250000.00, '2025-04-12', '2025-04-12 15:34:24', '2025-04-12 15:34:24', 'en cours'),
(2, 1, 'Remplacement amortisseur arrière', 500000.00, '2025-04-12', '2025-04-12 15:35:41', '2025-04-12 15:35:41', 'en cours'),
(3, 2, 'Vidange boite de vitesse', 45000.00, '2025-04-12', '2025-04-12 16:14:54', '2025-04-12 16:14:54', 'en cours');

-- --------------------------------------------------------

--
-- Structure de la table `specialites`
--

DROP TABLE IF EXISTS `specialites`;
CREATE TABLE IF NOT EXISTS `specialites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `specialites`
--

INSERT INTO `specialites` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Moteur', '2025-04-12 17:21:19', '2025-04-12 17:21:19'),
(2, 'Frein', '2025-04-12 17:22:13', '2025-04-12 17:22:13'),
(3, 'Electricité', '2025-04-12 17:22:21', '2025-04-12 17:22:21'),
(4, 'Boite de vitesse', '2025-04-12 17:22:34', '2025-04-12 17:22:34'),
(5, 'Boite de transfert', '2025-04-12 17:22:44', '2025-04-12 17:22:44'),
(6, 'Pont', '2025-04-12 17:22:49', '2025-04-12 17:22:49'),
(7, 'Transmission', '2025-04-12 17:23:01', '2025-04-12 17:23:01'),
(8, 'Train roulant', '2025-04-12 17:23:08', '2025-04-12 17:23:08'),
(9, 'Carosserie et peinture', '2025-04-12 17:23:24', '2025-04-12 17:23:24'),
(10, 'Tôlerie', '2025-04-12 17:23:30', '2025-04-12 17:23:30');

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

DROP TABLE IF EXISTS `vehicules`;
CREATE TABLE IF NOT EXISTS `vehicules` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `immatriculation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` year DEFAULT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicules_client_id_foreign` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vehicules`
--

INSERT INTO `vehicules` (`id`, `marque`, `modele`, `immatriculation`, `annee`, `couleur`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 'Toyota', 'Land cruiser HZJ76L', '207CD204', '2010', 'Blanche', 1, '2025-04-12 14:51:19', '2025-04-12 14:51:19'),
(2, 'Renault', 'R4', '9749FA', '1976', 'Blanche', 13, '2025-04-12 15:02:57', '2025-04-12 15:02:57'),
(3, 'Audi', 'Q5', '2456TBG', '2012', 'Gris', 7, '2025-04-12 18:18:51', '2025-04-12 18:18:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
