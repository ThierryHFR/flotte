-- MySQL dump 10.16  Distrib 10.1.48-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: fdb1028.atspace.me    Database: 4303986_wordp
-- ------------------------------------------------------
-- Server version	8.0.32

--
-- Table structure for table `accident`
--

DROP TABLE IF EXISTS `accident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accident` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accident`
--

LOCK TABLES `accident` WRITE;
/*!40000 ALTER TABLE `accident` DISABLE KEYS */;
INSERT INTO `accident` VALUES (1,'Accident'),(2,'Carrosserie'),(3,'Voyant moteur'),(4,'Retroviseur'),(5,'Pneu'),(6,'Ampoule grillee'),(7,'Essuie glace'),(8,'Eclat pare-brise'),(9,'Hayon'),(10,'Froid');
/*!40000 ALTER TABLE `accident` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incident`
--

DROP TABLE IF EXISTS `incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incident` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_vehicule` int NOT NULL,
  `id_user` int NOT NULL,
  `id_accident` int NOT NULL,
  `incident` text NOT NULL,
  `km` int NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `incident_fk1` (`id_vehicule`),
  KEY `incident_fk2` (`id_accident`),
  KEY `incident_fk3` (`id_user`),
  CONSTRAINT `incident_fk1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`),
  CONSTRAINT `incident_fk2` FOREIGN KEY (`id_accident`) REFERENCES `accident` (`id`),
  CONSTRAINT `incident_fk3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `intervention`
--

DROP TABLE IF EXISTS `intervention`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intervention` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervention`
--

LOCK TABLES `intervention` WRITE;
/*!40000 ALTER TABLE `intervention` DISABLE KEYS */;
INSERT INTO `intervention` VALUES (1,'Releve kilométrique'),(2,'Controle technique'),(3,'Controle pollution'),(4,'Entretient'),(5,'Reparation'),(6,'Accident'),(7,'PV');
/*!40000 ALTER TABLE `intervention` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marque`
--

DROP TABLE IF EXISTS `marque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marque` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marque`
--

LOCK TABLES `marque` WRITE;
/*!40000 ALTER TABLE `marque` DISABLE KEYS */;
INSERT INTO `marque` VALUES (1,'Citroen'),(2,'Peugeot'),(3,'Renault'),(4,'Volkswagen'),(5,'Iveco'),(6,'Fiat'),(7,'Dacia'),(8,'Nissan'),(9,'Tesla');
/*!40000 ALTER TABLE `marque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model`
--

LOCK TABLES `model` WRITE;
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
INSERT INTO `model` VALUES (1,'C3'),(2,'Kangoo'),(3,'Crafter'),(4,'Food Truck'),(5,'35C13A'),(6,'Trafic'),(7,'NT400'),(8,'Lodgy'),(9,'Doblo'),(10,'Master'),(11,'35C15');
/*!40000 ALTER TABLE `model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `releve_kilometrique`
--

DROP TABLE IF EXISTS `releve_kilometrique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `releve_kilometrique` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_vehicule` int NOT NULL,
  `km` int NOT NULL,
  `id_intervention` int NOT NULL,
  `intervention` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `facture` varchar(4096) DEFAULT NULL,
  `id_suivi` int DEFAULT '0',
  `date_suivi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `releve_kilometrique_fk1` (`id_vehicule`),
  KEY `releve_kilometrique_fk2` (`id_intervention`),
  CONSTRAINT `releve_kilometrique_fk1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`),
  CONSTRAINT `releve_kilometrique_fk2` FOREIGN KEY (`id_intervention`) REFERENCES `intervention` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL,
  `actif` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$jG6m04LjhfUBipc81GQHVOxvI7RxoaDV9wkN11Wh2cKcTL0kA3S9.',0,1,'2023-04-21 11:41:45');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plaque` varchar(100) NOT NULL,
  `id_marque` int NOT NULL,
  `id_model` int NOT NULL,
  `date1_immatriculation` varchar(255) NOT NULL,
  `date_cate_grise` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicule_fk1` (`id_model`),
  KEY `vehicule_fk2` (`id_marque`),
  CONSTRAINT `vehicule_fk1` FOREIGN KEY (`id_model`) REFERENCES `model` (`id`),
  CONSTRAINT `vehicule_fk2` FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

