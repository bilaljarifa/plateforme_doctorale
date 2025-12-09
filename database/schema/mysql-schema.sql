/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `annee` year(4) NOT NULL,
  `lien` varchar(255) DEFAULT NULL,
  `doi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_user_id_foreign` (`user_id`),
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ceds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ceds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  `ped_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ceds_ped_id_foreign` (`ped_id`),
  CONSTRAINT `ceds_ped_id_foreign` FOREIGN KEY (`ped_id`) REFERENCES `peds` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `communications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `communications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `titre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `annee` year(4) NOT NULL,
  `lien` varchar(255) DEFAULT NULL,
  `doi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `communications_user_id_foreign` (`user_id`),
  CONSTRAINT `communications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `doctorant_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctorant_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `cin` varchar(255) NOT NULL,
  `cne` varchar(255) NOT NULL,
  `nom_arabe` varchar(255) NOT NULL,
  `prenom_arabe` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `situation_familiale` varchar(255) NOT NULL,
  `situation_administrative` varchar(255) NOT NULL,
  `orcid` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctorant_profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `doctorant_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `etablissements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etablissements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `intitulefr` varchar(255) NOT NULL,
  `intituleAR` varchar(255) NOT NULL,
  `ced_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `etablissements_ced_id_foreign` (`ced_id`),
  CONSTRAINT `etablissements_ced_id_foreign` FOREIGN KEY (`ced_id`) REFERENCES `ceds` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `laboratoires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratoires` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  `etablissement_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laboratoires_etablissement_id_foreign` (`etablissement_id`),
  CONSTRAINT `laboratoires_etablissement_id_foreign` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `peds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `profs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_fr` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `laboratoire_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profs_email_unique` (`email`),
  KEY `profs_laboratoire_id_foreign` (`laboratoire_id`),
  CONSTRAINT `profs_laboratoire_id_foreign` FOREIGN KEY (`laboratoire_id`) REFERENCES `laboratoires` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `reinscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reinscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `annee_academique` varchar(255) NOT NULL,
  `annee_inscription` varchar(255) NOT NULL,
  `taux_avancement` int(11) DEFAULT NULL,
  `rapport_activite` text DEFAULT NULL,
  `thesis_progress` text NOT NULL,
  `rapport_path` varchar(255) NOT NULL,
  `directeur_valide` tinyint(1) NOT NULL DEFAULT 0,
  `derniere_publication` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reinscriptions_user_id_foreign` (`user_id`),
  KEY `reinscriptions_annee_academique_index` (`annee_academique`),
  CONSTRAINT `reinscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sujets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sujets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `intitule_sujet` varchar(255) NOT NULL,
  `prof_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sujets_prof_id_foreign` (`prof_id`),
  CONSTRAINT `sujets_prof_id_foreign` FOREIGN KEY (`prof_id`) REFERENCES `profs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `theses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `apogee` varchar(255) NOT NULL,
  `centre_etudes_doctorales_id` bigint(20) unsigned NOT NULL,
  `formations_doctorales_id` bigint(20) unsigned NOT NULL,
  `directeur_these_id` bigint(20) unsigned NOT NULL,
  `laboratoire_id` bigint(20) unsigned NOT NULL,
  `etablissement_id` bigint(20) unsigned NOT NULL,
  `sujet_id` bigint(20) unsigned NOT NULL,
  `co_directeur_type` varchar(255) NOT NULL,
  `co_directeur_nom_complet` varchar(255) DEFAULT NULL,
  `co_directeur_nom` varchar(255) DEFAULT NULL,
  `co_directeur_prenom` varchar(255) DEFAULT NULL,
  `co_directeur_etablissement` varchar(255) DEFAULT NULL,
  `annee_inscription` varchar(255) NOT NULL,
  `annee_premiere_inscription` varchar(255) NOT NULL,
  `date_prevue_soutenance` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `theses_user_id_foreign` (`user_id`),
  KEY `theses_centre_etudes_doctorales_id_foreign` (`centre_etudes_doctorales_id`),
  KEY `theses_formations_doctorales_id_foreign` (`formations_doctorales_id`),
  KEY `theses_directeur_these_id_foreign` (`directeur_these_id`),
  KEY `theses_laboratoire_id_foreign` (`laboratoire_id`),
  KEY `theses_etablissement_id_foreign` (`etablissement_id`),
  KEY `theses_sujet_id_foreign` (`sujet_id`),
  CONSTRAINT `theses_centre_etudes_doctorales_id_foreign` FOREIGN KEY (`centre_etudes_doctorales_id`) REFERENCES `ceds` (`id`),
  CONSTRAINT `theses_directeur_these_id_foreign` FOREIGN KEY (`directeur_these_id`) REFERENCES `profs` (`id`),
  CONSTRAINT `theses_etablissement_id_foreign` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`),
  CONSTRAINT `theses_formations_doctorales_id_foreign` FOREIGN KEY (`formations_doctorales_id`) REFERENCES `peds` (`id`),
  CONSTRAINT `theses_laboratoire_id_foreign` FOREIGN KEY (`laboratoire_id`) REFERENCES `laboratoires` (`id`),
  CONSTRAINT `theses_sujet_id_foreign` FOREIGN KEY (`sujet_id`) REFERENCES `sujets` (`id`),
  CONSTRAINT `theses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom_fr` varchar(255) DEFAULT NULL,
  `nom_ar` varchar(255) DEFAULT NULL,
  `prenom_ar` varchar(255) DEFAULT NULL,
  `cin` varchar(255) DEFAULT NULL,
  `cne` varchar(255) DEFAULT NULL,
  `genre` enum('M','F') DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `situation_familiale` enum('Célibataire','Marié(e)','Divorcé(e)','Veuf(ve)') DEFAULT NULL,
  `situation_administrative` enum('Fonctionnaire','Salarié','Sans emploi') DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `orcid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_resets_table',1);
INSERT INTO `migrations` VALUES (3,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` VALUES (4,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` VALUES (5,'2025_11_08_140000_add_google_id_to_users_table',1);
INSERT INTO `migrations` VALUES (6,'2025_11_08_140103_create_peds_table',1);
INSERT INTO `migrations` VALUES (7,'2025_11_08_140328_create_ceds_table',1);
INSERT INTO `migrations` VALUES (8,'2025_11_08_140339_create_etablissements_table',1);
INSERT INTO `migrations` VALUES (9,'2025_11_08_140350_create_laboratoires_table',1);
INSERT INTO `migrations` VALUES (10,'2025_11_08_140401_create_profs_table',1);
INSERT INTO `migrations` VALUES (11,'2025_11_08_140411_create_sujets_table',1);
INSERT INTO `migrations` VALUES (12,'2025_11_08_141626_add_profile_fields_to_users_table',1);
INSERT INTO `migrations` VALUES (13,'2025_11_09_180949_create_doctorant_profiles_table',1);
INSERT INTO `migrations` VALUES (14,'2025_11_10_000000_create_articles_table',1);
INSERT INTO `migrations` VALUES (15,'2025_11_14_000000_create_theses_table',2);
INSERT INTO `migrations` VALUES (16,'2025_11_23_000000_create_communications_table',3);
INSERT INTO `migrations` VALUES (17,'2025_11_23_000001_modify_communications_table',4);
INSERT INTO `migrations` VALUES (18,'2025_11_23_000002_create_reinscriptions_table',5);
INSERT INTO `migrations` VALUES (19,'2025_11_23_000010_add_fields_to_reinscriptions_table',6);
INSERT INTO `migrations` VALUES (20,'2025_11_28_add_thesis_progress_to_reinscriptions',7);
INSERT INTO `migrations` VALUES (21,'2025_12_02_140000_make_profile_fields_required',8);
INSERT INTO `migrations` VALUES (22,'2025_12_02_141500_make_these_articles_communications_required',9);
INSERT INTO `migrations` VALUES (23,'2025_12_02_193739_make_theses_required_fields_not_null',10);
INSERT INTO `migrations` VALUES (24,'2025_12_02_194617_make_doctorant_profile_fields_not_null',11);
INSERT INTO `migrations` VALUES (25,'2025_12_02_194624_make_reinscription_fields_not_null',11);
