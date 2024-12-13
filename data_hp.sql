-- MySQL dump 10.13  Distrib 8.0.40, for Linux (x86_64)
--
-- Host: localhost    Database: hp
-- ------------------------------------------------------
-- Server version	8.0.40-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_hp`
--

DROP TABLE IF EXISTS `data_hp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_hp` (
  `id_hp` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `harga` varchar(255) DEFAULT NULL,
  `prosesor` varchar(255) DEFAULT NULL,
  `memori` varchar(255) DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `kamera` varchar(255) DEFAULT NULL,
  `resolusi` varchar(255) DEFAULT NULL,
  `baterai` varchar(255) DEFAULT NULL,
  `prosesor_n` int DEFAULT NULL,
  `resolusi_n` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `harga_n` varchar(255) DEFAULT NULL,
  `memori_n` varchar(255) DEFAULT NULL,
  `ram_n` varchar(255) DEFAULT NULL,
  `kamera_n` varchar(255) DEFAULT NULL,
  `baterai_n` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_hp`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_hp`
--

LOCK TABLES `data_hp` WRITE;
/*!40000 ALTER TABLE `data_hp` DISABLE KEYS */;
INSERT INTO `data_hp` VALUES (67,'Realme C15','1900000','DualCore','64','4','8','Full HD','5000 - 6000',1,3,'2024-11-24 19:20:00','2024-11-24 19:20:00','3','4','3','1','5'),(68,'Realme C20','2200000','DualCore','32','2','8','Full HD','4000 - 5000',1,3,'2024-11-24 19:21:00','2024-11-24 19:21:00','2','3','1','1','4'),(69,'Realme C25','1499000','DualCore','64','4','28','Full HD','5000 - 6000',1,3,'2024-11-24 19:21:48','2024-11-24 19:21:48','4','4','3','3','5'),(70,'Oppo A16K','1400000','QuadCore','32','4','13','Full HD','4000 - 5000',2,3,'2024-11-24 19:23:18','2024-11-24 19:23:18','4','3','3','2','4'),(72,'Oppo A54','900000','QuadCore','64','6','13','Full HD','4000 - 5000',2,3,'2024-11-24 19:26:19','2024-11-24 19:26:19','5','4','4','2','4'),(73,'Oppo A57','1300000','QuadCore','64','4','13','Full HD','5000 - 6000',2,3,'2024-11-24 19:27:20','2024-11-24 19:27:20','4','4','3','2','5'),(74,'Samsung Galaxy A03 Core','2300000','HexaCore','32','2','8','HD+','5000 - 6000',3,2,'2024-11-24 19:28:50','2024-11-24 19:28:50','2','3','1','1','5'),(75,'Samsung Galaxy A13','800000','HexaCore','32','6','50','HD+','5000 - 6000',3,2,'2024-11-24 19:30:02','2024-11-24 19:30:02','5','3','4','5','5'),(76,'Samsung Galaxy A04S','1200000','HexaCore','32','4','48','HD+','4000 - 5000',3,2,'2024-11-24 19:31:02','2024-11-24 19:31:02','4','3','3','4','4'),(77,'Vivo Y21S','980000','OctaCore','64','4','48','Full HD','4000 - 5000',4,3,'2024-11-24 19:32:06','2024-11-24 19:32:06','5','4','3','4','4'),(78,'Vivo Y21A','1100000','OctaCore','32','4','13','Full HD','4000 - 5000',4,3,'2024-11-24 19:32:58','2024-11-24 19:32:58','4','3','3','2','4'),(79,'Vivo Y22','975000','OctaCore','128','6','48','Full HD','4000 - 5000',4,3,'2024-11-24 19:33:57','2024-11-24 19:33:57','5','5','4','4','4');
/*!40000 ALTER TABLE `data_hp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `k_baterai`
--

DROP TABLE IF EXISTS `k_baterai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `k_baterai` (
  `nama` varchar(255) DEFAULT NULL,
  `nilai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `k_baterai`
--

