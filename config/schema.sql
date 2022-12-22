/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para kanastra
CREATE DATABASE IF NOT EXISTS `kanastra` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kanastra`;

-- Copiando estrutura para tabela kanastra.invoices
CREATE TABLE IF NOT EXISTS `invoices` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `debtId` int(11) NOT NULL,
    `governmentId` varchar(20) NOT NULL,
    `name` varchar(200) NOT NULL,
    `email` varchar(200) NOT NULL,
    `debtAmount` decimal(10,2) NOT NULL,
    `debtDueDate` date NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `debtId` (`debtId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando estrutura para tabela kanastra.log
CREATE TABLE IF NOT EXISTS `log` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `action` text NOT NULL,
    `dateTimeAction` datetime NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando estrutura para tabela kanastra.payments
CREATE TABLE IF NOT EXISTS `payments` (
    `debtId` int(11) NOT NULL,
    `paidAt` datetime DEFAULT NULL,
    `paidAmount` decimal(10,2) DEFAULT NULL,
    `paidBy` varchar(300) DEFAULT NULL,
    PRIMARY KEY (`debtId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
