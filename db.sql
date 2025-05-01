CREATE DATABASE  IF NOT EXISTS `pet_adoption` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pet_adoption`;
-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: pet_adoption
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adoption_applications`
--

DROP TABLE IF EXISTS `adoption_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adoption_applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `pet_id` int DEFAULT NULL,
  `application_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `pet_id` (`pet_id`),
  CONSTRAINT `adoption_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `adoption_applications_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adoption_applications`
--

LOCK TABLES `adoption_applications` WRITE;
/*!40000 ALTER TABLE `adoption_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `adoption_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pets`
--

DROP TABLE IF EXISTS `pets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `breed` varchar(50) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `description` text,
  `image_path` varchar(255) DEFAULT NULL,
  `is_adopted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pets`
--

LOCK TABLES `pets` WRITE;
/*!40000 ALTER TABLE `pets` DISABLE KEYS */;
INSERT INTO `pets` VALUES (81,'Max','dog','Golden Retriever',4,'male','Max is a friendly and playful Golden Retriever who loves running and playing fetch. He gets along well with children and other dogs.','/img/golden_retriever.jpg',0),(82,'Luna','cat','Maine Coon',2,'female','Luna is a beautiful Maine Coon with a fluffy coat. She\'s independent but affectionate and loves to cuddle on cold nights.','/img/maine_coon.jpg',0),(83,'Bella','dog','Labrador',2,'female','Bella is an energetic young Labrador who loves water and playing outdoors. She\'s great with families and other pets.','/img/labrador.jpg',0),(84,'Oliver','cat','Siamese',4,'male','Oliver is a vocal Siamese cat who loves attention. He\'s playful, intelligent, and will follow you around the house.','/img/siamese.jpg',0),(85,'Charlie','dog','Beagle',5,'male','Charlie is a curious Beagle with a great nose. He loves to explore and would be perfect for an active family.','/img/beagle.jpg',0),(86,'Lucy','cat','Ragdoll',3,'female','Lucy is a gentle Ragdoll who loves to be held. She\'s calm, patient, and gets along well with children.','/img/ragdoll.jpg',0),(87,'Cooper','dog','German Shepherd',3,'male','Cooper is an intelligent German Shepherd who is easy to train. He\'s loyal and would make a great family protector.','/img/german_shepherd.jpg',0),(88,'Lily','cat','Persian',6,'female','Lily is a calm Persian cat who enjoys lounging in sunny spots. She needs regular grooming for her long coat.','/img/persian.jpg',0),(89,'Rocky','dog','Siberian Husky',3,'male','Rocky is an energetic Husky who loves to run. He needs plenty of exercise and would be great for outdoor enthusiasts.','/img/husky.jpg',0),(90,'Milo','cat','Bengal',1,'male','Milo is a playful Bengal kitten with beautiful spotted coat. He\'s energetic and loves interactive toys.','/img/bengal.jpg',0),(91,'Buddy','dog','Poodle',7,'male','Buddy is an intelligent standard Poodle. He\'s hypoallergenic and great for families with allergies.','/img/poodle.jpg',0),(92,'Chloe','cat','Scottish Fold',3,'female','Chloe is an adorable Scottish Fold with folded ears. She\'s sweet-natured and gets along with everyone.','/img/scottish_fold.jpg',0),(93,'Ruby','rabbit','Holland Lop',1,'female','Ruby is a cute Holland Lop rabbit with floppy ears. She\'s gentle and enjoys being petted.','/img/holland_lop.jpg',0),(94,'Oscar','bird','Cockatiel',3,'male','Oscar is a friendly cockatiel who can whistle simple tunes. He enjoys human interaction.','/img/cockatiel.jpg',0),(95,'Daisy','guinea pig','American',2,'female','Daisy is a sweet guinea pig who loves vegetables. She makes adorable sounds when excited.','/img/guinea_pig.jpg',0),(96,'Leo','turtle','Red-Eared Slider',5,'male','Leo is a calm red-eared slider turtle. He\'s easy to care for and fascinating to watch.','/img/turtle.jpg',0);
/*!40000 ALTER TABLE `pets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'yassine','yassine','yassine@yassine.taha','$2y$12$0uEuMlsyXuh4tFYxgQi4Ie5ns3vASYGNIK83NyN1Q9BKZABJ6Xchu','98295395');
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

-- Dump completed on 2025-05-01 22:05:02
