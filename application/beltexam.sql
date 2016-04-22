-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: beltexam
-- ------------------------------------------------------
-- Server version	5.7.9

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destination` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `traveldate_start` datetime DEFAULT NULL,
  `traveldate_end` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `trip_creator_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trips_users1_idx` (`trip_creator_id`),
  CONSTRAINT `fk_trips_users1` FOREIGN KEY (`trip_creator_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trips`
--

LOCK TABLES `trips` WRITE;
/*!40000 ALTER TABLE `trips` DISABLE KEYS */;
INSERT INTO `trips` VALUES (1,'Las Vegas','A trip to the Belagio to relive Oceans Eleven','2016-06-01 00:00:00','2016-06-15 00:00:00','2016-04-22 09:23:42','2016-04-22 09:23:42',2),(2,'Los Angeles','going to the ocean','2016-07-01 00:00:00','2016-07-15 00:00:00','2016-04-22 09:32:52','2016-04-22 09:32:52',2),(3,'New York','going to see broadway shows','2016-07-20 00:00:00','2016-07-30 00:00:00','2016-04-22 10:02:33','2016-04-22 10:02:33',1),(8,'Londo','something','2016-08-19 00:00:00','2016-09-09 00:00:00','2016-04-22 13:23:19','2016-04-22 13:23:19',3),(9,'mubai','something','2016-04-30 00:00:00','2016-04-30 00:00:00','2016-04-22 13:25:24','2016-04-22 13:25:24',1);
/*!40000 ALTER TABLE `trips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_trips`
--

DROP TABLE IF EXISTS `user_trips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trips_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `joined_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_trips_trips_idx` (`trips_id`),
  KEY `fk_user_trips_users1_idx` (`users_id`),
  CONSTRAINT `fk_user_trips_trips` FOREIGN KEY (`trips_id`) REFERENCES `trips` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_trips_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_trips`
--

LOCK TABLES `user_trips` WRITE;
/*!40000 ALTER TABLE `user_trips` DISABLE KEYS */;
INSERT INTO `user_trips` VALUES (2,1,2,'2016-04-22 09:23:42'),(3,2,2,'2016-04-22 09:30:42'),(4,2,1,'2016-04-22 09:40:42'),(6,3,1,'2016-04-22 10:02:58'),(7,3,3,'2016-04-22 11:02:58'),(8,1,3,'2016-04-22 12:59:34'),(9,8,3,'2016-04-22 13:23:19'),(10,8,1,'2016-04-22 13:25:06'),(11,9,1,'2016-04-22 13:25:24');
/*!40000 ALTER TABLE `user_trips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jonathan Ben-Ammi','jbenammi','jbenammi@gmail.com','f7c3bc1d808e04732adf679965ccc34ca7ae3441','2016-04-22 09:13:28','2016-04-22 09:13:28'),(2,'Gitai Ben-Ammi','gbenammi','gbenammi@gmail.com','f7c3bc1d808e04732adf679965ccc34ca7ae3441','2016-04-22 09:24:19','2016-04-22 09:24:19'),(3,'Katerina Kittycat','MeowMeow','KK@theneighborhood.com','f7c3bc1d808e04732adf679965ccc34ca7ae3441','2016-04-22 10:48:16','2016-04-22 10:48:16');
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

-- Dump completed on 2016-04-22 13:30:10
