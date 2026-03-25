-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 25-03-2026 a las 05:35:50
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `streetcrown`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Caps', 'Urban and casual caps', '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(2, 'Exclusive', 'Exclusive limited-edition products', '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(3, 'Sports', 'Caps for sports and outdoor activities', '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(4, 'Streetwear', 'Streetwear-inspired products', '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(5, 'Classic', 'Classic and timeless cap styles', '2026-03-25 07:59:48', '2026-03-25 07:59:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `quantity`, `price`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 347748, 1, 2, '2026-03-25 08:48:55', '2026-03-25 08:48:55'),
(2, 2, 159332, 2, 3, '2026-03-25 08:49:55', '2026-03-25 08:49:55'),
(3, 2, 350000, 3, 31, '2026-03-25 08:58:55', '2026-03-25 08:58:55'),
(4, 1, 175121, 4, 22, '2026-03-25 09:26:44', '2026-03-25 09:26:44'),
(5, 1, 159332, 4, 3, '2026-03-25 09:26:44', '2026-03-25 09:26:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_18_230747_create_categories_table', 1),
(5, '2026_03_18_230748_create_products_table', 1),
(6, '2026_03_18_230749_create_orders_table', 1),
(7, '2026_03_18_230750_create_items_table', 1),
(8, '2026_03_18_230751_create_reviews_table', 1),
(9, '2026_03_21_163624_add_stock_to_products_table', 1),
(10, '2026_03_22_000001_add_role_to_users_table', 1),
(11, '2026_03_24_030853_add_shipping_details_to_users_table', 1),
(12, '2026_03_24_create_wishlists_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `payment_method` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `total`, `payment_method`, `date`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 347748, 'cash', '2026-03-25', 'shipped', 1, '2026-03-25 08:48:55', '2026-03-25 08:48:55'),
(2, 318664, 'card', '2026-03-25', 'cancelled', 1, '2026-03-25 08:49:55', '2026-03-25 09:10:11'),
(3, 700000, 'cash', '2026-03-25', 'paid', 1, '2026-03-25 08:58:55', '2026-03-25 09:33:26'),
(4, 334453, 'transfer', '2026-03-25', 'paid', 2, '2026-03-25 09:26:44', '2026-03-25 09:33:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `exclusive` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `color` varchar(255) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `stock` int(11) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `size`, `brand`, `price`, `exclusive`, `image`, `description`, `color`, `discount`, `active`, `stock`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Laborum Id', 'S', 'New Era', 275395, 0, 'default-cap.jpg', 'Excepturi adipisci quas amet est quos voluptatem porro qui perferendis omnis facilis officia quis rerum.', 'black', 0, 0, 2, 4, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(2, 'Non Ea', 'M', 'New Era', 347748, 1, 'default-cap.jpg', 'Officia dolor non itaque necessitatibus ratione et reiciendis omnis consequatur et.', 'olive', 8, 1, 8, 2, '2026-03-25 07:59:48', '2026-03-25 08:48:55'),
(3, 'Quidem Quia', 'L', 'New Era', 159332, 1, 'default-cap.jpg', 'Corporis distinctio exercitationem vel eveniet eveniet reiciendis eum laboriosam quia dolor autem totam.', 'black', 0, 1, 8, 2, '2026-03-25 07:59:48', '2026-03-25 09:26:44'),
(4, 'Est Qui', 'M', 'New Era', 324890, 0, 'default-cap.jpg', 'Et eligendi sed qui facilis dolorum earum omnis alias natus magnam.', 'navy', 30, 1, 2, 4, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(5, 'Alias Tempore', 'M', 'Goorin Bros', 186093, 0, 'default-cap.jpg', 'Aliquid aut consequatur delectus nisi rem consectetur excepturi.', 'aqua', 13, 1, 11, 3, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(6, 'Non Nihil', 'L', 'Barbas Hat', 242504, 0, 'default-cap.jpg', 'Ipsa cupiditate a distinctio harum eveniet dolor explicabo officia.', 'navy', 0, 1, 0, 3, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(7, 'Quas Hic', 'XL', 'Goorin Bros', 86589, 1, 'default-cap.jpg', 'Non repudiandae dolores eveniet dolores facilis illo ducimus non ut nihil commodi eum ullam rem saepe.', 'teal', 20, 1, 20, 2, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(8, 'Quibusdam Sit', 'L', 'Clemont', 158080, 0, 'default-cap.jpg', 'Aut in ea rerum saepe veritatis illum molestiae culpa soluta.', 'navy', 8, 1, 4, 3, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(9, 'Quo Quia', 'S', 'Clemont', 236901, 0, 'default-cap.jpg', 'Aut officia repudiandae commodi minima et pariatur pariatur expedita quae et est explicabo voluptate nam.', 'aqua', 0, 1, 0, 3, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(10, 'Libero Deserunt', 'L', 'Barbas Hat', 62690, 0, 'default-cap.jpg', 'Possimus est aut ut sed doloribus ipsa impedit corporis.', 'lime', 0, 1, 11, 3, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(11, 'Ut Ut', 'S', 'New Era', 262791, 0, 'default-cap.jpg', 'Quaerat cupiditate voluptate vero quis assumenda tempora omnis rem voluptatem nemo qui soluta ducimus.', 'blue', 0, 1, 5, 3, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(12, 'Saepe Ut', 'L', 'Barbas Hat', 333382, 1, 'default-cap.jpg', 'Assumenda architecto culpa aut consequatur qui sit eum animi inventore autem autem aperiam sit.', 'black', 24, 1, 19, 2, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(13, 'Et Vel', 'M', 'Goorin Bros', 194441, 0, 'default-cap.jpg', 'Suscipit dolores et est eum neque non minus voluptatibus possimus.', 'silver', 28, 1, 6, 3, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(14, 'Voluptas Laboriosam', 'S', 'New Era', 277455, 0, 'default-cap.jpg', 'Odio tempora facilis aut sed iste et sit labore nulla.', 'silver', 7, 1, 11, 1, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(15, 'Et Rerum', 'L', 'Clemont', 89908, 0, 'default-cap.jpg', 'Dolor doloribus sit nihil officiis ut accusamus quia quod nihil ut nisi blanditiis nisi inventore non.', 'yellow', 0, 1, 14, 5, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(16, 'Voluptatibus Quasi', 'S', 'Amiri', 268444, 0, 'default-cap.jpg', 'Qui assumenda numquam numquam repellendus sed ex beatae.', 'fuchsia', 19, 1, 4, 4, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(17, 'Molestiae Vel', 'S', 'New Era', 108290, 1, 'default-cap.jpg', 'Porro provident aspernatur voluptatibus neque et sint cumque.', 'black', 0, 1, 10, 2, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(18, 'Iure Dignissimos', 'S', 'Clemont', 112332, 0, 'default-cap.jpg', 'Exercitationem possimus consequatur est est qui inventore accusamus ut minus quia qui ipsum autem dicta.', 'purple', 0, 1, 10, 3, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(19, 'Hic Impedit', 'XL', 'Goorin Bros', 335545, 0, 'default-cap.jpg', 'Deserunt qui et vitae aut dolore molestiae quia.', 'black', 14, 1, 0, 5, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(20, 'Saepe Explicabo', 'XL', 'Barbas Hat', 186866, 0, 'default-cap.jpg', 'Hic dolore tempore est iure dolor maiores magnam enim dolore nemo voluptas.', 'white', 0, 1, 20, 1, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(21, 'Minus Cumque', 'S', 'New Era', 183788, 0, 'default-cap.jpg', 'Perspiciatis eos dolores aspernatur distinctio a enim sed culpa explicabo id.', 'silver', 0, 1, 17, 4, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(22, 'Quo Laboriosam', 'L', 'Barbas Hat', 175121, 0, 'default-cap.jpg', 'Exercitationem aut suscipit iusto dolor amet repellendus mollitia.', 'silver', 0, 1, 8, 4, '2026-03-25 07:59:48', '2026-03-25 09:26:44'),
(23, 'Magni Pariatur', 'S', 'Goorin Bros', 187535, 0, 'default-cap.jpg', 'Consequuntur labore fugiat consectetur ratione dolores cupiditate voluptas quasi necessitatibus sit magni.', 'maroon', 19, 0, 15, 5, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(24, 'Recusandae Pariatur', 'S', 'New Era', 305989, 0, 'default-cap.jpg', 'Facilis qui quia aut praesentium consequuntur eaque voluptas labore sed voluptas aut voluptatem iusto unde.', 'blue', 21, 1, 16, 3, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(25, 'Molestiae Quibusdam', 'S', 'Amiri', 187100, 1, 'default-cap.jpg', 'Numquam unde ratione ut ipsum impedit qui mollitia.', 'maroon', 0, 1, 16, 2, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(26, 'Et Accusantium', 'M', 'Clemont', 284354, 0, 'default-cap.jpg', 'Et nihil nihil dolores eveniet quam veritatis repellat non dolorum vitae itaque fugit.', 'lime', 0, 1, 18, 4, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(27, 'Dolorem Enim', 'XL', 'Clemont', 276736, 0, 'default-cap.jpg', 'Qui reiciendis reiciendis nobis incidunt ex natus vitae id exercitationem sint.', 'olive', 0, 1, 10, 3, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(28, 'Quia Quia', 'L', 'Clemont', 192203, 1, 'default-cap.jpg', 'Rerum esse repellendus consequuntur cupiditate repellendus et dolor debitis at.', 'black', 0, 1, 1, 2, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(29, 'In Veritatis', 'XL', 'New Era', 68693, 0, 'default-cap.jpg', 'Eum autem et delectus rem sed expedita eaque consequatur provident natus facere cumque.', 'silver', 26, 1, 5, 5, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(30, 'Eum Ratione', 'L', 'Clemont', 178562, 0, 'default-cap.jpg', 'Eius qui expedita natus consequuntur laborum delectus rerum ut ut ut velit voluptatem voluptatem sapiente doloremque fuga.', 'blue', 25, 0, 10, 4, '2026-03-25 07:59:48', '2026-03-25 07:59:48'),
(31, 'GORRA INTARSIO GRIS CLEMONT', 'M', 'Clemont', 350000, 1, 'default-cap.jpg', 'aaaaaaaaa', 'GRIS', 15, 1, 0, 2, '2026-03-25 08:58:04', '2026-03-25 08:58:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 3, 'Tiene la horma medio rara', '2026-03-25 08:50:54', '2026-03-25 08:50:54'),
(2, 2, 31, 5, 'Hermosaaaa', '2026-03-25 09:24:28', '2026-03-25 09:24:28'),
(3, 2, 27, 3, 'Está bien, aunque la horma rara', '2026-03-25 09:25:03', '2026-03-25 09:25:03'),
(4, 2, 19, 1, 'No vale para nada la pena', '2026-03-25 09:25:22', '2026-03-25 09:25:22'),
(5, 1, 27, 1, 'Se ma dañó super rápido, terrible', '2026-03-25 09:34:18', '2026-03-25 09:34:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DrfEzugXQYNHElCTLDNlOt7ogJ8b6zgu2Bgc0WKO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1FhN1ZmVWxacUJCVlN2YklTWlZkeHAxUUNFek5HTW9qWGFaTlo0MCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiaG9tZS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1774407621),
('KWpVgWroRRbX2TkFYlxszr6uoKCRKXBsng80e3zm', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSEp1RllkOXNDVmhjNmpZcDJDRXdlMmt4UFNpdEU0Q1gwUHh0Tkt1MyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiaG9tZS5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1774413261);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `phone`, `address`, `city`, `postal_code`) VALUES
(1, 'Alyson Henao', 'alyson.cuentas@gmail.com', NULL, '$2y$12$e/VtiE0fgqvZtdhMhmXxSOE9ev3CWwgZvf1J8q8nC8dFeyoOCNJ2q', 'admin', NULL, '2026-03-25 08:01:36', '2026-03-25 08:48:55', '3214567890', 'Av 42 5313', 'Bello', '051050'),
(2, 'Samuel Moncada', 'samuel@gmail.com', NULL, '$2y$12$pdluW0tQiJMxh0xau0WJNuX7GXAwyyd7zKR6dPXyVOHuB3rlUdfEu', 'user', 'AKytkGv11Zq6HuGQaH3MbLMoiKK62JBQTvEP1GGsVwKjNE5G31plt5qCrlOc', '2026-03-25 09:23:26', '2026-03-25 09:26:44', '1234567890', 'Diag 110 #15-56', 'Medellín', '051050'),
(3, 'Emmanuel Cortes', 'emmanuel@gmail.com', NULL, '$2y$12$DVyZcWQAx2gmegZHX37Dluz5RwtnlhG6PVloMD1rsMZpLbi5REn5y', 'user', NULL, '2026-03-25 09:27:23', '2026-03-25 09:27:23', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2026-03-25 08:48:24', '2026-03-25 08:48:24'),
(2, 1, 31, '2026-03-25 08:58:26', '2026-03-25 08:58:26'),
(3, 2, 28, '2026-03-25 09:25:38', '2026-03-25 09:25:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_order_id_foreign` (`order_id`),
  ADD KEY `items_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
