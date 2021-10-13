-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 02, 2021 lúc 07:43 AM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hoahongmobile`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Xanh Dương', 'active', '2021-10-01 09:04:49', '2021-10-01 09:04:49'),
(2, 1, 'Bạc', 'active', '2021-10-01 09:05:43', '2021-10-01 09:05:43'),
(3, 1, 'Vàng Đồng', 'active', '2021-10-01 09:06:03', '2021-10-01 09:06:03'),
(4, 1, 'Xám', 'active', '2021-10-01 09:06:12', '2021-10-01 09:06:12'),
(5, 1, 'Đen', 'active', '2021-10-01 09:12:11', '2021-10-01 09:12:11'),
(6, 2, '4GB', 'active', '2021-10-01 09:12:50', '2021-10-01 09:12:50'),
(7, 2, '6GB', 'active', '2021-10-01 09:12:57', '2021-10-01 09:12:57'),
(8, 3, '128GB', 'active', '2021-10-01 09:13:40', '2021-10-01 09:13:40'),
(9, 3, '256GB', 'active', '2021-10-01 09:13:48', '2021-10-01 09:13:48'),
(10, 3, '512GB', 'active', '2021-10-01 09:13:58', '2021-10-01 09:13:58'),
(11, 3, '1TB', 'active', '2021-10-01 09:14:03', '2021-10-01 09:14:03'),
(12, 1, 'Trắng', 'active', '2021-10-01 10:12:23', '2021-10-01 10:12:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id`, `title`, `slug`, `photo`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Iphone 13 Series', 'iphone-13', 'images/banner/iPhone-13-Series-Banner.png', '<p><font color=\"#ffffff\">Mua iPhone 13 Series Chính Hãng VN/A</font></p>', 'active', '2021-10-01 07:57:26', '2021-10-01 09:26:45'),
(2, 'Samsung Z Fold 3', 'samsung-z-fold-3', 'images/banner/Samsung-z-fold-3-banner.jpg', '<p><font color=\"#ffffff\">Đặt hàng ngay để nhận ưu đãi hấp dẫn</font></p>', 'active', '2021-10-01 20:42:42', '2021-10-01 20:42:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'apple', 'active', '2021-10-01 08:38:59', '2021-10-01 08:38:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(11,2) NOT NULL,
  `status` enum('new','progress','delivered','cancel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `quantity` int(11) NOT NULL,
  `amount` double(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `order_id`, `product_variant_id`, `user_id`, `price`, `status`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 7, 2, 37700000.00, 'new', 1, 37700000.00, '2021-10-01 19:25:31', '2021-10-01 19:25:31'),
(4, 2, 2, NULL, 2, 147000.00, 'new', 2, 294000.00, '2021-10-01 19:29:54', '2021-10-01 19:30:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_parent` tinyint(1) NOT NULL DEFAULT 1,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `summary`, `photo`, `is_parent`, `parent_id`, `added_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại', 'dien-thoai', 'Điện thoại', 'images/category/điện thoại.png', 1, NULL, NULL, 'active', '2021-10-01 08:22:18', '2021-10-01 08:22:18'),
(2, 'iPhone', 'iphone', NULL, 'images/category/iphone.jpg', 0, 1, NULL, 'active', '2021-10-01 08:34:38', '2021-10-01 08:34:38'),
(3, 'Phụ kiện', 'phu-kien', '<p>Phụ kiện</p>', 'images/category/phụ kiện.png', 1, NULL, NULL, 'active', '2021-10-01 11:05:15', '2021-10-01 11:05:15'),
(4, 'Ốp lưng', 'op-lung', '<p>Ốp lưng</p>', 'images/category/ốp lưng.png', 0, 3, NULL, 'active', '2021-10-01 11:07:02', '2021-10-01 11:08:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('fixed','percent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `value` decimal(20,2) NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `name`, `subject`, `email`, `photo`, `phone`, `message`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'Anh Lê', 'Phản hồi sản phẩm', 'user@gmail.com', NULL, '0367378349', 'Sản phẩm ốp lưng iPhone 13 rất đẹp và chất lượng! Chúc cửa hàng buôn bán đắt hàng', '2021-10-01 19:40:55', '2021-10-01 19:36:02', '2021-10-01 19:40:55'),
(2, 'Thảo Lê', 'iPhone 13', 'thaole_xyz@gmail.com', NULL, '0366215326', 'Bao giờ iPhone 13 về hàng?', NULL, '2021-10-01 19:40:47', '2021-10-01 19:40:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_07_090117_create_messages_table', 1),
(6, '2021_09_08_041930_create_notifications_table', 1),
(7, '2021_09_09_023233_create_categories_table', 1),
(8, '2021_09_10_014846_create_brands_table', 1),
(9, '2021_09_10_022750_create_banners_table', 1),
(10, '2021_09_10_041052_create_shippings_table', 1),
(11, '2021_09_10_042218_create_coupons_table', 1),
(12, '2021_09_10_075412_create_post_categories_table', 1),
(13, '2021_09_10_075437_create_post_tags_table', 1),
(14, '2021_09_10_075512_create_posts_table', 1),
(15, '2021_09_11_040049_create_settings_table', 1),
(16, '2021_09_12_150716_create_product_attributes_table', 1),
(17, '2021_09_12_151145_create_attribute_values_table', 1),
(18, '2021_09_12_152657_create_products_table', 1),
(19, '2021_09_12_153023_create_products_attributes_values_table', 1),
(20, '2021_09_13_073111_create_product_variants_table', 1),
(21, '2021_09_14_070950_create_orders_table', 1),
(22, '2021_09_14_095916_create_carts_table', 1),
(23, '2021_09_14_100239_create_product_reviews_table', 1),
(24, '2021_09_14_100318_create_post_comments_table', 1),
(25, '2021_09_14_101331_create_wishlists_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('3c310455-e862-47a5-995a-2392a5f45f17', 'App\\Notifications\\StatusNotification', 'App\\Models\\User', 1, '{\"title\":\"New Product Rating!\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/product-detail\\/iphone-13-pro-max\",\"fas\":\"fa-star\"}', NULL, '2021-10-01 19:13:58', '2021-10-01 19:13:58'),
('485ce592-8497-4609-b7b2-8a61fc610718', 'App\\Notifications\\StatusNotification', 'App\\Models\\User', 1, '{\"title\":\"B\\u00ecnh lu\\u1eadn m\\u1edbi\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/blog-detail\\/iphone-13-moi-ra-mat-chip-moi-apple-a15-co-5-lua-chon-mau-sac\",\"fas\":\"fas fa-comment\"}', NULL, '2021-10-01 20:49:19', '2021-10-01 20:49:19'),
('59fa020d-79ae-456a-aa48-b576a0268d0c', 'App\\Notifications\\StatusNotification', 'App\\Models\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/2\",\"fas\":\"fa-file-alt\"}', NULL, '2021-10-01 19:30:51', '2021-10-01 19:30:51'),
('bfca7d7e-9544-40bf-990e-6aa8afe50ddf', 'App\\Notifications\\StatusNotification', 'App\\Models\\User', 1, '{\"title\":\"New Comment created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/blog-detail\\/iphone-13-moi-ra-mat-chip-moi-apple-a15-co-5-lua-chon-mau-sac\",\"fas\":\"fas fa-comment\"}', NULL, '2021-10-01 20:04:56', '2021-10-01 20:04:56'),
('fa789d89-6c16-4235-98c8-6ac1de09dd0c', 'App\\Notifications\\StatusNotification', 'App\\Models\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/1\",\"fas\":\"fa-file-alt\"}', NULL, '2021-10-01 19:27:44', '2021-10-01 19:27:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_total` double(11,2) NOT NULL,
  `shipping_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon` double(11,2) DEFAULT NULL,
  `total_amount` double(11,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_method` enum('cod','paypal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cod',
  `payment_status` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `status` enum('new','process','delivered','cancel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `sub_total`, `shipping_id`, `coupon`, `total_amount`, `quantity`, `payment_method`, `payment_status`, `status`, `first_name`, `last_name`, `email`, `phone`, `country`, `post_code`, `address1`, `address2`, `created_at`, `updated_at`) VALUES
(1, 'ORD-OBZXHR9N1S', 2, 37700000.00, 1, NULL, 37700000.00, 1, 'paypal', 'paid', 'process', 'Anh', 'Lê', 'user@gmail.com', '0367378349', 'VN', '24000', 'Thái Nguyên', 'SN67, tổ 2, phường Chùa Hang', '2021-10-01 19:27:42', '2021-10-01 19:46:41'),
(2, 'ORD-NMLDBYCXGL', 2, 294000.00, 1, NULL, 294000.00, 2, 'paypal', 'paid', 'delivered', 'Anh', 'Lê', 'user@gmail.com', '0367378349', 'VN', '24000', 'Thái Nguyên', 'SN67, tổ 2, phường Chùa Hang', '2021-10-01 19:30:51', '2021-10-01 19:46:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quote` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_tag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `summary`, `description`, `quote`, `photo`, `tags`, `post_cat_id`, `post_tag_id`, `added_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'iPhone 13 mới ra mắt : chip mới Apple A15, có 5 lựa chọn màu sắc', 'iphone-13-moi-ra-mat-chip-moi-apple-a15-co-5-lua-chon-mau-sac', '<h2 style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 16px; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif; outline: none;\"><font color=\"#333333\">Trong sự kiện Apple Event 0h ngày 15/09/2021,&nbsp;</font><span style=\"transition-duration: 0.2s; transition-property: all; font-stretch: normal; line-height: 24.8px; outline-color: initial; outline-width: initial;\"><font color=\"#000000\">Apple</font></span><font color=\"#333333\">&nbsp;đã chính thức ra mắt dòng&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all; font-stretch: normal; line-height: 24.8px; outline-color: initial; outline-width: initial;\">điện thoại&nbsp;iPhone 13</span></font><font color=\"#333333\">&nbsp;trước sự mong đợi của iFan toàn cầu.&nbsp;iPhone 13 - Một trong những chiếc Flagship đáng được mong đợi nhất trong năm 2021.&nbsp;Cùng điểm qua những thông số nổi bật, các phiên bản và giá bán trong bài viết dưới đây nhé!&nbsp;</font></h2>', '<h3 id=\"hmenuid2\" style=\"margin: 15px 0px 10px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 20px; line-height: 31px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Thiết kế và cấu hình vượt trội của iPhone 13</h3><h4 id=\"hmenuid3\" style=\"margin: 30px auto 18px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 16px; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Nâng cấp thiết kế tạo nên xu hướng mới</h4><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Theo trang&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all;\">Mac Otakara</span></font><font color=\"#333333\">&nbsp;của Nhật Bản, những chiếc iPhone mới sẽ có cùng kích thước với các mẫu iPhone 12, nhưng độ dày có thể tăng thêm khoảng&nbsp;</font><strong style=\"color: rgb(51, 51, 51); margin: 0px; padding: 0px;\">0,26 mm</strong><font color=\"#333333\">. Các mẫu iPhone 13 cũng được cho là sẽ nặng hơn một chút do có pin lớn hơn.</font></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><span style=\"color: rgb(51, 51, 51);\">Nhà phân tích nổi tiếng</span><font color=\"#000000\">&nbsp;<font style=\"\"><span style=\"transition-duration: 0.2s; transition-property: all;\">Ming-Chi Kuo</span></font></font><font color=\"#333333\">&nbsp;tuyên bố rằng Apple sẽ xuất xưởng iPhone 13 với notch (tai thỏ) nhỏ gọn hơn, tận dụng không gian tiết kiệm được để tăng dung lượng pin cho máy.</font></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><img alt=\"Nâng cấp thiết kế tạo nên xu hướng mới\" title=\"Nâng cấp thiết kế tạo nên xu hướng mới\" class=\"lazy\" data-src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone.jpg\" src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone.jpg\" style=\"margin: 10px auto; padding: 0px 0px 10px; border: 0px; display: block; max-width: 100%; height: 411px; width: 730px; opacity: 1;\"></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Bên cạnh đó, Apple lại vừa mới nhận thêm một bằng sáng chế từ&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all;\">Văn phòng Nhãn hiệu và Bằng sáng chế Hoa Kỳ</span></font><font color=\"#333333\">&nbsp;về cảm biến quang học tích hợp vào tấm nền điện thoại. Có khả năng cảm biến này đóng vai trò là bộ phận quét vân tay và tạo bản đồ 3D của khuôn mặt. Thậm chí có thể tùy biến thành camera selfie.</font></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\">Nói cách khác, đây có thể trở thành tính năng Touch ID, Face ID và cả camera selfie bên dưới màn hình. Tuy nhiên, theo nhiều nguồn thông tin thì công nghệ này có thể chưa xuất hiện trong loạt iPhone 13 sắp ra mắt.</p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><img alt=\"Tính năng Touch ID có thể chưa xuất hiện trong loạt iPhone 13 sắp ra mắt\" height=\"424\" title=\"Tính năng Touch ID có thể chưa xuất hiện trong loạt iPhone 13 sắp ra mắt\" width=\"730\" class=\"lazy\" data-src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-15.jpg\" src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-15.jpg\" style=\"margin: 10px auto; padding: 0px 0px 10px; border: 0px; display: block; max-width: 100%; height: auto !important; opacity: 1;\"></p><h4 id=\"hmenuid4\" style=\"margin: 30px auto 18px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 16px; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Trang bị màn hình ProMotion OLED 120Hz</h4><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\">Nhiều khả năng Apple sẽ sử dụng tấm nền&nbsp;<strong style=\"margin: 0px; padding: 0px;\">ProMotion OLED 120Hz</strong>&nbsp;trên iPhone 13 Pro và iPhone 13 Pro Max. Điều này sẽ cho phép công ty phân loại tốt hơn các phiên bản Pro của mình so với các phiên bản còn lại. Apple cũng sẽ sử dụng&nbsp;<strong style=\"margin: 0px; padding: 0px;\">màn hình cảm ứng on-cell</strong>&nbsp;trên cả 4 mẫu iPhone 13.&nbsp;</p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Có nhiều tin đồn rằng Apple sẽ sử dụng tấm nền&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all;\">OLED 120Hz</span></font><font color=\"#333333\">&nbsp;trên iPhone 12, nhưng điều đó đã không xảy ra. Tuy nhiên, vào thời điểm iPhone 13 ra mắt vào năm nay, công nghệ đằng sau tấm nền&nbsp;</font><span style=\"transition-duration: 0.2s; transition-property: all;\"><font color=\"#000000\">LTPO OLED</font></span><font color=\"#333333\">&nbsp;với tốc độ làm mới 120Hz động sẽ hoàn thiện hơn, cho phép Apple áp dụng nó trên iPhone.</font></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><img alt=\"Trang bị màn hình ProMotion OLED 120Hz\" data-src=\"https://cdn.tgdd.vn/Files/2021/03/02/1332048/xx-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphon.jpg\" title=\"Trang bị màn hình ProMotion OLED 120Hz\" class=\"lazy\" src=\"https://cdn.tgdd.vn/Files/2021/03/02/1332048/xx-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphon.jpg\" style=\"margin: 10px auto; padding: 0px 0px 10px; border: 0px; display: block; max-width: 100%; height: 410px; width: 730px; opacity: 1;\"></p><h4 id=\"hmenuid5\" style=\"margin: 30px auto 18px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 16px; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Camera được hoàn thiện, đem lại trải nghiệm tốt nhất</h4><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\">Nếu trước đó, camera chính được nâng lên trên bề mặt của bảng điều khiển phía sau và các ống kính riêng lẻ nhô ra cao hơn thì giờ đây, toàn bộ cụm camera sẽ được bao phủ bởi một lớp kính bảo vệ chung.&nbsp;</p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\">Điều này sẽ cho phép người dùng có thể làm sạch các camera bằng một thao tác chuyển động mà không cần phải lau từng mô-đun một.</p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><img alt=\"Cụm camera iPhone 13 sẽ được bao phủ bởi một lớp kính bảo vệ chung\" height=\"365\" title=\"Cụm camera iPhone 13 sẽ được bao phủ bởi một lớp kính bảo vệ chung\" width=\"730\" class=\"lazy\" data-src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-18.jpg\" src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-18.jpg\" style=\"margin: 10px auto; padding: 0px 0px 10px; border: 0px; display: block; max-width: 100%; height: auto !important; opacity: 1;\"></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Nhà phân tích Ming-Chi Kuo của Apple đã đưa ra dự đoán các mẫu iPhone 13 Pro, Apple sẽ mang đến một số cải tiến lớn cho camera góc siêu rộng. Chúng sẽ có&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all;\">khẩu độ</span></font><font color=\"#333333\">&nbsp;f/1.8 rộng hơn nhiều với ống kính 6P. Cảm biến mới cũng sẽ có tính năng&nbsp;</font><span style=\"transition-duration: 0.2s; transition-property: all;\"><font color=\"#000000\">tự động lấy nét</font></span><font color=\"#333333\">&nbsp;để cho phép chụp ảnh macro. Apple cũng sẽ sử dụng thiết lập góc siêu rộng tương tự trên dòng iPhone 14 năm 2022 của mình.</font></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Một báo cáo mới từ DigiTimes tuyên bố rằng toàn bộ dòng sản phẩm iPhone 13 dự kiến ​​sẽ sử dụng&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all;\">máy quét LiDar</span></font><font color=\"#333333\">&nbsp;và sẽ không giới hạn ở các mẫu Pro.</font></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><img alt=\"Máy quét LiDAR trên iPhone\" title=\"Máy quét LiDAR trên iPhone\" class=\"lazy\" data-src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-3.jpg\" src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-3.jpg\" style=\"margin: 10px auto; padding: 0px 0px 10px; border: 0px; display: block; max-width: 100%; height: 382px; width: 730px; opacity: 1;\"></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\">Máy quét LiDAR trên iPhone không chỉ cải thiện khả năng phát hiện độ sâu cho máy ảnh mà còn chứng tỏ độ chính xác cao đối với Thực tế tăng cường. Apple gần đây đã tập trung rất nhiều vào AR và đó có thể là một trong những lý do để tích hợp cảm biến trên toàn bộ dòng sản phẩm trong năm nay.</p><h4 id=\"hmenuid6\" style=\"margin: 30px auto 18px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 16px; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Chip Apple A15 Bionic giúp tối ưu hiệu năng sử dụng</h4><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Nhiều thông tin cho rằng thế hệ iPhone 13 năm nay vẫn sử dụng chip quen thuộc đó là chip&nbsp;</font><strong style=\"color: rgb(51, 51, 51); margin: 0px; padding: 0px;\">Apple A15 Boinoic</strong><font color=\"#333333\">. Con chip được xây dựng dựa trên thế hệ thứ hai của&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all;\">TSMC</span></font><font color=\"#333333\">&nbsp;giúp tối ưu điện năng và nâng cao năng suất của 5G.</font></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\">Đồng thời, Apple cũng nâng cấp dung lượng pin của iPhone 13 Pro Max lên tới&nbsp;<strong style=\"margin: 0px; padding: 0px;\">4.352 mAh</strong>&nbsp;giúp cho sản phẩm có thể dùng pin lâu hơn.</p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><img alt=\"Chip Apple A15 Bionic\" height=\"486\" title=\"Chip Apple A15 Bionic\" width=\"730\" class=\"lazy\" data-src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-6.jpg\" src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-6.jpg\" style=\"margin: 10px auto; padding: 0px 0px 10px; border: 0px; display: block; max-width: 100%; height: auto !important; opacity: 1;\"></p><h4 id=\"hmenuid7\" style=\"margin: 30px auto 18px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 16px; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Hỗ trợ Wifi 6E và băng tần mmWave 5G tốc độ cao</h4><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Các tin đồn cho thấy một số iPhone 2021 có thể&nbsp;hỗ trợ băng tần&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all;\">5G</span></font><font color=\"#333333\">&nbsp;đơn lẻ, hoạt động trên&nbsp;mạng mmWave hoặc mạng dưới 6GHz, nhưng không phải cả hai, cho phép Apple tiết kiệm tiền ở những quốc gia không có mạng 5G mmWave. Ở các quốc gia phát triển hơn như Úc, Canada, Nhật Bản và các quốc gia EU khác, công nghệ mmWave 5G nhanh hơn&nbsp;chắc chắn sẽ được hỗ trợ.</font></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Các nhà phân tích của Barclays tin rằng các mẫu iPhone 13&nbsp;sẽ hỗ trợ&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all;\">WiFi 6E</span></font><font color=\"#333333\">, cung cấp các tính năng và khả năng của&nbsp;</font><span style=\"transition-duration: 0.2s; transition-property: all;\"><font color=\"#000000\">WiFi 6</font></span><font color=\"#333333\">&nbsp;được mở rộng sang băng tần 6GHz.&nbsp;WiFi 6 cung cấp hiệu suất cao hơn, độ trễ thấp hơn và tốc độ dữ liệu nhanh hơn, trong khi phổ bổ sung của WiFi 6E cung cấp băng thông rộng hơn so với các băng tần WiFi 2,4 và 5GHz hiện có.</font></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><img alt=\"Hỗ trợ Wifi 6E\" title=\"Hỗ trợ Wifi 6E,\" class=\"lazy\" data-src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-2.jpg\" src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-2.jpg\" style=\"margin: 10px auto; padding: 0px 0px 10px; border: 0px; display: block; max-width: 100%; height: 315px; width: 730px; opacity: 1;\"></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Theo&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all;\">Jon Presser,&nbsp;</span></font><font color=\"#333333\">bên cạnh một mẫu iPhone 13 không có cổng kết nối, các model còn lại vẫn dùng cổng Lightning truyền thống. Trước đây, đã có tin đồn Táo Khuyết cũng có kế hoạch trình làng một chiếc&nbsp;iPhone&nbsp;không có cổng kết nối thay vì cổng sạc&nbsp;</font><span style=\"transition-duration: 0.2s; transition-property: all;\"><font color=\"#000000\">USB Type C</font></span><font color=\"#333333\">&nbsp;như các mẫu&nbsp;điện thoại&nbsp;Android khác.</font></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><img alt=\"Dòng iPhone 13 sẽ có ít nhất một mẫu không có cổng kết nối\" height=\"411\" title=\"Dòng iPhone 13 sẽ có ít nhất một mẫu không có cổng kết nối\" width=\"730\" class=\"lazy\" data-src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-17.jpg\" src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-17.jpg\" style=\"margin: 10px auto; padding: 0px 0px 10px; border: 0px; display: block; max-width: 100%; height: auto !important; opacity: 1;\"></p><h4 id=\"hmenuid8\" style=\"margin: 30px auto 18px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 16px; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Sạc ngược không dây nhanh hơn</h4><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Theo như các thông tin có từ cơ quan FCC, iPhone 13 năm nay vẫn hỗ trợ tính năng sạc ngược không dây nhanh hơn. Tài liệu từ FCC cho hay iPhone thế hệ mới năm nay tương thích tốt với các&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all;\">chuẩn sạc Qi</span></font><font color=\"#333333\">&nbsp;và cả tính năng sạc ở 360 kHz, hay còn hiểu là có thể sạc ngược được cho các loại phụ kiện không dây khác.</font></p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><img alt=\"Sạc ngược không dây nhanh hơn\" height=\"487\" title=\"Sạc ngược không dây nhanh hơn\" width=\"730\" class=\"lazy\" data-src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-20.jpg\" src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-20.jpg\" style=\"margin: 10px auto; padding: 0px 0px 10px; border: 0px; display: block; max-width: 100%; height: auto !important; opacity: 1;\"></p><h4 id=\"hmenuid9\" style=\"margin: 30px auto 18px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 16px; line-height: 24.8px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Dung lượng lưu trữ lên đến 1TB</h4><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\">Theo báo cáo mới nhất, Apple có thể tung ra biến thể<strong style=\"margin: 0px; padding: 0px;\">&nbsp;lưu trữ 1TB</strong>&nbsp;cho dòng iPhone 13 Pro vào cuối năm nay. Đây là mức dung lượng lưu trữ gấp đôi khi so sánh với model có bộ nhớ trong cao nhất trong dòng iPhone 12 hiện tại. iPhone XS là điện thoại đầu tiên của Apple đi kèm với bộ nhớ trong 512GB và kể từ đó, công ty tiếp tục ra mắt phiên bản này cho dòng iPhone 11 và iPhone 12.</p><p style=\"margin: 12px 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; color: rgb(51, 51, 51); line-height: 24.8px; font-family: Arial, Helvetica, sans-serif;\"><img alt=\"iPhone 13 sở hữu dung lượng lưu trữ lên đến 1TB\" height=\"392\" title=\"iPhone 13 sở hữu dung lượng lưu trữ lên đến 1TB\" width=\"730\" class=\"lazy\" data-src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-19.jpg\" src=\"https://cdn.tgdd.vn/Files/2021/03/05/1332649/6-dieu-dang-mong-doi-o-sieu-pham-iphone-13-iphone-19.jpg\" style=\"margin: 10px auto; padding: 0px 0px 10px; border: 0px; display: block; max-width: 100%; height: auto !important; opacity: 1;\"></p>', NULL, 'images/post/iPhone13-ra-mat.jpg', 'Điện thoại,iPhone 13', 1, NULL, 1, 'active', '2021-10-01 19:57:16', '2021-10-01 20:39:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_categories`
--

INSERT INTO `post_categories` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại', 'dien-thoai', 'active', '2021-10-01 19:51:04', '2021-10-01 19:51:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `replied_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_comments`
--

INSERT INTO `post_comments` (`id`, `user_id`, `post_id`, `comment`, `status`, `replied_comment`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Bài viết rất hữu ích', 'active', NULL, NULL, '2021-10-01 20:04:56', '2021-10-01 20:04:56'),
(2, 2, 1, 'Quá đáng mua, tôi sẽ mua nó', 'active', NULL, NULL, '2021-10-01 20:49:19', '2021-10-01 20:49:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_tags`
--

CREATE TABLE `post_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_tags`
--

INSERT INTO `post_tags` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại', 'dien-thoai', 'active', '2021-10-01 19:51:17', '2021-10-01 19:51:17'),
(2, 'iPhone 13', 'iphone-13', 'active', '2021-10-01 19:51:28', '2021-10-01 19:51:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `condition` enum('default','new','hot') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `price` double(11,2) NOT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `child_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `title`, `sku`, `slug`, `summary`, `description`, `photo`, `stock`, `condition`, `status`, `price`, `discount`, `is_featured`, `cat_id`, `child_cat_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 'iPhone 13 Pro Max', 'iP13ProMax', 'iphone-13-pro-max', '<p><font color=\"#444444\" face=\"sans-serif\"><span style=\"font-size: 14px;\">Màn hình: OLED6.7\"Super Retina XDR</span></font></p><p><font color=\"#444444\" face=\"sans-serif\"><span style=\"font-size: 14px;\">Camera sau: 3 camera 12 MP. Camera trước:12 MP</span></font></p><p><font color=\"#444444\" face=\"sans-serif\"><span style=\"font-size: 14px;\">Chip: Apple A15 Bionic</span></font></p><p><font color=\"#444444\" face=\"sans-serif\"><span style=\"font-size: 14px;\">RAM: 6GB</span></font></p><p><font color=\"#444444\" face=\"sans-serif\"><span style=\"font-size: 14px;\">Hệ điều hành: iOS 15</span></font></p><p><font color=\"#444444\" face=\"sans-serif\"><span style=\"font-size: 14px;\">SIM: 1 Nano SIM &amp; 1 eSIMHỗ trợ 5G</span></font><br></p><p><span style=\"color: rgb(68, 68, 68); font-family: sans-serif; font-size: 14px;\"><br></span></p>', '<h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\"><div style=\"\"><span style=\"font-size: 20px; font-weight: bold;\">Thiết kế đẳng cấp hàng đầu</span><br></div></h3><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif;\"><span style=\"color: rgb(51, 51, 51);\">iPhone mới kế thừa thiết kế đặc trưng từ</span><font color=\"#000000\" style=\"background-color: rgb(255, 255, 255);\">&nbsp;<font style=\"\"><span style=\"transition-duration: 0.2s; transition-property: all;\">iPhone 12 Pro Max</span></font></font><font color=\"#333333\">&nbsp;khi sở hữu khung viền vuông vức, mặt lưng kính cùng màn hình tai thỏ tràn viền nằm ở phía trước.</font></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Với iPhone 13 Pro Max phần tai thỏ đã được thu gọn lại 20% so với thế hệ trước, không chỉ giải phóng nhiều không gian hiển thị hơn mà còn giúp mặt trước chiếc&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all; background-color: rgb(255, 255, 255);\">điện thoại</span></font><font color=\"#333333\">&nbsp;trở nên hấp dẫn hơn mà vẫn đảm bảo được hoạt động của các cảm biến.</font></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\"><a class=\"preventdefault\" href=\"https://www.thegioididong.com/images/42/230529/iphone-moi-2021-04.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"><img alt=\"iPhone mới | Thiết kế vuông vức\" data-src=\"https://cdn.tgdd.vn/Products/Images/42/230529/iphone-moi-2021-04.jpg\" class=\" ls-is-cached lazyloaded\" title=\"iPhone mới | Thiết kế vuông vức\" src=\"https://cdn.tgdd.vn/Products/Images/42/230529/iphone-moi-2021-04.jpg\" style=\"margin: 20px auto; padding: 0px; border: 0px; max-width: 100%; display: block; height: auto !important;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Điểm thay đổi dễ dàng nhận biết trên iPhone 13 Pro Max chính là kích thước của cảm biến camera sau được làm to hơn và để tăng độ nhận diện cho sản phẩm mới thì Apple cũng đã bổ sung một tùy chọn màu sắc&nbsp;Sierra Blue (màu xanh dương nhạt hơn so với Pacific Blue của iPhone 12 Pro Max).</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Máy vẫn tiếp tục sử dụng khung viền thép cao cấp cho khả năng chống trầy xước và va đập một cách vượt trội, kết hợp với khả năng&nbsp;</font><font color=\"#000000\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; background-color: rgb(255, 255, 255);\">kháng bụi, nước</font><font color=\"#333333\">&nbsp;chuẩn IP68.</font></p><h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 20px; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Màn hình giải trí siêu mượt cùng tần số quét 120 Hz</h3><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">iPhone 13 Pro Max được trang bị màn hình kích thước 6.7 inch cùng độ phân giải 1284 x 2778 Pixels, sử dụng tấm nền OLED cùng công nghệ Super Retina XDR cho khả năng tiết kiệm năng lượng vượt trội nhưng vẫn đảm bảo hiển thị sắc nét sống động chân thực.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">iPhone Pro Max năm nay đã được nâng cấp lên tần số quét 120 Hz, mọi thao tác chuyển cảnh khi lướt ngón tay trên màn hình trở nên mượt mà hơn đồng thời hiệu ứng thị giác khi chúng ta chơi game hoặc xem video cũng cực kỳ mãn nhãn.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Cùng công nghệ ProMotion thông minh có thể thay đổi tần số quét từ 10 đến 120 lần mỗi giây tùy thuộc vào ứng dụng, thao tác bạn đang sử dụng, nhằm tối ưu thời lượng sử dụng pin và trải nghiệm của bạn.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\"><a class=\"preventdefault\" href=\"https://www.thegioididong.com/images/42/230529/iphone-moi-2021-06.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"><img alt=\"iPhone mới | Hỗ trợ tần số quét cao 120 Hz\" data-src=\"https://cdn.tgdd.vn/Products/Images/42/230529/iphone-moi-2021-06.jpg\" class=\" ls-is-cached lazyloaded\" title=\"iPhone mới | Hỗ trợ tần số quét cao 120 Hz\" src=\"https://cdn.tgdd.vn/Products/Images/42/230529/iphone-moi-2021-06.jpg\" style=\"margin: 20px auto; padding: 0px; border: 0px; max-width: 100%; display: block; height: auto !important;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Nếu bạn dùng iPhone 13 Pro Max để chơi game, tần số quét 120 Hz kết hợp hiệu suất đồ họa tuyệt vời của GPU sẽ khiến máy trở nên vô cùng hoàn hảo khi trải nghiệm.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Ngoài ra máy cũng hỗ trợ công nghệ True Tone, dải màu rộng chuẩn điện ảnh P3 sẽ cho mọi trải nghiệm của bạn trên máy trở nên ấn tượng hơn bao giờ hết.</p><h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 20px; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Cụm camera được nâng cấp toàn diện</h3><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">iPhone 13 Pro Max vẫn sẽ có bộ camera 3 ống kính xếp xen kẽ thành một cụm vuông, đặt ở góc trên bên trái của lưng máy gồm&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all; background-color: rgb(255, 255, 255);\">camera telephoto</span></font><font color=\"#333333\">, camera&nbsp;</font><font color=\"#2f80ed\" style=\"color: rgb(51, 51, 51);\"><span style=\"transition-duration: 0.2s; transition-property: all;\">góc siêu rộng</span></font><font color=\"#333333\">&nbsp;và camera chính góc rộng với khẩu độ f/1.5 siêu lớn.</font></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Camera góc siêu rộng cũng được nâng cấp với khẩu độ f/1.8, cảm biến nhanh hơn, mang tới những bức ảnh góc siêu rộng tự nhiên và chân thực và còn tăng cường có khả năng lấy nét ở khoảng cách chỉ 2 cm, mang đến tính năng chụp ảnh quay phim macro đầy thú vị.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Camera tele trên iPhone 13 Pro Max có thể zoom quang học 3x, phóng to hình ảnh và video gấp 3 lần nhưng vẫn giữ nguyên chất lượng, hỗ trợ chụp ảnh chân dung&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all; background-color: rgb(255, 255, 255);\">xóa phông</span></font><font color=\"#333333\">, tích hợp sẵn rất nhiều bộ lọc màu tự nhiên giúp có được bức ảnh đúng như ý muốn.</font></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Bên cạnh đó, cảm biến LiDAR vẫn sẽ hiện diện trên iPhone 13 Pro Max nhằm mang đến trải nghiệm thực tế tăng cường (AR) tốt nhất cho tất cả người dùng cũng như hỗ trợ cho cụm camera lấy nét trong môi trường ánh sáng yếu.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Apple còn tăng cường khả năng nhíp ảnh trên iPhone 13 Pro Max với chế độ quay phim chuẩn điện ảnh Cinematic&nbsp;giúp người dùng có thể dễ dàng lấy nét vào chủ thể cả trong và sau khi quay, đồng thời làm mờ hậu cảnh và những nhân vật khác trong khung hình.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Đây cũng là chiếc điện thoại thông minh đầu tiên cung cấp quy trình làm việc chuyên nghiệp \"end-to-end\"&nbsp;cho phép bạn ghi và chỉnh sửa video ở định dạng nén ProRes hoặc Dolby Vision với nhiều thiết lập chuyên sâu&nbsp;tạo&nbsp;giúp rút ngắn đáng kể quá trình hậu kỳ tạo nên những thước phim chất lượng đáng kinh ngạc ngay trên chính chiếc điện thoại của mình.</p><h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 20px; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Hiệu năng đầy hứa hẹn với Apple A15 Bionic&nbsp;</h3><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">iPhone 13 Pro Max sẽ được trang bị bộ vi xử lý Apple A15 Bionic mới nhất của hãng, được sản xuất trên tiến trình 5nm+, đảm bảo mang lại hiệu năng vận hành ấn tượng mà vẫn tiết kiệm điện tốt nhất cùng khả năng hỗ trợ mạng 5G tốc độ siêu cao.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Theo Apple công bố, A15 Bionic là chipset nhanh nhất trong thế tới smartphone (9/2021), có&nbsp;tốc độ nhanh hơn 50% so với các chip khác trên thị trường, có thể thực hiện 15.8 nghìn tỉ phép tính&nbsp; mỗi giây, giúp hiệu năng CPU nhanh hơn bao giờ hết.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\"><a class=\"preventdefault\" href=\"https://www.thegioididong.com/images/42/230529/iphone-moi-2021-02.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"><img alt=\"iPhone mới | Trang bị chip Apple A15 Bionic\" data-src=\"https://cdn.tgdd.vn/Products/Images/42/230529/iphone-moi-2021-02.jpg\" class=\" ls-is-cached lazyloaded\" title=\"iPhone mới | Trang bị chip Apple A15 Bionic\" src=\"https://cdn.tgdd.vn/Products/Images/42/230529/iphone-moi-2021-02.jpg\" style=\"margin: 20px auto; padding: 0px; border: 0px; max-width: 100%; display: block; height: auto !important;\"></a></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Máy sở hữu bộ nhớ trong 128 GB, vừa đủ với nhu cầu sử dụng của một người dùng cơ bản, không có nhu cầu quay video quá nhiều, ngoài ra năm nay cũng có thêm phiên bản bộ nhớ trong lên đến 1TB, bạn có thể cân nhắc nếu có nhu cầu lưu trữ cao.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Ngoài ra, máy còn được tích hợp công nghệ Wi-Fi 6, chuẩn kết nối không dây mới với việc trang bị nhiều băng tần 5G, tương thích với nhiều nhà mạng ở các quốc gia khác nhau, iPhone 13 Pro Max luôn cho tốc độ mạng tối đa, cho trải nghiệm xem phim 4K mượt mà, tải tệp tin trong chớp mắt, chơi game online không độ trễ ở bất cứ đâu.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\"><a class=\"preventdefault\" href=\"https://www.thegioididong.com/images/42/230529/iphone-moi-2021-08.jpg\" style=\"margin: 0px; padding: 0px; transition: all 0.2s ease 0s; color: rgb(47, 128, 237); cursor: default;\"><img alt=\"iPhone mới | Hỗ trợ chuẩn Wifi mới 6E\" data-src=\"https://cdn.tgdd.vn/Products/Images/42/230529/iphone-moi-2021-08.jpg\" class=\" ls-is-cached lazyloaded\" title=\"iPhone mới | Hỗ trợ chuẩn Wifi mới 6E\" src=\"https://cdn.tgdd.vn/Products/Images/42/230529/iphone-moi-2021-08.jpg\" style=\"margin: 20px auto; padding: 0px; border: 0px; max-width: 100%; display: block; height: auto !important;\"></a></p><h3 style=\"margin: 20px 0px 15px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 20px; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); outline: none;\">Bước nhảy vọt về thời lượng pin</h3><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">iPhone Pro Max đánh dấu bước ngoặt mới trong thời lượng pin sử dụng. Với viên pin dung lượng pin lớn kết hợp cùng màn hình mới và bộ vi xử lý Apple A15 Bionic tiết kiệm điện, giúp iPhone 13 Pro Max trở thành chiếc iPhone có thời lượng pin tốt nhất từ trước đến nay, dài hơn 2.5 giờ so với người tiền nhiệm.&nbsp;</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#333333\">Đáng tiếc là dung lượng pin của các mẫu iPhone mới được cải thiện nhưng tốc độ&nbsp;</font><font style=\"\" color=\"#000000\"><span style=\"transition-duration: 0.2s; transition-property: all; background-color: rgb(255, 255, 255);\">sạc nhanh</span></font><font color=\"#333333\">&nbsp;của chúng vẫn chỉ dừng ở mức 20 W qua kết nối có dây và sạc qua MagSafe ở mức tối đa 15 W hoặc có thể qua bộ sạc không dây dựa trên Qi với công suất 7.5 W.</font></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; margin-block: 0px; text-rendering: geometricprecision; line-height: 1.5; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif;\">Apple đã không ngừng cải tiến đem đến cho người dùng sản phẩm tốt nhất, iPhone 13 Pro Max 128GB vẫn giữ được các điểm nổi bật của người tiền nhiệm, nổi bật với cải tiến về cấu hình, thời lượng pin cũng như camera và nhiều điều còn chờ bạn khám phá.</p>', 'images/product/iphone-13-pro-max-graphite.jpg,images/product/iphone-13-pro-max-gold.jpg,images/product/iphone-13-pro-max-silver.jpg,images/product/iphone-13-pro-max-sierra-blue.jpg', 100, 'hot', 'active', 33500000.00, NULL, 1, 1, 2, 1, '2021-10-01 08:58:46', '2021-10-01 09:45:56'),
(2, 'Ốp lưng iPhone 13 Pro Max Case COSANO Đen', 'CaseCOSANO', 'op-lung-iphone-13-pro-max-case-cosano-den', '<p>Kiểu dáng thời trang và đẹp mắt.</p><p>Thiết kế vừa vặn và ôm sát thân máy.</p><p>Dễ dàng tháo/lắp ốp vào máy.</p>', NULL, 'images/product/op-iphone-13-case-cosano-3-org.jpg,images/product/op-iphone-13-case-cosano-2-org.jpg,images/product/op-iphone-13-case-cosano-1-org.jpg', 96, 'new', 'active', 150000.00, 2.00, 0, 3, 4, NULL, '2021-10-01 11:11:47', '2021-10-01 19:46:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_attributes_values`
--

CREATE TABLE `products_attributes_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_attributes_values`
--

INSERT INTO `products_attributes_values` (`id`, `product_id`, `attribute_id`, `attribute_value_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2021-10-01 09:15:03', '2021-10-01 09:15:03'),
(2, 1, 1, 2, '2021-10-01 09:15:58', '2021-10-01 09:15:58'),
(3, 1, 1, 3, '2021-10-01 09:16:03', '2021-10-01 09:16:03'),
(4, 1, 1, 4, '2021-10-01 09:16:06', '2021-10-01 09:16:06'),
(5, 1, 3, 8, '2021-10-01 09:16:12', '2021-10-01 09:16:12'),
(6, 1, 3, 9, '2021-10-01 09:16:15', '2021-10-01 09:16:15'),
(7, 1, 3, 10, '2021-10-01 09:16:18', '2021-10-01 09:16:18'),
(8, 1, 3, 11, '2021-10-01 09:16:21', '2021-10-01 09:16:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Màu', 'active', '2021-10-01 09:04:26', '2021-10-01 09:04:26'),
(2, 'RAM', 'active', '2021-10-01 09:12:38', '2021-10-01 09:12:38'),
(3, 'Bộ nhớ', 'active', '2021-10-01 09:13:32', '2021-10-01 09:13:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` tinyint(4) NOT NULL DEFAULT 0,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `rate`, `review`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 5, 'iPhone 13 rất tuyệt vời', 'active', '2021-10-01 19:13:58', '2021-10-01 19:13:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(11,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `key`, `sku`, `price`, `stock`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Xanh Dương,128GB', 'iP13ProMax-XanhDương-128GB', 33500000.00, 20, 'active', '2021-10-01 09:16:47', '2021-10-01 09:16:47'),
(2, 1, 'Bạc,128GB', 'iP13ProMax-Bạc-128GB', 33600000.00, 20, 'active', '2021-10-01 09:17:08', '2021-10-01 09:17:08'),
(3, 1, 'Vàng Đồng,128GB', 'iP13ProMax-VàngĐồng-128GB', 33700000.00, 20, 'active', '2021-10-01 09:20:14', '2021-10-01 09:20:14'),
(4, 1, 'Xám,128GB', 'iP13ProMax-Xám-128GB', 33800000.00, 20, 'active', '2021-10-01 09:20:33', '2021-10-01 09:20:33'),
(5, 1, 'Xanh Dương,256GB', 'iP13ProMax-XanhDương-256GB', 37500000.00, 20, 'active', '2021-10-01 09:20:57', '2021-10-01 09:20:57'),
(6, 1, 'Bạc,256GB', 'iP13ProMax-Bạc-256GB', 37600000.00, 20, 'active', '2021-10-01 09:21:11', '2021-10-01 09:21:11'),
(7, 1, 'Vàng Đồng,256GB', 'iP13ProMax-VàngĐồng-256GB', 37700000.00, 20, 'active', '2021-10-01 09:21:27', '2021-10-01 09:21:27'),
(8, 1, 'Xám,256GB', 'iP13ProMax-Xám-256GB', 37800000.00, 20, 'active', '2021-10-01 09:22:03', '2021-10-01 09:22:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_des` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `description`, `short_des`, `logo`, `photo`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, '<p>Hòa Hồng Mobile là cửa hàng chuyên cung cấp điện thoại, phụ kiện điện thoại chất lượng. Cùng với dịch vụ sửa chữa, chăm sóc khách hàng 24/7. </p><p>Với kinh nghiệm 10 năm trong nghề, chúng tôi luôn luôn đảm bảo sẽ đem lại cho khách hàng những sản phẩm tốt nhất, giá rẻ. </p><p>Nếu phát hiện sản phẩm nhái, kém chất lượng chúng tôi cam kết sẽ đền bù 150% giá trị sản phẩm.</p><p>Với tiêu chí đem lại sự hài lòng, tin tưởng tuyệt đối với khách hàng. Chúng tôi luôn sẵn lòng lắng nghe những chia sẻ, đóng góp để khiến các bạn hài lòng.</p><p>Bạn có thể liên hệ đến SĐT:0352022060 / Email:hpcmobiletn@gmail.com hoặc đến địa chỉ&nbsp;Tổ 6, phường Chùa Hang, Tp. Thái Nguyên (đối diện trường cấp 3 Đồng Hỷ)</p>', 'Hòa Hồng Mobile là cửa hàng chuyên cung cấp điện thoại, phụ kiện điện thoại chất lượng. Cùng với dịch vụ sửa chữa, chăm sóc khách hàng 24/7.', 'images/store/logo.png', 'images/store/logo.png', 'Tổ 6, phường Chùa Hang, Tp. Thái Nguyên (đối diện trường cấp 3 Đồng Hỷ)', '0352022060', 'hpcmobiletn@gmail.com', NULL, '2021-10-01 20:20:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `shippings`
--

INSERT INTO `shippings` (`id`, `type`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Miễn phí', '0.00', 'active', '2021-10-01 08:45:16', '2021-10-01 08:45:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$Lb78pLVpkKUdPw9YLERTneLJzLGWNmrf/xNcajnSMHt16PEghCN0y', NULL, 'admin', 'active', NULL, NULL, NULL),
(2, 'User', 'user@gmail.com', NULL, '$2y$10$85006lSgnDPnrhxaoHs6a.vwyX7T/Sa3bhVHAaS/jDpbVDzQVZd4m', NULL, 'user', 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(11,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wishlists`
--

INSERT INTO `wishlists` (`id`, `product_id`, `cart_id`, `user_id`, `price`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 33500000.00, 1, 33500000.00, '2021-10-01 10:01:45', '2021-10-01 10:01:45'),
(2, 2, NULL, 2, 147000.00, 1, 147000.00, '2021-10-01 19:14:31', '2021-10-01 19:14:31');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banners_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_order_id_foreign` (`order_id`),
  ADD KEY `carts_product_variant_id_foreign` (`product_variant_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `categories_added_by_foreign` (`added_by`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_shipping_id_foreign` (`shipping_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_post_cat_id_foreign` (`post_cat_id`),
  ADD KEY `posts_post_tag_id_foreign` (`post_tag_id`),
  ADD KEY `posts_added_by_foreign` (`added_by`);

--
-- Chỉ mục cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comments_user_id_foreign` (`user_id`),
  ADD KEY `post_comments_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_tags_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_cat_id_foreign` (`cat_id`),
  ADD KEY `products_child_cat_id_foreign` (`child_cat_id`);

--
-- Chỉ mục cho bảng `products_attributes_values`
--
ALTER TABLE `products_attributes_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_attributes_values_product_id_foreign` (`product_id`),
  ADD KEY `products_attributes_values_attribute_id_foreign` (`attribute_id`),
  ADD KEY `products_attributes_values_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Chỉ mục cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_variants_sku_unique` (`sku`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_cart_id_foreign` (`cart_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products_attributes_values`
--
ALTER TABLE `products_attributes_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`);

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shippings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_post_cat_id_foreign` FOREIGN KEY (`post_cat_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_post_tag_id_foreign` FOREIGN KEY (`post_tag_id`) REFERENCES `post_tags` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `post_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_child_cat_id_foreign` FOREIGN KEY (`child_cat_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `products_attributes_values`
--
ALTER TABLE `products_attributes_values`
  ADD CONSTRAINT `products_attributes_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`),
  ADD CONSTRAINT `products_attributes_values_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`),
  ADD CONSTRAINT `products_attributes_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
