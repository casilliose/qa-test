-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: myfintest
-- ------------------------------------------------------
-- Server version	5.7.20

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
-- Current Database: `myfintest`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `myfintest` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `myfintest`;

--
-- Table structure for table `credits`
--

DROP TABLE IF EXISTS `credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NUlL,
  `min_amount` int(10) unsigned NOT NULL,
  `max_amount` int(10) unsigned NOT NULL,
  `min_term` int(10) unsigned NOT NULL,
  `max_term` int(10) unsigned NOT NULL,
  `target` int(10) unsigned NOT NULL,
  `history` int(10) unsigned NOT NULL,
  `real_estate` int(10) unsigned NOT NULL,
  `have_car` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credits`
--

LOCK TABLES `credits` WRITE;
/*!40000 ALTER TABLE `credits` DISABLE KEYS */;
INSERT INTO `credits` VALUES (1,'Совкомбанк	Пенсионный плюс',1000,10000,1,6,1,4,1,1),(2,'Райффайзенбанк	Экспресс',1000,10000,6,12,2,2,2,2),(3,'Райффайзенбанк Овердрафт',1000,10000,12,22,3,1,3,1),(4,'УБРиР Кредит на любые цели',1000,10000,22,36,1,4,1,1),(5,'УБРиР Ипотека с материнским капиталом',10000,100000,1,6,2,1,3,2),(6,'Райффайзенбанк На частный дом',100000,1000000,1,6,3,1,2,1),(7,'Райффайзенбанк	Недвижимость под залог имеющегося жилья',1000,100000,1,6,1,4,1,2),(8,'Райффайзенбанк На новостройку',1000,10000,12,26,2,1,3,2),(9,'	Райффайзенбанк На вторичное жилье',5000,15000,1,32,3,1,1,2),(10,'Ренессанс Кредит Банк	На бытовую технику	',3000,12000,1,6,1,1,1,1),(11,'Локо-Банк Под залог авто',1001,999999,2,3,2,3,2,1),(12,'ЮниКредит Банк Потребительский',7000,12000,1,6,3,1,1,2),(13,'Альфа-Банк Кредит наличными',1000,10000,10,26,1,1,1,2),(14,'СберБанк Кредитная карта СберКарта',1000,10000,12,16,2,2,3,2),(15,'Севергазбанк Ипотека по двум документам',500000,1000000,1,36,3,1,1,2),(16,'Челябинвестбанк Маткапитал +',1000,100000,12,26,1,1,1,1),(17,'ЧБРР Залоговый',1000,10000,1,36,2,2,2,1),(18,'Челябинвестбанк Инвест Рефинансирование',1000,10000,1,6,3,1,1,1),(19,'Союз Бизнес-кредитование',3000,10000,1,7,1,1,1,1),(20,'Национальный Стандарт Рефинансирование',1000,10000,1,8,2,3,2,1),(21,'Акибанк Особые условия держателям зарплатной карты Банка',2000,100000,1,9,3,1,1,1),(22,'Фора-Банк Фора-премиум',1000,1000000,1,10,1,1,1,1),(23,'Датабанк Перекредитовка',1000,10000,1,11,2,4,3,1),(24,'Банк Казани Овердрафт',1000,100000,1,12,3,1,1,1),(25,'Тинькофф суперзайм',4000,100000,1,13,1,1,1,1),(26,'Банк ВТБ Рефинансирование ипотеки',1000,10000,13,15,2,3,3,1),(27,'Сургутнефтегазбанк Пенсионный',1000,100000,13,16,3,1,1,1),(28,'Почта Банк Наличными',5000,100000,13,17,1,1,1,2),(29,'Тойота Банк Легенда',10000,10000,14,20,2,2,2,1),(30,'РН банк Кредит с остаточным платежом',1000,10000,15,21,3,1,1,2),(31,'Левобережный Переезд',8000,10000,16,22,1,1,1,1),(32,'Венец Пенсионный плюс',1000,10000,17,23,2,4,2,1),(33,'Уралсиб Покупка нового автомобиля у Дилера',80000,100000,18,24,3,1,1,2),(34,'ПромТрансБанк Оптимум МБ',1000,100000,19,26,1,3,1,1),(35,'Кузнецкий Реальное предложение',1000,10000,1,12,2,1,1,1),(36,'Банк Казани Инвестиционный',60000,10000,1,25,3,2,3,1),(37,'Хатон.ру Под залог недвижимости',1000,100000,1,6,1,1,1,2),(38,'Газпромбанк Кредит под залог имеющегося авто',5000,100000,1,6,2,1,1,1);
/*!40000 ALTER TABLE `credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_offers`
--

DROP TABLE IF EXISTS `request_offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_offers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `credits_id` int(10) unsigned NOT NULL,
  `create_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `credits_id` (`credits_id`),
  CONSTRAINT `request_offers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `request_offers_ibfk_2` FOREIGN KEY (`credits_id`) REFERENCES `credits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_offers`
--

LOCK TABLES `request_offers` WRITE;
/*!40000 ALTER TABLE `request_offers` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `is_confirm` tinyint(1) unsigned NOT NULL,
  `password` varchar(50) NOT NULL,
  `hash_approve` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2023-01-13  0:59:05