LOCK TABLES `k_baterai` WRITE;
/*!40000 ALTER TABLE `k_baterai` DISABLE KEYS */;
INSERT INTO `k_baterai` VALUES ('2500mah>3000mah',1),('3500mah>4000mah',2),('4500mah>5000mah',3),('5500mah>6000mah',4);
/*!40000 ALTER TABLE `k_baterai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `k_harga`
--

DROP TABLE IF EXISTS `k_harga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `k_harga` (
  `nama` varchar(255) DEFAULT NULL,
  `nilai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `k_harga`
--

LOCK TABLES `k_harga` WRITE;
/*!40000 ALTER TABLE `k_harga` DISABLE KEYS */;
INSERT INTO `k_harga` VALUES ('Rp.8.000.000 > ',1),('Rp.6.500.000>Rp.8.000.000',2),('Rp.4.000.000>Rp.6.000.000',3),('Rp.2.500.000>Rp.3.500.000',4),('<Rp.2.000.000',5);
/*!40000 ALTER TABLE `k_harga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `k_kamera`
--

DROP TABLE IF EXISTS `k_kamera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `k_kamera` (
  `nama` varchar(255) DEFAULT NULL,
  `nilai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `k_kamera`
--

LOCK TABLES `k_kamera` WRITE;
/*!40000 ALTER TABLE `k_kamera` DISABLE KEYS */;
INSERT INTO `k_kamera` VALUES ('< 10 MP',1),('10 > 25 MP',2),('25 > 50 MP',3);
/*!40000 ALTER TABLE `k_kamera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `k_memori`
--

DROP TABLE IF EXISTS `k_memori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `k_memori` (
  `nama` varchar(255) DEFAULT NULL,
  `nilai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `k_memori`
--

LOCK TABLES `k_memori` WRITE;
/*!40000 ALTER TABLE `k_memori` DISABLE KEYS */;
INSERT INTO `k_memori` VALUES ('3GB/32GB',1),('4GB/64GB',2),('6GB/128',3),('8GB/256GB',4),('12GB/512GB',5);
/*!40000 ALTER TABLE `k_memori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `k_prosesor`
--

DROP TABLE IF EXISTS `k_prosesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `k_prosesor` (
  `nama` varchar(255) DEFAULT NULL,
  `nilai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `k_prosesor`
--

LOCK TABLES `k_prosesor` WRITE;
/*!40000 ALTER TABLE `k_prosesor` DISABLE KEYS */;
INSERT INTO `k_prosesor` VALUES ('DUALCORE',1),('QUADCORE',2),('OCTACORE',3);
/*!40000 ALTER TABLE `k_prosesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `k_resolusi`
--

DROP TABLE IF EXISTS `k_resolusi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `k_resolusi` (
  `nama` varchar(255) DEFAULT NULL,
  `nilai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `k_resolusi`
--

LOCK TABLES `k_resolusi` WRITE;
/*!40000 ALTER TABLE `k_resolusi` DISABLE KEYS */;
INSERT INTO `k_resolusi` VALUES ('HD',1),('Full HD',2),('2K',3),('4K',4);
/*!40000 ALTER TABLE `k_resolusi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kriteria_harga`
--

DROP TABLE IF EXISTS `kriteria_harga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kriteria_harga` (
  `opsi` varchar(255) DEFAULT NULL,
  `bobot` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria_harga`
--

LOCK TABLES `kriteria_harga` WRITE;
/*!40000 ALTER TABLE `kriteria_harga` DISABLE KEYS */;
/*!40000 ALTER TABLE `kriteria_harga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_10_06_004723_create_users_table',2),(5,'2024_10_06_005611_create_users_table',3),(6,'2024_10_17_033428_create_users_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('DmG6FLrxDG5Ek1q3j2HDuuozVDW4UKWsFuV2Gpwt',1,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:132.0) Gecko/20100101 Firefox/132.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSXBmeWpNRktKTFd4MW1yRVlCY1djSGNyNTRGM3NDeWhLN0tDZTZKcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1732875431),('DoqdaSNlkv8ZIMVQNiBXC2zXgQZsL9RFQrY3taRu',1,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:132.0) Gecko/20100101 Firefox/132.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidTBxaHY5UUhxVFhnS0w2V0VrNXFOT3ViVFNqbEw2NXhJdU1NcWpFVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC93cCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1732714254),('FzhSQzHGTarxf7m94aYB08cwQU4sRIz2Uxb3DzG2',1,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:132.0) Gecko/20100101 Firefox/132.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMXB6UUFoQ21LS2s0SWF5VWQ4czQ3dm85MXpaNm9vMFY0UjF2ZWgxUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWtvbWVuZGFzaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1733445907);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_name`
--

DROP TABLE IF EXISTS `table_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_name` (
  `id_user` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `username` varchar(50) DEFAULT NULL,
  `pasword` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `verify_key` varchar(100) DEFAULT NULL,
  `active` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_name`
--

LOCK TABLES `table_name` WRITE;
/*!40000 ALTER TABLE `table_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `verify_key` varchar(100) DEFAULT NULL,
  `active` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$12$h6WMdLXTMC9xcaI0H5c0ZeFE07eS/1xsPH/bYdl5H5rsTUaHNkfve','Admin','admin@mail.com',NULL,1,'2024-10-18 06:13:30','2024-10-18 06:13:30'),(2,'hidayat','$2y$12$7qKHiRKiIW0ao.jnSiG0Huyn6PYzTiIay8zpHgQvc1uztt8QFj7NO','Admin','hidayat@mail.com',NULL,1,'2024-10-23 06:32:12','2024-10-23 06:32:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-06  7:46:32