-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for mutix
DROP DATABASE IF EXISTS `mutix`;
CREATE DATABASE IF NOT EXISTS `mutix` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `mutix`;

-- Dumping structure for table mutix.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `password_admin` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table mutix.bioskop
DROP TABLE IF EXISTS `bioskop`;
CREATE TABLE IF NOT EXISTS `bioskop` (
  `id_bioskop` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bioskop` varchar(50) NOT NULL,
  `banyak_ruangan` int(11) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  PRIMARY KEY (`id_bioskop`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table mutix.film
DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `judul_film` varchar(100) NOT NULL,
  `genre` int(11) NOT NULL,
  `durasi` time NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  PRIMARY KEY (`id_film`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table mutix.genre
DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `nama_genre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table mutix.genre_film
DROP TABLE IF EXISTS `genre_film`;
CREATE TABLE IF NOT EXISTS `genre_film` (
  `id_genre_film` int(11) NOT NULL AUTO_INCREMENT,
  `id_film` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  PRIMARY KEY (`id_genre_film`),
  KEY `FK_genre_film_film` (`id_film`),
  KEY `genre` (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table mutix.kursi
DROP TABLE IF EXISTS `kursi`;
CREATE TABLE IF NOT EXISTS `kursi` (
  `id_kursi` int(11) NOT NULL AUTO_INCREMENT,
  `id_ruangan` int(11) NOT NULL,
  `nama_kursi` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_kursi`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table mutix.ruangan
DROP TABLE IF EXISTS `ruangan`;
CREATE TABLE IF NOT EXISTS `ruangan` (
  `id_ruangan` int(11) NOT NULL AUTO_INCREMENT,
  `id_bioskop` int(11) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `baris` int(11) NOT NULL,
  `colom` int(11) NOT NULL,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table mutix.staff
DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id_staff` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `password_staff` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id_staff`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table mutix.tayang
DROP TABLE IF EXISTS `tayang`;
CREATE TABLE IF NOT EXISTS `tayang` (
  `id_tayang` int(11) NOT NULL AUTO_INCREMENT,
  `id_bioskop` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `dd/mm/yy` date NOT NULL,
  `hh/mm/ss` time NOT NULL,
  PRIMARY KEY (`id_tayang`),
  KEY `ruangan` (`id_ruangan`),
  KEY `bioskop` (`id_bioskop`),
  KEY `film` (`id_film`),
  CONSTRAINT `bioskop` FOREIGN KEY (`id_bioskop`) REFERENCES `bioskop` (`id_bioskop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ruangan` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table mutix.tiket
DROP TABLE IF EXISTS `tiket`;
CREATE TABLE IF NOT EXISTS `tiket` (
  `id_tiket` int(11) NOT NULL AUTO_INCREMENT,
  `id_bioskop` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `tot_harga` int(50) NOT NULL,
  PRIMARY KEY (`id_tiket`),
  KEY `FK_tiket_bioskop` (`id_bioskop`),
  KEY `FK_tiket_ruangan` (`id_ruangan`),
  KEY `FK_tiket_film` (`id_film`),
  CONSTRAINT `FK_tiket_bioskop` FOREIGN KEY (`id_bioskop`) REFERENCES `bioskop` (`id_bioskop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tiket_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tiket_ruangan` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table mutix.tiket_tayang
DROP TABLE IF EXISTS `tiket_tayang`;
CREATE TABLE IF NOT EXISTS `tiket_tayang` (
  `id_tiket_tayang` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `id_kursi` int(11) NOT NULL,
  PRIMARY KEY (`id_tiket_tayang`),
  KEY `tiket` (`id_tiket`),
  KEY `kursi` (`id_kursi`),
  CONSTRAINT `kursi` FOREIGN KEY (`id_kursi`) REFERENCES `kursi` (`id_kursi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tiket` FOREIGN KEY (`id_tiket`) REFERENCES `tiket` (`id_tiket`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table mutix.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `password_user` varchar(50) NOT NULL,
  `umur_user` int(11) NOT NULL,
  `rekening_user` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
