-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: humanresource
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.20.04.2

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
-- Table structure for table `Account`
--

DROP TABLE IF EXISTS `Account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Account` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `matKhau` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `admins_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Account`
--

LOCK TABLES `Account` WRITE;
/*!40000 ALTER TABLE `Account` DISABLE KEYS */;
INSERT INTO `Account` VALUES (1,'157202302220191026000342g6LFGCz0rHPe8DIkAnwD4QBmgw1UFu4LQn1JAPoK.jpeg','Hoàng Ngọc Ánh','19008198','admin@gmail.com','$2y$10$4edleQ7FIcS8PthADtoE.uiy3SBXgEcRg0cNNLMbJKRudJkVsRMC2','0zqOzaKSZSmzDTGwjhkHX14MCA2IiZd70H7krYQJNAltudlCq3ZJMuPguQ3t','2019-09-27 13:44:53','2019-10-07 14:22:00');
/*!40000 ALTER TABLE `Account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BangLuong`
--

DROP TABLE IF EXISTS `BangLuong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `BangLuong` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `maPB` int unsigned NOT NULL,
  `thang` int NOT NULL,
  `nam` int NOT NULL,
  `tongLCB` double(8,2) NOT NULL,
  `tongLTC` double(8,2) NOT NULL,
  `tongBHXH` double(8,2) NOT NULL,
  `tongBHYT` double(8,2) NOT NULL,
  `tongBHTN` double(8,2) NOT NULL,
  `tongPC` double(8,2) NOT NULL,
  `tongTTNCN` double(8,2) NOT NULL,
  `tongLTT` double(8,2) NOT NULL,
  `ghiChu` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BangLuong`
--

LOCK TABLES `BangLuong` WRITE;
/*!40000 ALTER TABLE `BangLuong` DISABLE KEYS */;
INSERT INTO `BangLuong` VALUES (1,2,3,2023,10002.00,4000.00,1000.00,1000.00,1000.00,4000.00,2000.00,23000.00,NULL,'2023-05-31 11:21:02','2023-05-31 11:21:30'),(2,2,1,2023,20002.00,4000.00,1000.00,1000.00,1000.00,4000.00,2000.00,23000.00,NULL,'2023-05-31 11:21:02','2023-05-31 11:21:30'),(3,1,1,2023,20002.00,4000.00,1000.00,1000.00,1000.00,4000.00,2000.00,23000.00,NULL,'2023-05-31 11:21:02','2023-05-31 11:21:30');
/*!40000 ALTER TABLE `BangLuong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ChiTietBangLuong`
--

DROP TABLE IF EXISTS `ChiTietBangLuong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ChiTietBangLuong` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `maNV` int unsigned NOT NULL,
  `maPB` int unsigned DEFAULT NULL,
  `thang` int NOT NULL,
  `nam` int NOT NULL,
  `LCB` double(8,2) NOT NULL,
  `LTC` double(8,2) NOT NULL,
  `BHXH` double(8,2) NOT NULL,
  `BHYT` double(8,2) NOT NULL,
  `BHTN` double(8,2) NOT NULL,
  `PC` double(8,2) NOT NULL,
  `TTNCN` double(8,2) NOT NULL,
  `LTT` double(8,2) NOT NULL,
  `ghiChu` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chitietbangluong_manv_foreign_idx` (`maNV`),
  KEY `chitietbangluong_mabl_foreign_idx` (`maPB`),
  CONSTRAINT `chitietbangluong_mabl_foreign` FOREIGN KEY (`maPB`) REFERENCES `PhongBan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `chitietbangluong_manv_foreign` FOREIGN KEY (`maNV`) REFERENCES `HoSoNV` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ChiTietBangLuong`
--

LOCK TABLES `ChiTietBangLuong` WRITE;
/*!40000 ALTER TABLE `ChiTietBangLuong` DISABLE KEYS */;
INSERT INTO `ChiTietBangLuong` VALUES (10,4,NULL,5,2023,20000.00,5000.00,300.00,400.00,500.00,600.00,3000.00,21400.00,'Trả lương nhân viên','2023-05-31 10:13:28','2023-05-31 10:48:36'),(11,5,2,5,2023,60000.00,2000.00,3000.00,4000.00,5000.00,600.00,7000.00,43600.00,'Trả lương nhân viên','2023-05-31 10:13:37','2023-05-31 10:48:30'),(14,4,NULL,3,2023,10000.00,2000.00,500.00,500.00,500.00,2000.00,1000.00,11500.00,'Good Job','2023-05-31 11:15:40','2023-05-31 11:15:40'),(15,5,2,3,2023,10000.00,2000.00,500.00,500.00,500.00,2000.00,1000.00,11500.00,'Good Job','2023-05-31 11:21:02','2023-05-31 11:21:02'),(16,1,2,3,2023,11000.00,2000.00,500.00,500.00,500.00,2000.00,1000.00,11500.00,'Good Job','2023-05-31 11:21:30','2023-05-31 11:21:30');
/*!40000 ALTER TABLE `ChiTietBangLuong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ChucVu`
--

DROP TABLE IF EXISTS `ChucVu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ChucVu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `chucVu` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ghiChu` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ChucVu`
--

LOCK TABLES `ChucVu` WRITE;
/*!40000 ALTER TABLE `ChucVu` DISABLE KEYS */;
INSERT INTO `ChucVu` VALUES (1,'Lập trình viên','Lập trình viên','2023-05-30 02:13:26','2023-05-30 02:13:26'),(2,'Bảo vệ','Bảo vệ','2023-05-30 02:13:26','2023-05-30 02:13:26');
/*!40000 ALTER TABLE `ChucVu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HoSoNV`
--

DROP TABLE IF EXISTS `HoSoNV`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `HoSoNV` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `hoTen` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `anhThe` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `gioiTinh` enum('1','2') COLLATE utf8mb3_unicode_ci NOT NULL,
  `ngaySinh` date NOT NULL,
  `diaChi` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `soDT` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `bangCap` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `soCMND` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `maHDLD` int unsigned NOT NULL,
  `maBHXH` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `maBHYT` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `maBHTN` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hosonv_mahdld_foreign` (`maHDLD`),
  CONSTRAINT `hosonv_mahdld_foreign` FOREIGN KEY (`maHDLD`) REFERENCES `HopDongLD` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HoSoNV`
--

LOCK TABLES `HoSoNV` WRITE;
/*!40000 ALTER TABLE `HoSoNV` DISABLE KEYS */;
INSERT INTO `HoSoNV` VALUES (1,'Bùi Huy Toàn','168554911620230531230516VKeiDcDp6Q48RiBwZtjzrZLfeJHuFCc1O6rUgIp5.png','2','2023-05-31','BN','00000000000000','ĐH','1111111111','trong@gmail.com',2,'3222222222222','44444444444','5555555555555','2023-05-31 16:05:16','2023-05-31 16:05:16'),(4,'Phan Văn ABC','16855189892023053114430977RM9cggQtvI9ZlYc3ndMeIrq6a3n5wSJrlx5Oiv.png','1','2023-05-01','HN 2','0350001111','Đại học','00000000','abcphanvan@gmail.com',2,'111111111111','222222222222','333333333333','2023-05-31 03:37:04','2023-05-31 07:43:09'),(5,'Nguyễn Trọng Nhân','1685518923202305311442030OFC5j1OOzgQXyZwnPCEpGl2h0emeurDY2D8lSx6.png','1','2023-05-01','HN','03311111111','Tiến sĩ','000000000001','trongnhan@gmail.com',1,'000000000002','000000000003','000000000004','2023-05-31 07:42:03','2023-05-31 07:42:03'),(6,'Bùi Huy Trọng','168554911620230531230516VKeiDcDp6Q48RiBwZtjzrZLfeJHuFCc1O6rUgIp5.png','2','2023-05-31','BN','00000000000000','ĐH','1111111111','trong@gmail.com',1,'3222222222222','44444444444','5555555555555','2023-05-31 16:05:16','2023-05-31 16:05:16');
/*!40000 ALTER TABLE `HoSoNV` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HopDongLD`
--

DROP TABLE IF EXISTS `HopDongLD`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `HopDongLD` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `maLHDLD` int unsigned NOT NULL,
  `maCV` int unsigned NOT NULL,
  `ngayKyHD` date NOT NULL,
  `ngayBD` date NOT NULL,
  `ngayKT` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hopdongld_malhdld_foreign` (`maLHDLD`),
  KEY `hopdongld_macv_foreign` (`maCV`),
  CONSTRAINT `hopdongld_macv_foreign` FOREIGN KEY (`maCV`) REFERENCES `ChucVu` (`id`),
  CONSTRAINT `hopdongld_malhdld_foreign` FOREIGN KEY (`maLHDLD`) REFERENCES `LoaiHDLD` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HopDongLD`
--

LOCK TABLES `HopDongLD` WRITE;
/*!40000 ALTER TABLE `HopDongLD` DISABLE KEYS */;
INSERT INTO `HopDongLD` VALUES (1,1,1,'2023-05-01','2023-05-02','2023-05-03','2023-05-30 10:02:19','2023-05-30 10:02:19'),(2,2,2,'2023-10-01','2023-11-01','2023-12-01','2023-05-30 10:37:44','2023-05-30 10:47:27'),(3,2,2,'2023-05-29','2023-05-30','2023-05-31','2023-05-30 10:42:39','2023-05-30 10:42:39');
/*!40000 ALTER TABLE `HopDongLD` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LoaiHDLD`
--

DROP TABLE IF EXISTS `LoaiHDLD`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `LoaiHDLD` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `tenLHDLD` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LoaiHDLD`
--

LOCK TABLES `LoaiHDLD` WRITE;
/*!40000 ALTER TABLE `LoaiHDLD` DISABLE KEYS */;
INSERT INTO `LoaiHDLD` VALUES (1,'Thử việc','2023-05-30 02:13:26','2023-05-30 02:13:26'),(2,'Chính thức','2023-05-30 02:13:26','2023-05-30 02:13:26');
/*!40000 ALTER TABLE `LoaiHDLD` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PhongBan`
--

DROP TABLE IF EXISTS `PhongBan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PhongBan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `tenPB` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `soDT` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `diaChi` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PhongBan`
--

LOCK TABLES `PhongBan` WRITE;
/*!40000 ALTER TABLE `PhongBan` DISABLE KEYS */;
INSERT INTO `PhongBan` VALUES (1,'Phòng IT','0350001111','HN','2023-05-30 15:34:47','2023-05-30 15:34:47'),(2,'Phòng MKT','0350001112','HN','2023-05-30 15:34:47','2023-05-30 15:34:47');
/*!40000 ALTER TABLE `PhongBan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `QTCongTac`
--

DROP TABLE IF EXISTS `QTCongTac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `QTCongTac` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `maNV` int unsigned NOT NULL,
  `maCV` int unsigned NOT NULL,
  `maPB` int unsigned NOT NULL,
  `ngayDenCT` date DEFAULT NULL,
  `ngayChuyenCT` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qtcongtac_macv_foreign` (`maCV`),
  KEY `qtcongtac_mapb_foreign` (`maPB`),
  KEY `qtcongtac_manv_foreign_idx` (`maNV`),
  CONSTRAINT `qtcongtac_macv_foreign` FOREIGN KEY (`maCV`) REFERENCES `ChucVu` (`id`),
  CONSTRAINT `qtcongtac_manv_foreign` FOREIGN KEY (`maNV`) REFERENCES `HoSoNV` (`id`),
  CONSTRAINT `qtcongtac_mapb_foreign` FOREIGN KEY (`maPB`) REFERENCES `PhongBan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `QTCongTac`
--

LOCK TABLES `QTCongTac` WRITE;
/*!40000 ALTER TABLE `QTCongTac` DISABLE KEYS */;
INSERT INTO `QTCongTac` VALUES (3,4,2,2,'2022-07-25','2022-09-25','2023-05-31 07:37:09','2023-05-31 10:12:58'),(4,4,1,1,'2022-02-01','2023-01-31','2023-05-31 07:37:46','2023-05-31 07:37:46'),(5,5,1,1,'2023-03-16','2023-07-16','2023-05-31 07:45:28','2023-05-31 10:10:37'),(6,1,1,2,'2022-05-01','2022-08-31','2023-05-31 10:09:31','2023-05-31 10:11:17');
/*!40000 ALTER TABLE `QTCongTac` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TaiKhoan`
--

DROP TABLE IF EXISTS `TaiKhoan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `TaiKhoan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `maNV` int unsigned DEFAULT NULL,
  `tenDN` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `matKhau` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `loaiTK` enum('NV_NHANSU','NV','NV_KETOAN','GIAMDOC') COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `taikhoan_manv_foreign` (`maNV`),
  CONSTRAINT `taikhoan_manv_foreign` FOREIGN KEY (`maNV`) REFERENCES `HoSoNV` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TaiKhoan`
--

LOCK TABLES `TaiKhoan` WRITE;
/*!40000 ALTER TABLE `TaiKhoan` DISABLE KEYS */;
INSERT INTO `TaiKhoan` VALUES (10,4,'abcphanvan@gmail.com','$2y$10$RL2u6FtUpLNmIAvXjlg3fevjlzEiJA5MMGPmXbQphMwKpAnlPvGM.','NV_KETOAN','2023-05-31 03:42:12','2023-05-31 07:42:55',NULL),(11,5,'trongnhan@gmail.com','$2y$10$4edleQ7FIcS8PthADtoE.uiy3SBXgEcRg0cNNLMbJKRudJkVsRMC2','NV','2023-05-31 07:42:21','2023-05-31 07:42:21',NULL),(12,1,'admin@gmail.com','$2y$10$4edleQ7FIcS8PthADtoE.uiy3SBXgEcRg0cNNLMbJKRudJkVsRMC2','NV','2023-05-31 16:05:32','2023-05-31 16:05:32','mtW7lIDmfrwnqSof0k0zIEzV2QxlzNBVpefHp9OAFNYak6ki28CtzuQZeAIg');
/*!40000 ALTER TABLE `TaiKhoan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (5,'2023_05_30_081631_create__loai_h_d_l_d_table',1),(6,'2023_05_30_081937_create__chuc_vu_table',1),(7,'2023_05_30_081941_create__hop_dong_l_d_table',1),(8,'2023_05_30_083523_create__tai_khoan_table',2),(9,'2023_05_30_083943_create__phong_ban_table',2),(10,'2023_05_30_084201_create__bang_luong_table',2),(11,'2023_05_30_084634_create__ho_so_n_v_table',2),(12,'2023_05_30_085251_create__q_t_cong_tac_table',2),(13,'2023_05_30_085557_create__chi_tiet_bang_luong_table',2),(18,'2023_05_30_222402_add_ma_n_v__tai_khoan_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-01  7:14:11
