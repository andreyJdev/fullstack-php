-- Adminer 4.8.1 MySQL 8.4.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `publication_date` datetime NOT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1',
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `message` (`id`, `content`, `publication_date`, `is_active`, `user_id`) VALUES
(1,	'Эти истории передавались из уст в уста, завораживая слушателей и вдохновляя их следовать своим мечтам и искать свои собственные приключения, зная, что мир полон чудес, ждущих своего открытия.',	'2024-09-19 21:31:18',	CONV('1', 2, 10) + 0,	4),
(2,	'Тогда публикуем!',	'2024-09-19 21:32:53',	CONV('1', 2, 10) + 0,	4),
(3,	'Каждая история наполняла читателя чудом и волнением, вдохновляя на новые открытия и приключения. Сокровища и древние артефакты, найденные в камере, освещались теплым золотым светом, создавая атмосферу волшебства и таинственности.',	'2024-09-19 21:29:56',	CONV('1', 2, 10) + 0,	1),
(4,	'Каждая история наполняла читателя чудом и волнением, вдохновляя на новые открытия и приключения. Сокровища и древние артефакты, найденные в камере, освещались теплым золотым светом, создавая атмосферу волшебства и таинственности.',	'2024-09-19 21:30:35',	CONV('1', 2, 10) + 0,	6),
(6,	'With her heart pounding in her chest, Elara approached the door and gently pushed it open. To her amazement, she found herself in a vast, underground chamber filled with treasures beyond her wildest dreams. There were piles of gold coins, sparkling jewels, and ancient artifacts, all bathed in a warm, golden light.',	'2024-09-19 21:35:24',	CONV('1', 2, 10) + 0,	3),
(7,	'На сегодня хватит.',	'2024-09-19 21:35:47',	CONV('1', 2, 10) + 0,	4),
(8,	'Мне тоже понравился!',	'2024-09-19 21:32:20',	CONV('1', 2, 10) + 0,	3),
(10,	'Я счистаю стоит добавить текст на английсокм языке',	'2024-09-19 21:33:41',	CONV('1', 2, 10) + 0,	1),
(11,	'Once upon a time, in a small village nestled between rolling hills and dense forests, there lived a young girl named Elara. Elara was known throughout the village for her boundless curiosity and adventurous spirit. She would often wander into the woods, exploring every nook and cranny, always in search of something new and exciting.',	'2024-09-19 21:34:12',	CONV('1', 2, 10) + 0,	3),
(12,	'One sunny afternoon, as Elara was exploring a part of the forest she had never ventured into before, she stumbled upon a hidden path. The path was overgrown with vines and bushes, almost as if it had been forgotten by time itself. Intrigued, Elara decided to follow it. The path twisted and turned, leading her deeper into the forest than she had ever been.',	'2024-09-19 21:34:30',	CONV('1', 2, 10) + 0,	3),
(13,	'After what felt like hours of walking, Elara emerged into a clearing. In the center of the clearing stood a magnificent tree, unlike any she had ever seen. Its trunk was wide and gnarled, and its branches stretched high into the sky, covered in leaves that shimmered with a golden hue. At the base of the tree, there was a small, ornate door.',	'2024-09-19 21:34:59',	CONV('1', 2, 10) + 0,	3),
(16,	'В маленькой деревушке, затерянной между холмами и густыми лесами, находилась тропинка, скрытая от глаз. Тропинка вела к поляне, где росло великолепное дерево с широким узловатым стволом и ветвями, покрытыми золотыми листьями. У основания дерева располагалась маленькая, изящная дверь, ведущая в подземную камеру, полную сокровищ.',	'2024-09-19 21:27:22',	CONV('1', 2, 10) + 0,	1),
(17,	'В центре камеры на пьедестале лежала древняя книга, украшенная драгоценными камнями. Страницы книги были заполнены историями о великих приключениях, магических существах и могущественных заклинаниях. Эти истории рассказывали о храбрых героях, отправившихся в эпические квесты, мудрых волшебниках, овладевших искусством магии, и мифических существах, бродящих по земле.',	'2024-09-19 21:28:30',	CONV('1', 2, 10) + 0,	2),
(18,	'Отличный текст!',	'2024-09-19 21:31:52',	CONV('1', 2, 10) + 0,	5);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userimage` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `perm_level` tinyint DEFAULT '1',
  `is_active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`id`, `email`, `username`, `password`, `userimage`, `perm_level`, `is_active`) VALUES
(1,	'1',	'Андрей Разработчик',	'',	'',	10,	CONV('1', 2, 10) + 0),
(2,	'2',	'Администратор сайта',	'',	'',	10,	CONV('1', 2, 10) + 0),
(3,	'3',	'Support',	'',	'',	7,	CONV('1', 2, 10) + 0),
(4,	'4',	'Community Manager',	'',	'',	5,	CONV('1', 2, 10) + 0),
(5,	'5',	'Аноним',	'',	'',	1,	CONV('1', 2, 10) + 0),
(6,	'6',	'Владелец блога',	'',	'',	4,	CONV('1', 2, 10) + 0),
(12,	'andrey.jdev@gmail.com',	'AndreyJdev',	'$2y$10$Apnq2ita/4rupxnKLeSateK8ruQEEhySTL6Tee4ApaNmnu1IWo9ba',	NULL,	10,	CONV('1', 2, 10) + 0);

-- 2024-09-21 15:02:54
