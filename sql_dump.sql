-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.30 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица bookeditor.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_user_id_foreign` (`user_id`),
  CONSTRAINT `books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы bookeditor.books: ~5 rows (приблизительно)
DELETE FROM `books`;
INSERT INTO `books` (`id`, `user_id`, `title`, `image`, `created_at`, `updated_at`) VALUES
	(2, 1, 'Мастер и Маргарита', '/imgs/books/covers/88b98252fd9c94aa868ff7d2a6915381.jpg', '2023-05-19 09:30:49', '2023-05-19 09:30:49'),
	(3, 1, 'Гарри Поттер и Орден Феникса', '/imgs/books/covers/5f8517a5a691eed7c197aafb67c135e9.png', '2023-05-19 09:36:15', '2023-05-19 09:36:15'),
	(8, 1, 'sdfsf', '/imgs/books/covers/7fb63213df0fa9cfe26b5b74a39bd6d1.png', '2023-06-07 13:55:10', '2023-06-07 13:55:10'),
	(11, 1, 'тест', '/imgs/books/covers/7fb63213df0fa9cfe26b5b74a39bd6d1.jpg', '2024-04-07 07:35:12', '2024-04-07 07:35:12'),
	(13, 1, 'dfgdfg', '/imgs/books/covers/1b3e21e99db9a4791e2feb70ff53d965.jpg', '2024-04-07 07:38:58', '2024-04-07 07:38:58');

-- Дамп структуры для таблица bookeditor.chapters
CREATE TABLE IF NOT EXISTS `chapters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint unsigned NOT NULL,
  `sort` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `short_text` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `chapters_book_id_foreign` (`book_id`),
  CONSTRAINT `chapters_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы bookeditor.chapters: ~4 rows (приблизительно)
DELETE FROM `chapters`;
INSERT INTO `chapters` (`id`, `book_id`, `sort`, `title`, `text`, `created_at`, `updated_at`, `short_text`) VALUES
	(1, 2, 1, 'Новая глава!', 'Привет!<div><br></div><div>Начинаю рассказ</div><div><br></div><div>Гарри Поттер и Гермиона Грейнджер&nbsp;</div><div><br></div><div><br></div><div>был Рон</div>', '2023-05-28 19:07:39', '2024-04-08 03:10:05', 'Пересказ главы!'),
	(2, 2, 2, 'Еще одна глава', '<br>', '2023-05-28 19:20:30', '2024-04-08 03:11:00', 'Другая глава'),
	(15, 8, 1, '3', '<br>', '2023-06-07 14:04:30', '2024-04-08 02:02:05', NULL),
	(17, 8, 2, '33', NULL, '2023-06-07 14:07:45', '2024-04-08 02:01:26', NULL),
	(19, 2, 3, 'третья', 'Текст главы<div><br></div><div>Рон</div><div>Гермиона</div>', '2024-04-08 03:36:57', '2024-04-08 03:39:20', 'Пересказ третьей главы!');

-- Дамп структуры для таблица bookeditor.characters
CREATE TABLE IF NOT EXISTS `characters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `info` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/imgs/books/characters/placeholder_character.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `x` int NOT NULL,
  `y` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `characters_book_id_foreign` (`book_id`),
  CONSTRAINT `characters_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы bookeditor.characters: ~3 rows (приблизительно)
DELETE FROM `characters`;
INSERT INTO `characters` (`id`, `book_id`, `first_name`, `last_name`, `age`, `info`, `image`, `created_at`, `updated_at`, `x`, `y`) VALUES
	(3, 2, 'Гермиона', 'Грейнджер', 96, 'Deleniti reprehender', '/imgs/books/characters/76c6c52813af91a17c554daa65fab385.png', '2023-05-22 10:49:11', '2024-04-07 06:39:36', 186, 165),
	(5, 2, 'Carly', 'Swanson', 71, 'Corporis minima saep', '/imgs/books/characters/7fb63213df0fa9cfe26b5b74a39bd6d1.png', '2023-05-22 11:14:53', '2024-03-23 08:14:26', 765, 126),
	(6, 2, 'Рон', 'Уизли', 60, 'Excepturi est nisi d', '/imgs/books/characters/998a6e4a8a6a6db6782aa501fdcc98aa.png', '2023-05-22 11:16:23', '2024-03-23 08:14:27', 744, 648),
	(7, 2, 'Гарри', 'Поттер', 25, 'Modi ut sunt qui in', '/imgs/books/characters/placeholder_character.png', '2023-05-26 17:38:34', '2024-04-07 06:39:45', 159, 597);

-- Дамп структуры для таблица bookeditor.colors
CREATE TABLE IF NOT EXISTS `colors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `colors_book_id_foreign` (`book_id`),
  CONSTRAINT `colors_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы bookeditor.colors: ~4 rows (приблизительно)
DELETE FROM `colors`;
INSERT INTO `colors` (`id`, `book_id`, `name`, `value`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Любовь', '#f6b73c', '2023-05-24 06:13:14', '2023-05-24 06:13:14'),
	(8, 2, 'Знакомые', '#0400f5', '2023-05-25 05:22:30', '2023-05-25 05:22:30'),
	(10, 2, 'Друзья', '#fbff00', '2023-05-25 13:04:00', '2023-05-25 13:04:00'),
	(12, 2, 'Враги', '#fe0b0b', '2023-06-01 19:48:54', '2023-06-01 19:48:54');

-- Дамп структуры для таблица bookeditor.links
CREATE TABLE IF NOT EXISTS `links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `character1_id` int NOT NULL,
  `color_id` bigint unsigned NOT NULL,
  `character2_id` int NOT NULL,
  `book_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `links_color_id_foreign` (`color_id`),
  KEY `links_book_id_foreign` (`book_id`),
  CONSTRAINT `links_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  CONSTRAINT `links_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы bookeditor.links: ~5 rows (приблизительно)
DELETE FROM `links`;
INSERT INTO `links` (`id`, `character1_id`, `color_id`, `character2_id`, `book_id`, `created_at`, `updated_at`) VALUES
	(5, 5, 1, 6, 2, '2023-05-25 10:11:40', '2023-05-25 10:11:40'),
	(9, 6, 10, 3, 2, '2023-05-25 13:04:09', '2023-05-25 13:04:09'),
	(10, 6, 8, 7, 2, '2023-05-26 18:57:32', '2023-05-26 18:57:32'),
	(12, 3, 12, 7, 2, '2023-06-01 19:49:06', '2023-06-01 19:49:06'),
	(13, 3, 8, 5, 2, '2024-03-24 03:29:16', '2024-03-24 03:29:16');

-- Дамп структуры для таблица bookeditor.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы bookeditor.migrations: ~7 rows (приблизительно)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(4, '2023_05_18_170158_create_users_table', 1),
	(7, '2023_05_18_203958_create_books_table', 2),
	(10, '2023_05_19_135720_create_characters_table', 3),
	(15, '2023_05_23_105225_create_colors_table', 4),
	(18, '2023_05_24_215143_create_links_table', 5),
	(19, '2023_05_25_083452_add_position_to_characters', 6),
	(21, '2023_05_28_212738_create_chapters_table', 7),
	(22, '2024_04_08_060732_add_short_text_to_chapters_table', 8);

-- Дамп структуры для таблица bookeditor.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы bookeditor.personal_access_tokens: ~0 rows (приблизительно)
DELETE FROM `personal_access_tokens`;

-- Дамп структуры для таблица bookeditor.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы bookeditor.users: ~0 rows (приблизительно)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `avatar`) VALUES
	(1, 'alex.z806@mail.ru', 'Пользователь', 'Зоткин', '$2y$10$GsQz.LsX3b8du4iC7KV4yu/sPDe4ZskSCxlBZW3Gub96bPNC.D0Ku', '/imgs/avatars/5.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
