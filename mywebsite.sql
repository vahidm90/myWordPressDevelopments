-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2019 at 04:19 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mywebsite`
--
CREATE DATABASE IF NOT EXISTS `mywebsite` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mywebsite`;

-- --------------------------------------------------------

--
-- Table structure for table `pw_commentmeta`
--

DROP TABLE IF EXISTS `pw_commentmeta`;
CREATE TABLE `pw_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pw_comments`
--

DROP TABLE IF EXISTS `pw_comments`;
CREATE TABLE `pw_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `comment_author` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pw_comments`
--

INSERT INTO `pw_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'یک نویسندهٔ دیدگاه در وردپرس', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2019-12-09 05:37:42', '2019-12-09 02:07:42', 'سلام، این یک دیدگاه است.\nبرای شروع مدیریت، ویرایش و پاک کردن دیدگاه‌ها، لطفا بخش دیدگاه‌ها در پیشخوان را ببینید.\nتصاویر نویسندگان دیدگاه از <a href=\"https://gravatar.com\">Gravatar</a> گرفته می‌شود.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pw_links`
--

DROP TABLE IF EXISTS `pw_links`;
CREATE TABLE `pw_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pw_options`
--

DROP TABLE IF EXISTS `pw_options`;
CREATE TABLE `pw_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pw_options`
--

INSERT INTO `pw_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://mywebsite.test', 'yes'),
(2, 'home', 'http://mywebsite.test', 'yes'),
(3, 'blogname', 'ایلش', 'yes'),
(4, 'blogdescription', 'یک سایت دیگر با وردپرس فارسی', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'test@mywebsite.test', 'yes'),
(7, 'start_of_week', '6', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '0', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%_%post_id%', 'yes'),
(29, 'rewrite_rules', 'a:90:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:65:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:75:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:95:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:90:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:90:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:71:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:62:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)_([0-9]+)/embed/?$\";s:105:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&p=$matches[5]&embed=true\";s:66:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)_([0-9]+)/trackback/?$\";s:99:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&p=$matches[5]&tb=1\";s:86:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)_([0-9]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:111:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&p=$matches[5]&feed=$matches[6]\";s:81:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)_([0-9]+)/(feed|rdf|rss|rss2|atom)/?$\";s:111:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&p=$matches[5]&feed=$matches[6]\";s:74:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)_([0-9]+)/page/?([0-9]{1,})/?$\";s:112:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&p=$matches[5]&paged=$matches[6]\";s:81:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)_([0-9]+)/comment-page-([0-9]{1,})/?$\";s:112:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&p=$matches[5]&cpage=$matches[6]\";s:70:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)_([0-9]+)(?:/([0-9]+))?/?$\";s:111:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&p=$matches[5]&page=$matches[6]\";s:54:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:64:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:84:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:79:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:79:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:60:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+_[0-9]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]\";s:51:\"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]\";s:38:\"([0-9]{4})/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&cpage=$matches[2]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:0:{}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '3.5', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'VM-WPT-Business-elashcenter', 'yes'),
(41, 'stylesheet', 'VM-WPT-Business-elashcenter', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '45805', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '0', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'posts', 'yes'),
(54, 'tag_base', '', 'yes'),
(55, 'show_avatars', '1', 'yes'),
(56, 'avatar_rating', 'G', 'yes'),
(57, 'upload_url_path', '', 'yes'),
(58, 'thumbnail_size_w', '150', 'yes'),
(59, 'thumbnail_size_h', '150', 'yes'),
(60, 'thumbnail_crop', '1', 'yes'),
(61, 'medium_size_w', '300', 'yes'),
(62, 'medium_size_h', '300', 'yes'),
(63, 'avatar_default', 'mystery', 'yes'),
(64, 'large_size_w', '1024', 'yes'),
(65, 'large_size_h', '1024', 'yes'),
(66, 'image_default_link_type', 'none', 'yes'),
(67, 'image_default_size', '', 'yes'),
(68, 'image_default_align', '', 'yes'),
(69, 'close_comments_for_old_posts', '0', 'yes'),
(70, 'close_comments_days_old', '14', 'yes'),
(71, 'thread_comments', '1', 'yes'),
(72, 'thread_comments_depth', '5', 'yes'),
(73, 'page_comments', '0', 'yes'),
(74, 'comments_per_page', '50', 'yes'),
(75, 'default_comments_page', 'newest', 'yes'),
(76, 'comment_order', 'asc', 'yes'),
(77, 'sticky_posts', 'a:0:{}', 'yes'),
(78, 'widget_categories', 'a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(79, 'widget_text', 'a:3:{i:2;a:4:{s:5:\"title\";s:30:\"دربارهٔ این سایت\";s:4:\"text\";s:88:\"اینجا مکان مناسبی است برای معرفی شما و سایت‌تان.\";s:6:\"filter\";b:1;s:6:\"visual\";b:1;}i:3;a:4:{s:5:\"title\";s:22:\"ما را بیابید\";s:4:\"text\";s:262:\"<strong>نشانی</strong>\nخیابان ۱۲۳\nنیویورک، نیویورک ۱۰۰۰۱\n\n<strong>ساعت کاری</strong>\nشنبه تا چهارشنبه: ۹ صبح تا ۵ بعد از ظهر\nپنجشنبه و جمعه: ۱۱ صبح تا ۳ بعد از ظهر\";s:6:\"filter\";b:1;s:6:\"visual\";b:1;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(80, 'widget_rss', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(81, 'uninstall_plugins', 'a:0:{}', 'no'),
(82, 'timezone_string', '', 'yes'),
(83, 'page_for_posts', '0', 'yes'),
(84, 'page_on_front', '0', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '0', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'wp_page_for_privacy_policy', '3', 'yes'),
(92, 'show_comments_cookies_opt_in', '1', 'yes'),
(93, 'initial_db_version', '44719', 'yes'),
(94, 'pw_user_roles', 'a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:61:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}', 'yes'),
(95, 'fresh_site', '0', 'yes'),
(96, 'WPLANG', 'fa_IR', 'yes'),
(97, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(98, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(99, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(100, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(101, 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(102, 'sidebars_widgets', 'a:2:{s:19:\"wp_inactive_widgets\";a:8:{i:0;s:6:\"text-2\";i:1;s:6:\"text-3\";i:2;s:8:\"search-2\";i:3;s:14:\"recent-posts-2\";i:4;s:17:\"recent-comments-2\";i:5;s:10:\"archives-2\";i:6;s:12:\"categories-2\";i:7;s:6:\"meta-2\";}s:13:\"array_version\";i:3;}', 'yes'),
(103, 'cron', 'a:6:{i:1576948068;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1576980464;a:1:{s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1576980468;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1576980557;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1576980561;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}s:7:\"version\";i:2;}', 'yes'),
(104, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(105, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(106, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(112, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(114, 'recovery_keys', 'a:0:{}', 'yes'),
(140, 'admin_email_lifespan', '1592229984', 'yes'),
(141, 'db_upgraded', '', 'yes'),
(145, 'theme_mods_twentynineteen', 'a:1:{s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1575857538;s:4:\"data\";a:2:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}}}}', 'yes'),
(146, 'current_theme', 'VM Business elashcenter', 'yes'),
(147, 'theme_mods_twentytwenty', 'a:4:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1575861601;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:2:{i:0;s:6:\"text-2\";i:1;s:6:\"text-3\";}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}}}}', 'yes'),
(148, 'theme_switched', '', 'yes'),
(159, 'theme_mods_VM-WPT-Business-elashcenter', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:1:{s:14:\"vm-fp-top-menu\";i:2;}s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(172, 'nav_menu_options', 'a:2:{i:0;b:0;s:8:\"auto_add\";a:0:{}}', 'yes'),
(199, 'auto_core_update_notified', 'a:4:{s:4:\"type\";s:7:\"success\";s:5:\"email\";s:19:\"test@mywebsite.test\";s:7:\"version\";s:5:\"5.3.2\";s:9:\"timestamp\";i:1576813925;}', 'no'),
(246, 'new_admin_email', 'test@mywebsite.test', 'yes'),
(265, 'can_compress_scripts', '0', 'no'),
(281, '_site_transient_timeout_php_check_f0b6411b8c82dcf39302e5312c1fbd33', '1577122793', 'no'),
(282, '_site_transient_php_check_f0b6411b8c82dcf39302e5312c1fbd33', 'a:5:{s:19:\"recommended_version\";s:3:\"7.3\";s:15:\"minimum_version\";s:6:\"5.6.20\";s:12:\"is_supported\";b:1;s:9:\"is_secure\";b:1;s:13:\"is_acceptable\";b:1;}', 'no'),
(332, '_site_transient_update_plugins', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1576938216;s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:0:{}}', 'no'),
(333, '_site_transient_update_themes', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1576938229;s:7:\"checked\";a:5:{s:20:\"RasoulShiri-Personal\";s:3:\"1.0\";s:3:\"SNT\";s:11:\"0.0.1 alpha\";s:27:\"VM-WPT-Business-elashcenter\";s:3:\"1.0\";s:15:\"VM-WPT-Business\";s:3:\"1.0\";s:15:\"VM-WPT-Personal\";s:3:\"1.0\";}s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}}', 'no'),
(355, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:58:\"http://downloads.wordpress.org/release/wordpress-5.3.2.zip\";s:6:\"locale\";s:5:\"fa_IR\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:58:\"http://downloads.wordpress.org/release/wordpress-5.3.2.zip\";s:10:\"no_content\";s:69:\"http://downloads.wordpress.org/release/wordpress-5.3.2-no-content.zip\";s:11:\"new_bundled\";s:70:\"http://downloads.wordpress.org/release/wordpress-5.3.2-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.3.2\";s:7:\"version\";s:5:\"5.3.2\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.3\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1576938238;s:15:\"version_checked\";s:5:\"5.3.2\";s:12:\"translations\";a:0:{}}', 'no'),
(375, '_site_transient_timeout_theme_roots', '1576940017', 'no'),
(376, '_site_transient_theme_roots', 'a:5:{s:20:\"RasoulShiri-Personal\";s:7:\"/themes\";s:3:\"SNT\";s:7:\"/themes\";s:27:\"VM-WPT-Business-elashcenter\";s:7:\"/themes\";s:15:\"VM-WPT-Business\";s:7:\"/themes\";s:15:\"VM-WPT-Personal\";s:7:\"/themes\";}', 'no'),
(377, '_site_transient_timeout_browser_5b21a4f36fd10e23154b80cac949aedf', '1577543028', 'no'),
(378, '_site_transient_browser_5b21a4f36fd10e23154b80cac949aedf', 'a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:12:\"79.0.3945.88\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(380, '_transient_timeout_plugin_slugs', '1577024646', 'no'),
(381, '_transient_plugin_slugs', 'a:0:{}', 'no'),
(382, 'recently_activated', 'a:0:{}', 'yes'),
(383, '_transient_timeout_dash_v2_ccb55a4e4b351a220e50ef4117d7dc27', '1576981449', 'no'),
(384, '_transient_dash_v2_ccb55a4e4b351a220e50ef4117d7dc27', '<div class=\"rss-widget\"><p><strong>خطای RSS:</strong> WP HTTP Error: cURL error 28: Operation timed out after 10000 milliseconds with 0 out of 0 bytes received</p></div><div class=\"rss-widget\"><p><strong>خطای RSS:</strong> A feed could not be found at http://planet.wp-persian.com/feed/. A feed with an invalid mime type may fall victim to this error, or SimplePie was unable to auto-discover it.. Use force_feed() if you are certain this URL is a real feed.</p></div>', 'no'),
(385, '_site_transient_timeout_poptags_40cd750bba9870f18aada2478b24840a', '1576949085', 'no'),
(386, '_site_transient_poptags_40cd750bba9870f18aada2478b24840a', 'O:8:\"stdClass\":100:{s:6:\"widget\";a:3:{s:4:\"name\";s:6:\"widget\";s:4:\"slug\";s:6:\"widget\";s:5:\"count\";i:4652;}s:11:\"woocommerce\";a:3:{s:4:\"name\";s:11:\"woocommerce\";s:4:\"slug\";s:11:\"woocommerce\";s:5:\"count\";i:3812;}s:4:\"post\";a:3:{s:4:\"name\";s:4:\"post\";s:4:\"slug\";s:4:\"post\";s:5:\"count\";i:2651;}s:5:\"admin\";a:3:{s:4:\"name\";s:5:\"admin\";s:4:\"slug\";s:5:\"admin\";s:5:\"count\";i:2531;}s:5:\"posts\";a:3:{s:4:\"name\";s:5:\"posts\";s:4:\"slug\";s:5:\"posts\";s:5:\"count\";i:1947;}s:9:\"shortcode\";a:3:{s:4:\"name\";s:9:\"shortcode\";s:4:\"slug\";s:9:\"shortcode\";s:5:\"count\";i:1779;}s:8:\"comments\";a:3:{s:4:\"name\";s:8:\"comments\";s:4:\"slug\";s:8:\"comments\";s:5:\"count\";i:1761;}s:7:\"twitter\";a:3:{s:4:\"name\";s:7:\"twitter\";s:4:\"slug\";s:7:\"twitter\";s:5:\"count\";i:1476;}s:6:\"images\";a:3:{s:4:\"name\";s:6:\"images\";s:4:\"slug\";s:6:\"images\";s:5:\"count\";i:1461;}s:6:\"google\";a:3:{s:4:\"name\";s:6:\"google\";s:4:\"slug\";s:6:\"google\";s:5:\"count\";i:1451;}s:8:\"facebook\";a:3:{s:4:\"name\";s:8:\"facebook\";s:4:\"slug\";s:8:\"facebook\";s:5:\"count\";i:1443;}s:5:\"image\";a:3:{s:4:\"name\";s:5:\"image\";s:4:\"slug\";s:5:\"image\";s:5:\"count\";i:1398;}s:3:\"seo\";a:3:{s:4:\"name\";s:3:\"seo\";s:4:\"slug\";s:3:\"seo\";s:5:\"count\";i:1372;}s:7:\"sidebar\";a:3:{s:4:\"name\";s:7:\"sidebar\";s:4:\"slug\";s:7:\"sidebar\";s:5:\"count\";i:1296;}s:7:\"gallery\";a:3:{s:4:\"name\";s:7:\"gallery\";s:4:\"slug\";s:7:\"gallery\";s:5:\"count\";i:1164;}s:5:\"email\";a:3:{s:4:\"name\";s:5:\"email\";s:4:\"slug\";s:5:\"email\";s:5:\"count\";i:1147;}s:4:\"page\";a:3:{s:4:\"name\";s:4:\"page\";s:4:\"slug\";s:4:\"page\";s:5:\"count\";i:1114;}s:6:\"social\";a:3:{s:4:\"name\";s:6:\"social\";s:4:\"slug\";s:6:\"social\";s:5:\"count\";i:1079;}s:9:\"ecommerce\";a:3:{s:4:\"name\";s:9:\"ecommerce\";s:4:\"slug\";s:9:\"ecommerce\";s:5:\"count\";i:1071;}s:5:\"login\";a:3:{s:4:\"name\";s:5:\"login\";s:4:\"slug\";s:5:\"login\";s:5:\"count\";i:973;}s:5:\"links\";a:3:{s:4:\"name\";s:5:\"links\";s:4:\"slug\";s:5:\"links\";s:5:\"count\";i:863;}s:7:\"widgets\";a:3:{s:4:\"name\";s:7:\"widgets\";s:4:\"slug\";s:7:\"widgets\";s:5:\"count\";i:854;}s:5:\"video\";a:3:{s:4:\"name\";s:5:\"video\";s:4:\"slug\";s:5:\"video\";s:5:\"count\";i:851;}s:8:\"security\";a:3:{s:4:\"name\";s:8:\"security\";s:4:\"slug\";s:8:\"security\";s:5:\"count\";i:832;}s:4:\"spam\";a:3:{s:4:\"name\";s:4:\"spam\";s:4:\"slug\";s:4:\"spam\";s:5:\"count\";i:768;}s:7:\"content\";a:3:{s:4:\"name\";s:7:\"content\";s:4:\"slug\";s:7:\"content\";s:5:\"count\";i:757;}s:10:\"e-commerce\";a:3:{s:4:\"name\";s:10:\"e-commerce\";s:4:\"slug\";s:10:\"e-commerce\";s:5:\"count\";i:743;}s:6:\"slider\";a:3:{s:4:\"name\";s:6:\"slider\";s:4:\"slug\";s:6:\"slider\";s:5:\"count\";i:742;}s:10:\"buddypress\";a:3:{s:4:\"name\";s:10:\"buddypress\";s:4:\"slug\";s:10:\"buddypress\";s:5:\"count\";i:738;}s:9:\"analytics\";a:3:{s:4:\"name\";s:9:\"analytics\";s:4:\"slug\";s:9:\"analytics\";s:5:\"count\";i:722;}s:3:\"rss\";a:3:{s:4:\"name\";s:3:\"rss\";s:4:\"slug\";s:3:\"rss\";s:5:\"count\";i:709;}s:5:\"media\";a:3:{s:4:\"name\";s:5:\"media\";s:4:\"slug\";s:5:\"media\";s:5:\"count\";i:694;}s:5:\"pages\";a:3:{s:4:\"name\";s:5:\"pages\";s:4:\"slug\";s:5:\"pages\";s:5:\"count\";i:692;}s:4:\"form\";a:3:{s:4:\"name\";s:4:\"form\";s:4:\"slug\";s:4:\"form\";s:5:\"count\";i:685;}s:6:\"search\";a:3:{s:4:\"name\";s:6:\"search\";s:4:\"slug\";s:6:\"search\";s:5:\"count\";i:671;}s:6:\"jquery\";a:3:{s:4:\"name\";s:6:\"jquery\";s:4:\"slug\";s:6:\"jquery\";s:5:\"count\";i:657;}s:4:\"feed\";a:3:{s:4:\"name\";s:4:\"feed\";s:4:\"slug\";s:4:\"feed\";s:5:\"count\";i:640;}s:4:\"menu\";a:3:{s:4:\"name\";s:4:\"menu\";s:4:\"slug\";s:4:\"menu\";s:5:\"count\";i:638;}s:8:\"category\";a:3:{s:4:\"name\";s:8:\"category\";s:4:\"slug\";s:8:\"category\";s:5:\"count\";i:629;}s:4:\"ajax\";a:3:{s:4:\"name\";s:4:\"ajax\";s:4:\"slug\";s:4:\"ajax\";s:5:\"count\";i:622;}s:6:\"editor\";a:3:{s:4:\"name\";s:6:\"editor\";s:4:\"slug\";s:6:\"editor\";s:5:\"count\";i:621;}s:5:\"embed\";a:3:{s:4:\"name\";s:5:\"embed\";s:4:\"slug\";s:5:\"embed\";s:5:\"count\";i:607;}s:3:\"css\";a:3:{s:4:\"name\";s:3:\"css\";s:4:\"slug\";s:3:\"css\";s:5:\"count\";i:580;}s:10:\"javascript\";a:3:{s:4:\"name\";s:10:\"javascript\";s:4:\"slug\";s:10:\"javascript\";s:5:\"count\";i:577;}s:4:\"link\";a:3:{s:4:\"name\";s:4:\"link\";s:4:\"slug\";s:4:\"link\";s:5:\"count\";i:569;}s:7:\"youtube\";a:3:{s:4:\"name\";s:7:\"youtube\";s:4:\"slug\";s:7:\"youtube\";s:5:\"count\";i:567;}s:12:\"contact-form\";a:3:{s:4:\"name\";s:12:\"contact form\";s:4:\"slug\";s:12:\"contact-form\";s:5:\"count\";i:563;}s:5:\"share\";a:3:{s:4:\"name\";s:5:\"share\";s:4:\"slug\";s:5:\"share\";s:5:\"count\";i:549;}s:5:\"theme\";a:3:{s:4:\"name\";s:5:\"theme\";s:4:\"slug\";s:5:\"theme\";s:5:\"count\";i:539;}s:7:\"comment\";a:3:{s:4:\"name\";s:7:\"comment\";s:4:\"slug\";s:7:\"comment\";s:5:\"count\";i:538;}s:7:\"payment\";a:3:{s:4:\"name\";s:7:\"payment\";s:4:\"slug\";s:7:\"payment\";s:5:\"count\";i:536;}s:10:\"responsive\";a:3:{s:4:\"name\";s:10:\"responsive\";s:4:\"slug\";s:10:\"responsive\";s:5:\"count\";i:532;}s:9:\"dashboard\";a:3:{s:4:\"name\";s:9:\"dashboard\";s:4:\"slug\";s:9:\"dashboard\";s:5:\"count\";i:527;}s:6:\"custom\";a:3:{s:4:\"name\";s:6:\"custom\";s:4:\"slug\";s:6:\"custom\";s:5:\"count\";i:524;}s:9:\"affiliate\";a:3:{s:4:\"name\";s:9:\"affiliate\";s:4:\"slug\";s:9:\"affiliate\";s:5:\"count\";i:524;}s:3:\"ads\";a:3:{s:4:\"name\";s:3:\"ads\";s:4:\"slug\";s:3:\"ads\";s:5:\"count\";i:516;}s:10:\"categories\";a:3:{s:4:\"name\";s:10:\"categories\";s:4:\"slug\";s:10:\"categories\";s:5:\"count\";i:507;}s:4:\"user\";a:3:{s:4:\"name\";s:4:\"user\";s:4:\"slug\";s:4:\"user\";s:5:\"count\";i:490;}s:7:\"contact\";a:3:{s:4:\"name\";s:7:\"contact\";s:4:\"slug\";s:7:\"contact\";s:5:\"count\";i:489;}s:3:\"api\";a:3:{s:4:\"name\";s:3:\"api\";s:4:\"slug\";s:3:\"api\";s:5:\"count\";i:487;}s:4:\"tags\";a:3:{s:4:\"name\";s:4:\"tags\";s:4:\"slug\";s:4:\"tags\";s:5:\"count\";i:483;}s:6:\"button\";a:3:{s:4:\"name\";s:6:\"button\";s:4:\"slug\";s:6:\"button\";s:5:\"count\";i:482;}s:15:\"payment-gateway\";a:3:{s:4:\"name\";s:15:\"payment gateway\";s:4:\"slug\";s:15:\"payment-gateway\";s:5:\"count\";i:469;}s:5:\"users\";a:3:{s:4:\"name\";s:5:\"users\";s:4:\"slug\";s:5:\"users\";s:5:\"count\";i:466;}s:6:\"mobile\";a:3:{s:4:\"name\";s:6:\"mobile\";s:4:\"slug\";s:6:\"mobile\";s:5:\"count\";i:461;}s:6:\"events\";a:3:{s:4:\"name\";s:6:\"events\";s:4:\"slug\";s:6:\"events\";s:5:\"count\";i:453;}s:5:\"photo\";a:3:{s:4:\"name\";s:5:\"photo\";s:4:\"slug\";s:5:\"photo\";s:5:\"count\";i:434;}s:9:\"slideshow\";a:3:{s:4:\"name\";s:9:\"slideshow\";s:4:\"slug\";s:9:\"slideshow\";s:5:\"count\";i:426;}s:9:\"marketing\";a:3:{s:4:\"name\";s:9:\"marketing\";s:4:\"slug\";s:9:\"marketing\";s:5:\"count\";i:424;}s:9:\"gutenberg\";a:3:{s:4:\"name\";s:9:\"gutenberg\";s:4:\"slug\";s:9:\"gutenberg\";s:5:\"count\";i:423;}s:6:\"photos\";a:3:{s:4:\"name\";s:6:\"photos\";s:4:\"slug\";s:6:\"photos\";s:5:\"count\";i:420;}s:10:\"navigation\";a:3:{s:4:\"name\";s:10:\"navigation\";s:4:\"slug\";s:10:\"navigation\";s:5:\"count\";i:420;}s:4:\"chat\";a:3:{s:4:\"name\";s:4:\"chat\";s:4:\"slug\";s:4:\"chat\";s:5:\"count\";i:418;}s:5:\"stats\";a:3:{s:4:\"name\";s:5:\"stats\";s:4:\"slug\";s:5:\"stats\";s:5:\"count\";i:417;}s:8:\"calendar\";a:3:{s:4:\"name\";s:8:\"calendar\";s:4:\"slug\";s:8:\"calendar\";s:5:\"count\";i:414;}s:10:\"statistics\";a:3:{s:4:\"name\";s:10:\"statistics\";s:4:\"slug\";s:10:\"statistics\";s:5:\"count\";i:406;}s:5:\"popup\";a:3:{s:4:\"name\";s:5:\"popup\";s:4:\"slug\";s:5:\"popup\";s:5:\"count\";i:404;}s:10:\"newsletter\";a:3:{s:4:\"name\";s:10:\"newsletter\";s:4:\"slug\";s:10:\"newsletter\";s:5:\"count\";i:397;}s:10:\"shortcodes\";a:3:{s:4:\"name\";s:10:\"shortcodes\";s:4:\"slug\";s:10:\"shortcodes\";s:5:\"count\";i:390;}s:4:\"news\";a:3:{s:4:\"name\";s:4:\"news\";s:4:\"slug\";s:4:\"news\";s:5:\"count\";i:388;}s:5:\"forms\";a:3:{s:4:\"name\";s:5:\"forms\";s:4:\"slug\";s:5:\"forms\";s:5:\"count\";i:384;}s:12:\"social-media\";a:3:{s:4:\"name\";s:12:\"social media\";s:4:\"slug\";s:12:\"social-media\";s:5:\"count\";i:382;}s:4:\"code\";a:3:{s:4:\"name\";s:4:\"code\";s:4:\"slug\";s:4:\"code\";s:5:\"count\";i:375;}s:8:\"redirect\";a:3:{s:4:\"name\";s:8:\"redirect\";s:4:\"slug\";s:8:\"redirect\";s:5:\"count\";i:372;}s:14:\"contact-form-7\";a:3:{s:4:\"name\";s:14:\"contact form 7\";s:4:\"slug\";s:14:\"contact-form-7\";s:5:\"count\";i:371;}s:7:\"plugins\";a:3:{s:4:\"name\";s:7:\"plugins\";s:4:\"slug\";s:7:\"plugins\";s:5:\"count\";i:370;}s:9:\"multisite\";a:3:{s:4:\"name\";s:9:\"multisite\";s:4:\"slug\";s:9:\"multisite\";s:5:\"count\";i:366;}s:3:\"url\";a:3:{s:4:\"name\";s:3:\"url\";s:4:\"slug\";s:3:\"url\";s:5:\"count\";i:361;}s:4:\"meta\";a:3:{s:4:\"name\";s:4:\"meta\";s:4:\"slug\";s:4:\"meta\";s:5:\"count\";i:353;}s:11:\"performance\";a:3:{s:4:\"name\";s:11:\"performance\";s:4:\"slug\";s:11:\"performance\";s:5:\"count\";i:353;}s:4:\"list\";a:3:{s:4:\"name\";s:4:\"list\";s:4:\"slug\";s:4:\"list\";s:5:\"count\";i:350;}s:12:\"notification\";a:3:{s:4:\"name\";s:12:\"notification\";s:4:\"slug\";s:12:\"notification\";s:5:\"count\";i:344;}s:8:\"tracking\";a:3:{s:4:\"name\";s:8:\"tracking\";s:4:\"slug\";s:8:\"tracking\";s:5:\"count\";i:333;}s:16:\"custom-post-type\";a:3:{s:4:\"name\";s:16:\"custom post type\";s:4:\"slug\";s:16:\"custom-post-type\";s:5:\"count\";i:330;}s:16:\"google-analytics\";a:3:{s:4:\"name\";s:16:\"google analytics\";s:4:\"slug\";s:16:\"google-analytics\";s:5:\"count\";i:329;}s:11:\"advertising\";a:3:{s:4:\"name\";s:11:\"advertising\";s:4:\"slug\";s:11:\"advertising\";s:5:\"count\";i:328;}s:5:\"cache\";a:3:{s:4:\"name\";s:5:\"cache\";s:4:\"slug\";s:5:\"cache\";s:5:\"count\";i:322;}s:6:\"simple\";a:3:{s:4:\"name\";s:6:\"simple\";s:4:\"slug\";s:6:\"simple\";s:5:\"count\";i:320;}s:4:\"html\";a:3:{s:4:\"name\";s:4:\"html\";s:4:\"slug\";s:4:\"html\";s:5:\"count\";i:319;}s:6:\"author\";a:3:{s:4:\"name\";s:6:\"author\";s:4:\"slug\";s:6:\"author\";s:5:\"count\";i:317;}}', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `pw_postmeta`
--

DROP TABLE IF EXISTS `pw_postmeta`;
CREATE TABLE `pw_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pw_postmeta`
--

INSERT INTO `pw_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(2, 3, '_wp_page_template', 'default'),
(34, 13, '_edit_lock', '1576126152:1'),
(35, 15, '_edit_lock', '1576126422:1'),
(36, 17, '_edit_lock', '1576126911:1'),
(40, 3, '_edit_last', '1'),
(41, 3, '_edit_lock', '1576128192:1'),
(42, 21, '_menu_item_type', 'post_type'),
(43, 21, '_menu_item_menu_item_parent', '0'),
(44, 21, '_menu_item_object_id', '17'),
(45, 21, '_menu_item_object', 'page'),
(46, 21, '_menu_item_target', ''),
(47, 21, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(48, 21, '_menu_item_xfn', ''),
(49, 21, '_menu_item_url', ''),
(51, 22, '_menu_item_type', 'post_type'),
(52, 22, '_menu_item_menu_item_parent', '0'),
(53, 22, '_menu_item_object_id', '15'),
(54, 22, '_menu_item_object', 'page'),
(55, 22, '_menu_item_target', ''),
(56, 22, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(57, 22, '_menu_item_xfn', ''),
(58, 22, '_menu_item_url', ''),
(60, 23, '_menu_item_type', 'post_type'),
(61, 23, '_menu_item_menu_item_parent', '0'),
(62, 23, '_menu_item_object_id', '13'),
(63, 23, '_menu_item_object', 'page'),
(64, 23, '_menu_item_target', ''),
(65, 23, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(66, 23, '_menu_item_xfn', ''),
(67, 23, '_menu_item_url', ''),
(69, 24, '_edit_lock', '1576127579:1'),
(70, 26, '_edit_lock', '1576127951:1'),
(71, 29, '_menu_item_type', 'post_type'),
(72, 29, '_menu_item_menu_item_parent', '0'),
(73, 29, '_menu_item_object_id', '26'),
(74, 29, '_menu_item_object', 'page'),
(75, 29, '_menu_item_target', ''),
(76, 29, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(77, 29, '_menu_item_xfn', ''),
(78, 29, '_menu_item_url', ''),
(80, 30, '_menu_item_type', 'post_type'),
(81, 30, '_menu_item_menu_item_parent', '0'),
(82, 30, '_menu_item_object_id', '24'),
(83, 30, '_menu_item_object', 'page'),
(84, 30, '_menu_item_target', ''),
(85, 30, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(86, 30, '_menu_item_xfn', ''),
(87, 30, '_menu_item_url', ''),
(89, 1, '_edit_lock', '1576323393:1'),
(91, 32, '_edit_lock', '1576323698:1'),
(93, 34, '_edit_lock', '1576323728:1'),
(95, 36, '_edit_lock', '1576747074:1');

-- --------------------------------------------------------

--
-- Table structure for table `pw_posts`
--

DROP TABLE IF EXISTS `pw_posts`;
CREATE TABLE `pw_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pw_posts`
--

INSERT INTO `pw_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 2, '2019-12-09 05:37:42', '2019-12-09 02:07:42', '<!-- wp:paragraph -->\n<p>به وردپرس خوش آمدید. این اولین نوشته‌ی شماست. این را ویرایش یا حذف کنید، سپس نوشتن را شروع نمایید!</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>این یک حقیقت تلخ است که همه کاربران به ظاهر سایت شما توجه میکنند. بعنوان مثال میتوان از روی جلد یک کتاب حدودا تشخیص داد که چه سالی منتشر شده و چقدر کهنه است. همین دید نسبت به وبسایت نیز وجود دارد. تحقیقات آماری نشان میدهد که نزدیک به ۹۴ درصد کاربران به سایت هایی با طراحی قدیمی و کاربری سخت اعتماد نمیکنند و ممکن است به سرعت سایت شما را ترک کنند. متاسفانه این دست طراحی ها در سایت های دولتی و پرتال های کاربردی بسیار به چشم میخورد و کاربران مجبور به استفاده از این فضاها میشوند.<br>\nنمیتوان یک ادبیات مشخص برای همه سایت های اینترنتی تعیین کرد بلکه باید براساس مخاطبین سایت و نوع محصولات یا خدمات عرض شده ادبیات خود را مشخص کنید. بعنوان مثال اگر مخاطبین شما در گروه سنی جوان هستند استفاده از کلمات دشوار و مفاهیم سنگین نمیتواند جذاب باشد و در مقابل برای سایت هایی در زمینه اقتصاد و سیاست نمیتوان از کلمات و عبارات روزمره استفاده نمود.<br>\nمدت هاست که استفاده از Flash Player در طراحی وب سایت منسوخ شده است، در حالیکه تا همین چند سال پیش بعنوان یکی از تکنولوژی های پرطرفدار طراحی سایت محسوب میشد. اما هنوز سایت هایی وجود دارند که بخش هایی از محتوا یا المان های آنها با استفاده از فلش در سایت نمایش داده میشوند. این تکنولوژی هم اکنون در بسیاری مرورگرها غیرفعال شده و برای استفاده از آن نیاز به اجازه مستقیم کاربر است. همچنین حجم صفحاتی از این دست بسیار بالا بوده و زمان بسیاری برای نمایش محتوا به کاربر نیاز دارند.<br>\nشاید تا به حال برایتان پیش آمده که از کنار یک مغازه عبور کنید و ناگهان مجذوب دکور یا ویترین آن شوید. همین ویترین مجلل و زیباست که باعث می‌شود که اگر نیازی به محتویات داخل مغازه نداشته باشید هم راه خود را کج کنید و وارد مغازه شوید. مغازه دار از چه ترفندی استفاده کرده که توجه شما اینقدر به ویترین جلب شد و شما را مجبور کرد تا وارد این فروشگاه شوید؟<br>\nنمایش ویدیو در بک گراند صفحه اصلی معمولا در بالاترین بخش صفحه انجام میشود؛ جایی که کاربر اولین نمای سایت را مشاهده میکند. استفاده از ویدیو به عنوان بک گراند به نسبت تکنیک های دیگر جدید است و البته استفاده از آن محدود است زیرا موجب افزایش حجم صفحه و کاهش سرعت لود آن میشود.</p>\n<!-- /wp:paragraph -->', 'سلام دنیا!', '', 'publish', 'open', 'open', '', '%d8%b3%d9%84%d8%a7%d9%85-%d8%af%d9%86%db%8c%d8%a7', '', '', '2019-12-14 14:47:51', '2019-12-14 11:17:51', '', 0, 'http://mywebsite.test/?p=1', 0, 'post', '', 1),
(3, 2, '2019-12-09 05:37:42', '2019-12-09 02:07:42', '<!-- wp:heading --><h2>ما که هستیم</h2><!-- /wp:heading --><!-- wp:paragraph --><p>نشانی وب‌سایت ما: http://mywebsite.test.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>کدامیک از اطلاعات شخصی را جمع آوری میکنیم و چرا</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>دیدگاه‌ها</h3><!-- /wp:heading --><!-- wp:paragraph --><p>هنگامی که بازدیدکنندگان نظرات خود را در سایت می‌نویسند، ما اطلاعاتی را که در فرم نظرات و همچنین بازدید کننده‌ها ارائه می‌شود جمع آوری می‌کنیم &#8217;s آدرس IP و رجیستر عامل کاربر مرورگر برای کمک به تشخیص هرزنامه.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>یک رشته ناشناس ایجاد شده از آدرس ایمیل شما (همچنین هش نامیده می‌شود) ممکن است به سرویس Gravatar ارائه شود تا ببینید آیا از آن استفاده می‌کنید. سیاست حفظ حریم خصوصی خدمات Gravatar در اینجا در دسترس است: https://automattic.com/privacy/. پس از تأیید نظر شما، تصویر نمایه شما در متن نظر شما قابل مشاهده است.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>رسانه</h3><!-- /wp:heading --><!-- wp:paragraph --><p>اگر تصاویر را به وبسایت آپلود کنید، نباید آپلود تصاویر با داده‌های مکان جغرافیایی (EXIF GPS) شامل شود. بازدیدکنندگان وب سایت می‌توانند هر گونه اطلاعات مکان را از تصاویر در وب سایت دانلود و استخراج کنند.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>فرم‌های تماس</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>کوکی‌ها</h3><!-- /wp:heading --><!-- wp:paragraph --><p>اگر شما نظر خود را در سایت ما ثبت کنید، ممکن است برای ذخیره نام، آدرس ایمیل و وب سایت خود در کوکی‌ها تصمیم گیری کنید. اینها برای راحتی شما هستند، به طوری که شما مجبور نیستید دوباره جزئیات خود را پر کنید زمانی که نظر دیگری را ترک کنید. این کوکی‌ها یک سال طول خواهد کشید.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>اگر از برگه ورود ما بازدید نمایید، ما یک کوکی موقت برای مشخص نمودن اینکه آیا مروگر شما کوکی قبول می‌کند را تنظیم می‌کنیم. این کوکی محتوای اطلاعات شخصی شما نیست و وقتی مرورگر شما بسته می‌شود از بین می‌رود.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>هنگام ورود به سیستم، ما همچنین کوکی‌ها را تنظیم خواهیم کرد تا اطلاعات ورود به سیستم و گزینه‌های صفحه نمایش خود را ذخیره کنید. کوکی‌های ورود به سیستم برای دو روز گذشته و کوکی‌های گزینه‌های صفحه نمایش برای یک سال گذشته است. اگر شما انتخاب کنید &quot; به یاد داشته باشید من Me&quot;، ورود شما برای دو هفته ادامه خواهد داشت. اگر از حساب خود خارج شوید، کوکی‌های ورود حذف خواهند شد.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>اگر یک مقاله را ویرایش یا منتشر کنید، یک کوکی اضافی در مرورگر شما ذخیره خواهد شد. این کوکی حاوی اطلاعات شخصی نیست و به سادگی نشان می‌دهد که شناسه پست مقاله شما فقط ویرایش شده است. بعد از یک روز منقضی می‌شود.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>محتوای جاسازی‌شده از دیگر وب‌سایت‌ها</h3><!-- /wp:heading --><!-- wp:paragraph --><p>مقالات موجود در این سایت ممکن است شامل محتوای تعبیه شده (مثلا ویدئوها، تصاویر، مقالات و غیره) باشد. مطالب جاسازی شده از وب سایت‌های دیگر رفتار دقیقا همان طوری که بازدید کننده از وب سایت دیگر بازدید کرده است.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>این وبسایت‌ها ممکن است اطلاعاتی مربوط به شما را جمع‌آوری کنند، از کوکی‌ها استفاده کنند، ردیابی سوم شخص اضافه را جاسازی کنند و تعامل شما را با محتوای تعبیه شده نظارت کنند که شامل ردیابی تعامل شما با محتوای جاسازی شده است اگر حساب کاربری داشته و به آن وبسایت وارد شده باشید.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>تجزیه و تحلیل</h3><!-- /wp:heading --><!-- wp:heading --><h2>اطلاعات شما را با چه کسی به اشتراک می‌گذاریم</h2><!-- /wp:heading --><!-- wp:heading --><h2>چه مدت ما اطلاعات شما را حفظ می‌کنیم</h2><!-- /wp:heading --><!-- wp:paragraph --><p>اگر یک نظر را ترک کنید، نظر و متادیتای آن به طور نامحدود حفظ می‌شوند. این به این معنا است که ما می‌توانیم به جای برگزاری آنها در یک خط مؤثر، به طور خودکار هر نظر پیگیری را تصدیق و تأیید کنیم.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>برای کاربرانی که در وب سایت ما ثبت نام می‌کنند (اگر وجود داشته باشند)، ما همچنین اطلاعات شخصی را که در مشخصات کاربر آنها ارائه می‌کنیم، ذخیره می‌کنیم. همه کاربران می‌توانند اطلاعات شخصی خود را در هر زمان (به جز آنها که نمی‌توانند نام کاربری خود را تغییر دهند) ببینند، ویرایش و یا حذف کنند. مدیران وب سایت همچنین می‌توانند این اطلاعات را مشاهده و ویرایش کنند.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>حقوقی که بر روی داده‌هایتان دارید</h2><!-- /wp:heading --><!-- wp:paragraph --><p>اگر در این سایت حساب کاربری دارید یا نظرها را ترک کرده اید، می‌توانید درخواست دریافت یک فایل صادر شده از اطلاعات شخصی که ما در مورد شما نگه می‌داریم، از جمله هر گونه داده‌ای که برای ما ارائه کرده اید. همچنین می‌توانید درخواست کنید که ما هر گونه اطلاعات شخصی که در مورد شما نگه داریم پاک کنیم. این شامل اطلاعاتی نیست که ما مجبور به نگهداری آنها برای اهداف اداری، قانونی یا امنیتی باشیم.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>داده‌های شما را به کجا ارسال می‌کنیم</h2><!-- /wp:heading --><!-- wp:paragraph --><p>دیدگاه‌های بازدیدکننده ممکن است از طریق یک سرویس تشخیص جفنگ خودکار بررسی شوند.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>اطلاعات تماس شما</h2><!-- /wp:heading --><!-- wp:heading --><h2>اطلاعات اضافی</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>چگونه از اطلاعات شما حفاظت می‌کنیم</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>چه رویه‌های نقض اطلاعات در حال حاضر وجود دارد</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>چه چیز جدیدی از داده‌ها دریافت می‌کنیم</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>تصمیم گیری خودکار و / یا پروفایل ما با داده‌های کاربر انجام می‌شود</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>الزامات افشای قانونی صنعت</h3><!-- /wp:heading -->', 'سیاست حریم خصوصی', '', 'draft', 'closed', 'closed', '', '%d8%b3%db%8c%d8%a7%d8%b3%d8%aa-%d8%ad%d9%81%d8%b8-%d8%ad%d8%b1%db%8c%d9%85-%d8%ae%d8%b5%d9%88%d8%b5%db%8c', '', '', '2019-12-12 08:53:12', '2019-12-12 05:23:12', '', 0, 'http://mywebsite.test/?page_id=3', 99, 'page', '', 0),
(13, 2, '2019-12-12 08:21:17', '2019-12-12 04:51:17', '', 'آکادمی', '', 'publish', 'closed', 'closed', '', '%d8%a2%da%a9%d8%a7%d8%af%d9%85%db%8c', '', '', '2019-12-12 08:21:17', '2019-12-12 04:51:17', '', 0, 'http://mywebsite.test/?page_id=13', 0, 'page', '', 0),
(14, 2, '2019-12-12 08:21:17', '2019-12-12 04:51:17', '', 'آکادمی', '', 'inherit', 'closed', 'closed', '', '13-revision-v1', '', '', '2019-12-12 08:21:17', '2019-12-12 04:51:17', '', 13, 'http://mywebsite.test/?p=14', 0, 'revision', '', 0),
(15, 2, '2019-12-12 08:22:53', '2019-12-12 04:52:53', '', 'فروشگاه', '', 'publish', 'closed', 'closed', '', '%d9%81%d8%b1%d9%88%d8%b4%da%af%d8%a7%d9%87', '', '', '2019-12-12 08:22:53', '2019-12-12 04:52:53', '', 0, 'http://mywebsite.test/?page_id=15', 0, 'page', '', 0),
(16, 2, '2019-12-12 08:22:53', '2019-12-12 04:52:53', '', 'فروشگاه', '', 'inherit', 'closed', 'closed', '', '15-revision-v1', '', '', '2019-12-12 08:22:53', '2019-12-12 04:52:53', '', 15, 'http://mywebsite.test/?p=16', 0, 'revision', '', 0),
(17, 2, '2019-12-12 08:24:03', '2019-12-12 04:54:03', '', 'برندینگ', '', 'publish', 'closed', 'closed', '', '%d8%a8%d8%b1%d9%86%d8%af%db%8c%d9%86%da%af', '', '', '2019-12-12 08:24:03', '2019-12-12 04:54:03', '', 0, 'http://mywebsite.test/?page_id=17', 0, 'page', '', 0),
(18, 2, '2019-12-12 08:24:03', '2019-12-12 04:54:03', '', 'برندینگ', '', 'inherit', 'closed', 'closed', '', '17-revision-v1', '', '', '2019-12-12 08:24:03', '2019-12-12 04:54:03', '', 17, 'http://mywebsite.test/?p=18', 0, 'revision', '', 0),
(20, 2, '2019-12-12 08:40:34', '2019-12-12 05:10:34', '<!-- wp:heading --><h2>ما که هستیم</h2><!-- /wp:heading --><!-- wp:paragraph --><p>نشانی وب‌سایت ما: http://mywebsite.test.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>کدامیک از اطلاعات شخصی را جمع آوری میکنیم و چرا</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>دیدگاه‌ها</h3><!-- /wp:heading --><!-- wp:paragraph --><p>هنگامی که بازدیدکنندگان نظرات خود را در سایت می‌نویسند، ما اطلاعاتی را که در فرم نظرات و همچنین بازدید کننده‌ها ارائه می‌شود جمع آوری می‌کنیم &#8217;s آدرس IP و رجیستر عامل کاربر مرورگر برای کمک به تشخیص هرزنامه.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>یک رشته ناشناس ایجاد شده از آدرس ایمیل شما (همچنین هش نامیده می‌شود) ممکن است به سرویس Gravatar ارائه شود تا ببینید آیا از آن استفاده می‌کنید. سیاست حفظ حریم خصوصی خدمات Gravatar در اینجا در دسترس است: https://automattic.com/privacy/. پس از تأیید نظر شما، تصویر نمایه شما در متن نظر شما قابل مشاهده است.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>رسانه</h3><!-- /wp:heading --><!-- wp:paragraph --><p>اگر تصاویر را به وبسایت آپلود کنید، نباید آپلود تصاویر با داده‌های مکان جغرافیایی (EXIF GPS) شامل شود. بازدیدکنندگان وب سایت می‌توانند هر گونه اطلاعات مکان را از تصاویر در وب سایت دانلود و استخراج کنند.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>فرم‌های تماس</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>کوکی‌ها</h3><!-- /wp:heading --><!-- wp:paragraph --><p>اگر شما نظر خود را در سایت ما ثبت کنید، ممکن است برای ذخیره نام، آدرس ایمیل و وب سایت خود در کوکی‌ها تصمیم گیری کنید. اینها برای راحتی شما هستند، به طوری که شما مجبور نیستید دوباره جزئیات خود را پر کنید زمانی که نظر دیگری را ترک کنید. این کوکی‌ها یک سال طول خواهد کشید.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>اگر از برگه ورود ما بازدید نمایید، ما یک کوکی موقت برای مشخص نمودن اینکه آیا مروگر شما کوکی قبول می‌کند را تنظیم می‌کنیم. این کوکی محتوای اطلاعات شخصی شما نیست و وقتی مرورگر شما بسته می‌شود از بین می‌رود.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>هنگام ورود به سیستم، ما همچنین کوکی‌ها را تنظیم خواهیم کرد تا اطلاعات ورود به سیستم و گزینه‌های صفحه نمایش خود را ذخیره کنید. کوکی‌های ورود به سیستم برای دو روز گذشته و کوکی‌های گزینه‌های صفحه نمایش برای یک سال گذشته است. اگر شما انتخاب کنید &quot; به یاد داشته باشید من Me&quot;، ورود شما برای دو هفته ادامه خواهد داشت. اگر از حساب خود خارج شوید، کوکی‌های ورود حذف خواهند شد.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>اگر یک مقاله را ویرایش یا منتشر کنید، یک کوکی اضافی در مرورگر شما ذخیره خواهد شد. این کوکی حاوی اطلاعات شخصی نیست و به سادگی نشان می‌دهد که شناسه پست مقاله شما فقط ویرایش شده است. بعد از یک روز منقضی می‌شود.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>محتوای جاسازی‌شده از دیگر وب‌سایت‌ها</h3><!-- /wp:heading --><!-- wp:paragraph --><p>مقالات موجود در این سایت ممکن است شامل محتوای تعبیه شده (مثلا ویدئوها، تصاویر، مقالات و غیره) باشد. مطالب جاسازی شده از وب سایت‌های دیگر رفتار دقیقا همان طوری که بازدید کننده از وب سایت دیگر بازدید کرده است.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>این وبسایت‌ها ممکن است اطلاعاتی مربوط به شما را جمع‌آوری کنند، از کوکی‌ها استفاده کنند، ردیابی سوم شخص اضافه را جاسازی کنند و تعامل شما را با محتوای تعبیه شده نظارت کنند که شامل ردیابی تعامل شما با محتوای جاسازی شده است اگر حساب کاربری داشته و به آن وبسایت وارد شده باشید.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>تجزیه و تحلیل</h3><!-- /wp:heading --><!-- wp:heading --><h2>اطلاعات شما را با چه کسی به اشتراک می‌گذاریم</h2><!-- /wp:heading --><!-- wp:heading --><h2>چه مدت ما اطلاعات شما را حفظ می‌کنیم</h2><!-- /wp:heading --><!-- wp:paragraph --><p>اگر یک نظر را ترک کنید، نظر و متادیتای آن به طور نامحدود حفظ می‌شوند. این به این معنا است که ما می‌توانیم به جای برگزاری آنها در یک خط مؤثر، به طور خودکار هر نظر پیگیری را تصدیق و تأیید کنیم.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>برای کاربرانی که در وب سایت ما ثبت نام می‌کنند (اگر وجود داشته باشند)، ما همچنین اطلاعات شخصی را که در مشخصات کاربر آنها ارائه می‌کنیم، ذخیره می‌کنیم. همه کاربران می‌توانند اطلاعات شخصی خود را در هر زمان (به جز آنها که نمی‌توانند نام کاربری خود را تغییر دهند) ببینند، ویرایش و یا حذف کنند. مدیران وب سایت همچنین می‌توانند این اطلاعات را مشاهده و ویرایش کنند.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>حقوقی که بر روی داده‌هایتان دارید</h2><!-- /wp:heading --><!-- wp:paragraph --><p>اگر در این سایت حساب کاربری دارید یا نظرها را ترک کرده اید، می‌توانید درخواست دریافت یک فایل صادر شده از اطلاعات شخصی که ما در مورد شما نگه می‌داریم، از جمله هر گونه داده‌ای که برای ما ارائه کرده اید. همچنین می‌توانید درخواست کنید که ما هر گونه اطلاعات شخصی که در مورد شما نگه داریم پاک کنیم. این شامل اطلاعاتی نیست که ما مجبور به نگهداری آنها برای اهداف اداری، قانونی یا امنیتی باشیم.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>داده‌های شما را به کجا ارسال می‌کنیم</h2><!-- /wp:heading --><!-- wp:paragraph --><p>دیدگاه‌های بازدیدکننده ممکن است از طریق یک سرویس تشخیص جفنگ خودکار بررسی شوند.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>اطلاعات تماس شما</h2><!-- /wp:heading --><!-- wp:heading --><h2>اطلاعات اضافی</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>چگونه از اطلاعات شما حفاظت می‌کنیم</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>چه رویه‌های نقض اطلاعات در حال حاضر وجود دارد</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>چه چیز جدیدی از داده‌ها دریافت می‌کنیم</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>تصمیم گیری خودکار و / یا پروفایل ما با داده‌های کاربر انجام می‌شود</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>الزامات افشای قانونی صنعت</h3><!-- /wp:heading -->', 'سیاست حریم خصوصی', '', 'inherit', 'closed', 'closed', '', '3-revision-v1', '', '', '2019-12-12 08:40:34', '2019-12-12 05:10:34', '', 3, 'http://mywebsite.test/2019/12/12/3-revision-v1-20084034', 0, 'revision', '', 0),
(21, 2, '2019-12-12 08:42:40', '2019-12-12 05:12:40', ' ', '', '', 'publish', 'closed', 'closed', '', '21', '', '', '2019-12-12 09:17:22', '2019-12-12 05:47:22', '', 0, 'http://mywebsite.test/?p=21', 3, 'nav_menu_item', '', 0),
(22, 2, '2019-12-12 08:42:41', '2019-12-12 05:12:41', ' ', '', '', 'publish', 'closed', 'closed', '', '22', '', '', '2019-12-12 09:17:22', '2019-12-12 05:47:22', '', 0, 'http://mywebsite.test/?p=22', 2, 'nav_menu_item', '', 0),
(23, 2, '2019-12-12 08:42:41', '2019-12-12 05:12:41', ' ', '', '', 'publish', 'closed', 'closed', '', '23', '', '', '2019-12-12 09:17:21', '2019-12-12 05:47:21', '', 0, 'http://mywebsite.test/?p=23', 1, 'nav_menu_item', '', 0),
(24, 2, '2019-12-12 08:45:12', '2019-12-12 05:15:12', '<!-- wp:paragraph -->\n<p> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.<br>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.<br>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. </p>\n<!-- /wp:paragraph -->', 'درباره ما', '', 'publish', 'closed', 'closed', '', '%d8%af%d8%b1%d8%a8%d8%a7%d8%b1%d9%87-%d9%85%d8%a7', '', '', '2019-12-12 08:45:12', '2019-12-12 05:15:12', '', 0, 'http://mywebsite.test/?page_id=24', 0, 'page', '', 0),
(25, 2, '2019-12-12 08:45:12', '2019-12-12 05:15:12', '<!-- wp:paragraph -->\n<p> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.<br>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.<br>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. </p>\n<!-- /wp:paragraph -->', 'درباره ما', '', 'inherit', 'closed', 'closed', '', '24-revision-v1', '', '', '2019-12-12 08:45:12', '2019-12-12 05:15:12', '', 24, 'http://mywebsite.test/2019/12/12/24-revision-v1-25084512', 0, 'revision', '', 0),
(26, 2, '2019-12-12 08:45:58', '2019-12-12 05:15:58', '<!-- wp:paragraph -->\n<p>جالب است بدانید که متد Content First Design محدود به طراحی سایت نشده و در طراحی بسته بندی، کاتالوگ و بسیاری از محصولات چاپی به آن توجه میشود. به عنوان مثال برای طراحی جلد یک کتاب حتما باید از محتوای ارائه شده در آن اطلاع داشته باشیم و براساس عنوان یا دسته بندی نمیتوان ظاهر زیبا و مرتبطی برای جلد آن طراحی کرد.<br></p>\n<!-- /wp:paragraph -->', 'تماس با ما', '', 'publish', 'closed', 'closed', '', '%d8%aa%d9%85%d8%a7%d8%b3-%d8%a8%d8%a7-%d9%85%d8%a7', '', '', '2019-12-12 08:51:19', '2019-12-12 05:21:19', '', 0, 'http://mywebsite.test/?page_id=26', 0, 'page', '', 0),
(27, 2, '2019-12-12 08:45:58', '2019-12-12 05:15:58', '<!-- wp:paragraph -->\n<p> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.<br> </p>\n<!-- /wp:paragraph -->', 'تماس با ما', '', 'inherit', 'closed', 'closed', '', '26-revision-v1', '', '', '2019-12-12 08:45:58', '2019-12-12 05:15:58', '', 26, 'http://mywebsite.test/2019/12/12/26-revision-v1-27084558', 0, 'revision', '', 0),
(28, 2, '2019-12-12 08:51:19', '2019-12-12 05:21:19', '<!-- wp:paragraph -->\n<p>جالب است بدانید که متد Content First Design محدود به طراحی سایت نشده و در طراحی بسته بندی، کاتالوگ و بسیاری از محصولات چاپی به آن توجه میشود. به عنوان مثال برای طراحی جلد یک کتاب حتما باید از محتوای ارائه شده در آن اطلاع داشته باشیم و براساس عنوان یا دسته بندی نمیتوان ظاهر زیبا و مرتبطی برای جلد آن طراحی کرد.<br></p>\n<!-- /wp:paragraph -->', 'تماس با ما', '', 'inherit', 'closed', 'closed', '', '26-revision-v1', '', '', '2019-12-12 08:51:19', '2019-12-12 05:21:19', '', 26, 'http://mywebsite.test/2019/12/12/26-revision-v1-28085119', 0, 'revision', '', 0),
(29, 2, '2019-12-12 08:52:08', '2019-12-12 05:22:08', ' ', '', '', 'publish', 'closed', 'closed', '', '29', '', '', '2019-12-12 09:17:22', '2019-12-12 05:47:22', '', 0, 'http://mywebsite.test/?p=29', 5, 'nav_menu_item', '', 0),
(30, 2, '2019-12-12 08:52:07', '2019-12-12 05:22:07', ' ', '', '', 'publish', 'closed', 'closed', '', '30', '', '', '2019-12-12 09:17:22', '2019-12-12 05:47:22', '', 0, 'http://mywebsite.test/?p=30', 4, 'nav_menu_item', '', 0),
(31, 2, '2019-12-14 14:47:51', '2019-12-14 11:17:51', '<!-- wp:paragraph -->\n<p>به وردپرس خوش آمدید. این اولین نوشته‌ی شماست. این را ویرایش یا حذف کنید، سپس نوشتن را شروع نمایید!</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>این یک حقیقت تلخ است که همه کاربران به ظاهر سایت شما توجه میکنند. بعنوان مثال میتوان از روی جلد یک کتاب حدودا تشخیص داد که چه سالی منتشر شده و چقدر کهنه است. همین دید نسبت به وبسایت نیز وجود دارد. تحقیقات آماری نشان میدهد که نزدیک به ۹۴ درصد کاربران به سایت هایی با طراحی قدیمی و کاربری سخت اعتماد نمیکنند و ممکن است به سرعت سایت شما را ترک کنند. متاسفانه این دست طراحی ها در سایت های دولتی و پرتال های کاربردی بسیار به چشم میخورد و کاربران مجبور به استفاده از این فضاها میشوند.<br>\nنمیتوان یک ادبیات مشخص برای همه سایت های اینترنتی تعیین کرد بلکه باید براساس مخاطبین سایت و نوع محصولات یا خدمات عرض شده ادبیات خود را مشخص کنید. بعنوان مثال اگر مخاطبین شما در گروه سنی جوان هستند استفاده از کلمات دشوار و مفاهیم سنگین نمیتواند جذاب باشد و در مقابل برای سایت هایی در زمینه اقتصاد و سیاست نمیتوان از کلمات و عبارات روزمره استفاده نمود.<br>\nمدت هاست که استفاده از Flash Player در طراحی وب سایت منسوخ شده است، در حالیکه تا همین چند سال پیش بعنوان یکی از تکنولوژی های پرطرفدار طراحی سایت محسوب میشد. اما هنوز سایت هایی وجود دارند که بخش هایی از محتوا یا المان های آنها با استفاده از فلش در سایت نمایش داده میشوند. این تکنولوژی هم اکنون در بسیاری مرورگرها غیرفعال شده و برای استفاده از آن نیاز به اجازه مستقیم کاربر است. همچنین حجم صفحاتی از این دست بسیار بالا بوده و زمان بسیاری برای نمایش محتوا به کاربر نیاز دارند.<br>\nشاید تا به حال برایتان پیش آمده که از کنار یک مغازه عبور کنید و ناگهان مجذوب دکور یا ویترین آن شوید. همین ویترین مجلل و زیباست که باعث می‌شود که اگر نیازی به محتویات داخل مغازه نداشته باشید هم راه خود را کج کنید و وارد مغازه شوید. مغازه دار از چه ترفندی استفاده کرده که توجه شما اینقدر به ویترین جلب شد و شما را مجبور کرد تا وارد این فروشگاه شوید؟<br>\nنمایش ویدیو در بک گراند صفحه اصلی معمولا در بالاترین بخش صفحه انجام میشود؛ جایی که کاربر اولین نمای سایت را مشاهده میکند. استفاده از ویدیو به عنوان بک گراند به نسبت تکنیک های دیگر جدید است و البته استفاده از آن محدود است زیرا موجب افزایش حجم صفحه و کاهش سرعت لود آن میشود.</p>\n<!-- /wp:paragraph -->', 'سلام دنیا!', '', 'inherit', 'closed', 'closed', '', '1-revision-v1', '', '', '2019-12-14 14:47:51', '2019-12-14 11:17:51', '', 1, 'http://mywebsite.test/2019/12/14/1-revision-v1-31144751', 0, 'revision', '', 0),
(32, 2, '2019-12-14 15:12:15', '2019-12-14 11:42:15', '<!-- wp:paragraph -->\n<p>بسیاری از سیستم های مدیریت محتوا که برای ساخت فروشگاه اینترنتی استفاده میشوند امکانات کامل ولی مشابهی را در اختیار شما قرار میدهند. به عنوان مثال قابلیت هایی مانند مقایسه و افزودن به لیست علاقه مندی ها برای یک فروشگاه اینترنتی که در حوزه فروش میوه فعالیت میکند هیچ کاربردی ندارد.<br>\nبرخی از وبسایت ها در ارائه محتوا از المان های مختلفی همچون جداول یا نقل قول ها استفاده می کنند. اگر بدانید که چه روش هایی از ارائه محتوا بیشتر از همه مورد استفاده نویسندگان وبسایت شماست می توانید با تمرکز بر آنها طراحی سایت را زیباتر و کاربردی‌تر کنید.<br>\nتکنیک استفاده از تصاویر بزرگ در طراحی سایت که اصطلاحا با نام hero images شناخته میشود یکی از رایج ترین المان های موجود در سایت های مدرن محسوب میشود و مهم ترین دلیل رواج آن کارایی بالا برای انتقال سریع و شفاف پیام به مخاطب است. میتوان گفت این تکنیک جایگزین مناسبی برای اسلایدر است که هم موجب میشود حجم صفحه بالا نرود و هم به جای نمایش چند اسلاید تمرکز آن بر روی یک پیام مشخص است.<br>\nدر سال ۲۰۱۳ کمپانی اپل طراحی سایت خود را از پایه تغییر داده و از طراحی فلت در طراحی سایت خود استفاده نمود. طراحی فلت به معنی پرهیز از هرگونه طراحی سه بعدی در صفحه مانند سایه است. طراحی فلت موجب میشود درک کاربران از محتوای صفحه افزایش یافته و سرعت بارگذاری صفحه افزایش یابد.<br>\nرعایت ویژگی های زیبایی شناسی در طراحی سایت شرکتی از اهمیت ویژه ای برخوردار می باشد. تحقیقات نشان داده است بسیاری از افراد با توجه به زیبایی کلی سایت شرکتی در مورد اعتبار آن تصمیم می گیرند و به وجود انسجام و یکپارچگی سایت با برند تجاری شرکت اهمیت زیادی می دهند. این ویژگی به این معنی می باشد که علاوه بر طراحی کلی سایت ، المان هایی از جمله رنگ، فونت، لوگو و تصاویر در جذب مشتریان موثر است.</p>\n<!-- /wp:paragraph -->', 'پست ۱', '', 'publish', 'open', 'open', '', '%d9%be%d8%b3%d8%aa-%db%b1', '', '', '2019-12-14 15:12:15', '2019-12-14 11:42:15', '', 0, 'http://mywebsite.test/?p=32', 0, 'post', '', 0),
(33, 2, '2019-12-14 15:12:15', '2019-12-14 11:42:15', '<!-- wp:paragraph -->\n<p>بسیاری از سیستم های مدیریت محتوا که برای ساخت فروشگاه اینترنتی استفاده میشوند امکانات کامل ولی مشابهی را در اختیار شما قرار میدهند. به عنوان مثال قابلیت هایی مانند مقایسه و افزودن به لیست علاقه مندی ها برای یک فروشگاه اینترنتی که در حوزه فروش میوه فعالیت میکند هیچ کاربردی ندارد.<br>\nبرخی از وبسایت ها در ارائه محتوا از المان های مختلفی همچون جداول یا نقل قول ها استفاده می کنند. اگر بدانید که چه روش هایی از ارائه محتوا بیشتر از همه مورد استفاده نویسندگان وبسایت شماست می توانید با تمرکز بر آنها طراحی سایت را زیباتر و کاربردی‌تر کنید.<br>\nتکنیک استفاده از تصاویر بزرگ در طراحی سایت که اصطلاحا با نام hero images شناخته میشود یکی از رایج ترین المان های موجود در سایت های مدرن محسوب میشود و مهم ترین دلیل رواج آن کارایی بالا برای انتقال سریع و شفاف پیام به مخاطب است. میتوان گفت این تکنیک جایگزین مناسبی برای اسلایدر است که هم موجب میشود حجم صفحه بالا نرود و هم به جای نمایش چند اسلاید تمرکز آن بر روی یک پیام مشخص است.<br>\nدر سال ۲۰۱۳ کمپانی اپل طراحی سایت خود را از پایه تغییر داده و از طراحی فلت در طراحی سایت خود استفاده نمود. طراحی فلت به معنی پرهیز از هرگونه طراحی سه بعدی در صفحه مانند سایه است. طراحی فلت موجب میشود درک کاربران از محتوای صفحه افزایش یافته و سرعت بارگذاری صفحه افزایش یابد.<br>\nرعایت ویژگی های زیبایی شناسی در طراحی سایت شرکتی از اهمیت ویژه ای برخوردار می باشد. تحقیقات نشان داده است بسیاری از افراد با توجه به زیبایی کلی سایت شرکتی در مورد اعتبار آن تصمیم می گیرند و به وجود انسجام و یکپارچگی سایت با برند تجاری شرکت اهمیت زیادی می دهند. این ویژگی به این معنی می باشد که علاوه بر طراحی کلی سایت ، المان هایی از جمله رنگ، فونت، لوگو و تصاویر در جذب مشتریان موثر است.</p>\n<!-- /wp:paragraph -->', 'پست ۱', '', 'inherit', 'closed', 'closed', '', '32-revision-v1', '', '', '2019-12-14 15:12:15', '2019-12-14 11:42:15', '', 32, 'http://mywebsite.test/2019/12/14/32-revision-v1-33151215', 0, 'revision', '', 0),
(34, 2, '2019-12-14 15:14:17', '2019-12-14 11:44:17', '<!-- wp:paragraph -->\n<p>این یک حقیقت تلخ است که همه کاربران به ظاهر سایت شما توجه میکنند. بعنوان مثال میتوان از روی جلد یک کتاب حدودا تشخیص داد که چه سالی منتشر شده و چقدر کهنه است. همین دید نسبت به وبسایت نیز وجود دارد. تحقیقات آماری نشان میدهد که نزدیک به ۹۴ درصد کاربران به سایت هایی با طراحی قدیمی و کاربری سخت اعتماد نمیکنند و ممکن است به سرعت سایت شما را ترک کنند. متاسفانه این دست طراحی ها در سایت های دولتی و پرتال های کاربردی بسیار به چشم میخورد و کاربران مجبور به استفاده از این فضاها میشوند.<br>\nمهمترین چالشی که با آن روبرو خواهید بود سایز صفحه نمایش کاربران و تنوع تلفن های همراه است. ممکن است تصویر شما برای نسخه دسکتاپ سایت کاملا جذاب و قابل درک باشد ولی هنگام نمایش آن در موبایل یا باید در سایز کوچک نمایش داده شود و یا بخش هایی از آن بریده خواهد شد. در این صورت پیام شما به درستی به مخاطب منتقل نشده و نقطه قوت سایت به نقطه ضعف آن تبدیل میشود.<br>\nیکی از تکنیک های جانبی برای افزایش کارایی طراحی نیمه فلت استفاده از فضای منفی در صفحه است. فضاهای خالی که میان المان های مختلف قرار داده میشود به کاربر کمک میکند تا محتوای مورد نظر خود را سریعتر پیدا کرده و مرز بندی بخش های مختلف صفحه را درک کند.</p>\n<!-- /wp:paragraph -->', 'پست دو', '', 'publish', 'open', 'open', '', '%d9%be%d8%b3%d8%aa-%d8%af%d9%88', '', '', '2019-12-14 15:14:17', '2019-12-14 11:44:17', '', 0, 'http://mywebsite.test/?p=34', 0, 'post', '', 0),
(35, 2, '2019-12-14 15:14:17', '2019-12-14 11:44:17', '<!-- wp:paragraph -->\n<p>این یک حقیقت تلخ است که همه کاربران به ظاهر سایت شما توجه میکنند. بعنوان مثال میتوان از روی جلد یک کتاب حدودا تشخیص داد که چه سالی منتشر شده و چقدر کهنه است. همین دید نسبت به وبسایت نیز وجود دارد. تحقیقات آماری نشان میدهد که نزدیک به ۹۴ درصد کاربران به سایت هایی با طراحی قدیمی و کاربری سخت اعتماد نمیکنند و ممکن است به سرعت سایت شما را ترک کنند. متاسفانه این دست طراحی ها در سایت های دولتی و پرتال های کاربردی بسیار به چشم میخورد و کاربران مجبور به استفاده از این فضاها میشوند.<br>\nمهمترین چالشی که با آن روبرو خواهید بود سایز صفحه نمایش کاربران و تنوع تلفن های همراه است. ممکن است تصویر شما برای نسخه دسکتاپ سایت کاملا جذاب و قابل درک باشد ولی هنگام نمایش آن در موبایل یا باید در سایز کوچک نمایش داده شود و یا بخش هایی از آن بریده خواهد شد. در این صورت پیام شما به درستی به مخاطب منتقل نشده و نقطه قوت سایت به نقطه ضعف آن تبدیل میشود.<br>\nیکی از تکنیک های جانبی برای افزایش کارایی طراحی نیمه فلت استفاده از فضای منفی در صفحه است. فضاهای خالی که میان المان های مختلف قرار داده میشود به کاربر کمک میکند تا محتوای مورد نظر خود را سریعتر پیدا کرده و مرز بندی بخش های مختلف صفحه را درک کند.</p>\n<!-- /wp:paragraph -->', 'پست دو', '', 'inherit', 'closed', 'closed', '', '34-revision-v1', '', '', '2019-12-14 15:14:17', '2019-12-14 11:44:17', '', 34, 'http://mywebsite.test/2019/12/14/34-revision-v1-35151417', 0, 'revision', '', 0),
(36, 2, '2019-12-14 15:15:08', '2019-12-14 11:45:08', '<!-- wp:paragraph -->\n<p>بسیاری از سیستم های مدیریت محتوا که برای ساخت فروشگاه اینترنتی استفاده میشوند امکانات کامل ولی مشابهی را در اختیار شما قرار میدهند. به عنوان مثال قابلیت هایی مانند مقایسه و افزودن به لیست علاقه مندی ها برای یک فروشگاه اینترنتی که در حوزه فروش میوه فعالیت میکند هیچ کاربردی ندارد.<br> شاید تا به حال برایتان پیش آمده که از کنار یک مغازه عبور کنید و ناگهان مجذوب دکور یا ویترین آن شوید. همین ویترین مجلل و زیباست که باعث می‌شود که اگر نیازی به محتویات داخل مغازه نداشته باشید هم راه خود را کج کنید و وارد مغازه شوید. مغازه دار از چه ترفندی استفاده کرده که توجه شما اینقدر به ویترین جلب شد و شما را مجبور کرد تا وارد این فروشگاه شوید؟<br> فرض کنید یک پروژه جدید برای طراحی سایت به شما واگذار شده است و قصد دارید تمام دانش و تجربه خود را صرف طراحی یک سایت زیبا و کاربردی کنید. در اولین قدم تمام ویژگی‌های یک وب‌سایت خوب را از ذهن می‌گذرانید و تصمیم می‌گیرید همه این ایده‌ها را در سایت خود پیاده کنید. اما شاید لازم باشد درباره این روند بیشتر با خودتان فکر کنید. شاید این سوال برایتان پیش بیاید که اجرای تمام ویژگی‌های خوب در وب‌سایت چه اشکالی می‌تواند داشته باشد؟<br> استفاده از گرادیان در طراحی بک گراند صفحه موجب حرکت چشمان کاربر در تصویر میشود؛ مردمک چشم کاربر به یک نقطه از تصویر متمرکز می شود و به خاطر تغییر در طیف رنگ ها و سایه ها، چشمان او ناخودآگاه از یک طرف صفحه نمایش به سمت دیگر هدایت می شوند. گرادیان ابزار خوبی برای مجذوب کردن کاربران بوده و طرح های خسته کننده را زیبا و دلنشین می کند.<br> نمایش ویدیو در بک گراند صفحه اصلی معمولا در بالاترین بخش صفحه انجام میشود؛ جایی که کاربر اولین نمای سایت را مشاهده میکند. استفاده از ویدیو به عنوان بک گراند به نسبت تکنیک های دیگر جدید است و البته استفاده از آن محدود است زیرا موجب افزایش حجم صفحه و کاهش سرعت لود آن میشود.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>مدت هاست که استفاده از Flash Player در طراحی وب سایت منسوخ شده است، در حالیکه تا همین چند سال پیش بعنوان یکی از تکنولوژی های پرطرفدار طراحی سایت محسوب میشد. اما هنوز سایت هایی وجود دارند که بخش هایی از محتوا یا المان های آنها با استفاده از فلش در سایت نمایش داده میشوند. این تکنولوژی هم اکنون در بسیاری مرورگرها غیرفعال شده و برای استفاده از آن نیاز به اجازه مستقیم کاربر است. همچنین حجم صفحاتی از این دست بسیار بالا بوده و زمان بسیاری برای نمایش محتوا به کاربر نیاز دارند.<br>\nاحتمالا برای خود شما هم اتفاق افتاده است که وارد یک سایت میشوید و به دنبال اطلاعات خاصی در آن هستید ولی نمیتوانید مسیر مناسب برای دسترسی به آن را پیدا کنید. در این شرایط احتمالا فکر میکنید طراح این سایت هیچ تفکر و تجربه ای در ساخت آن نداشته است.<br>\nدر گذشته نه چندان دور فضای وب فارسی به چند فونت خاصی شامل arial، Tahoma و در مواردی BYekan محدود میشد ولی خوشبختانه در حال حاضر تنوع فونت های فارسی در دسترسی برای طراحی سایت بسیار زیاد شده است. با وجود تنوع زیاد، بسیاری از شرکت ها تلاش میکنند با طراحی یک فونت اختصاصی سایت و هویت برند خود را متمایز از دیگران ارایه کنند.<br>\nپیش از آنکه به مشکلات این تکنیک اشاره کنیم پیشنهاد میکنم مقاله استفاده از ویدیو بک گراند در طراحی سایت را مطالعه کنید. مهمترین مشکل موجود در این تکنیک حجم بالای ویدیو است، اگر ویدیویی که استفاده میکنید همخوانی لازم با سرعت اینترنت کاربران را نداشته باشد شانس دیده شدن و تاثیرگذاری آن به شدت کاهش خواهد یافت. در حال حاضر طراحان این تکنیک را به برخی از مشتریان طراحی سایت خود پیشنهاد میدهد و بیشتر برای افرادی کارایی دارد که ارایه دهنده خدمات یا محصولات لوکس هستند.<br>\nبا استفاده از اطلاعات به دست آمده شما میتوانید مهمترین صفحات سایت خود را شناسایی کرده و کلماتی که در حال حاضر جایگاه مناسبی در نتایج گوگل دارند را بدست آورید. در فرآیند بازطراحی باید برنامه ویژه ای برای این صفحات و عبارات هدف آنها داشته باشیم تا این فرآیند علاوه بر بهبود تجربه کاربری موجب بهبود وضعیت سئو سایت شما شود.</p>\n<!-- /wp:paragraph -->', 'پست سوم', '', 'publish', 'open', 'open', '', '%d9%be%d8%b3%d8%aa-%d8%b3%d9%88%d9%85', '', '', '2019-12-19 12:39:47', '2019-12-19 09:09:47', '', 0, 'http://mywebsite.test/?p=36', 0, 'post', '', 0),
(37, 2, '2019-12-14 15:15:08', '2019-12-14 11:45:08', '<!-- wp:paragraph -->\n<p>بسیاری از سیستم های مدیریت محتوا که برای ساخت فروشگاه اینترنتی استفاده میشوند امکانات کامل ولی مشابهی را در اختیار شما قرار میدهند. به عنوان مثال قابلیت هایی مانند مقایسه و افزودن به لیست علاقه مندی ها برای یک فروشگاه اینترنتی که در حوزه فروش میوه فعالیت میکند هیچ کاربردی ندارد.<br>\nشاید تا به حال برایتان پیش آمده که از کنار یک مغازه عبور کنید و ناگهان مجذوب دکور یا ویترین آن شوید. همین ویترین مجلل و زیباست که باعث می‌شود که اگر نیازی به محتویات داخل مغازه نداشته باشید هم راه خود را کج کنید و وارد مغازه شوید. مغازه دار از چه ترفندی استفاده کرده که توجه شما اینقدر به ویترین جلب شد و شما را مجبور کرد تا وارد این فروشگاه شوید؟<br>\nفرض کنید یک پروژه جدید برای طراحی سایت به شما واگذار شده است و قصد دارید تمام دانش و تجربه خود را صرف طراحی یک سایت زیبا و کاربردی کنید. در اولین قدم تمام ویژگی‌های یک وب‌سایت خوب را از ذهن می‌گذرانید و تصمیم می‌گیرید همه این ایده‌ها را در سایت خود پیاده کنید. اما شاید لازم باشد درباره این روند بیشتر با خودتان فکر کنید. شاید این سوال برایتان پیش بیاید که اجرای تمام ویژگی‌های خوب در وب‌سایت چه اشکالی می‌تواند داشته باشد؟<br>\nاستفاده از گرادیان در طراحی بک گراند صفحه موجب حرکت چشمان کاربر در تصویر میشود؛ مردمک چشم کاربر به یک نقطه از تصویر متمرکز می شود و به خاطر تغییر در طیف رنگ ها و سایه ها، چشمان او ناخودآگاه از یک طرف صفحه نمایش به سمت دیگر هدایت می شوند. گرادیان ابزار خوبی برای مجذوب کردن کاربران بوده و طرح های خسته کننده را زیبا و دلنشین می کند.<br>\nنمایش ویدیو در بک گراند صفحه اصلی معمولا در بالاترین بخش صفحه انجام میشود؛ جایی که کاربر اولین نمای سایت را مشاهده میکند. استفاده از ویدیو به عنوان بک گراند به نسبت تکنیک های دیگر جدید است و البته استفاده از آن محدود است زیرا موجب افزایش حجم صفحه و کاهش سرعت لود آن میشود.</p>\n<!-- /wp:paragraph -->', 'پست سوم', '', 'inherit', 'closed', 'closed', '', '36-revision-v1', '', '', '2019-12-14 15:15:08', '2019-12-14 11:45:08', '', 36, 'http://mywebsite.test/2019/12/14/36-revision-v1-37151508', 0, 'revision', '', 0),
(38, 2, '2019-12-16 21:09:54', '0000-00-00 00:00:00', '', 'پیش‌نویس خودکار', '', 'auto-draft', 'open', 'open', '', '', '', '', '2019-12-16 21:09:54', '0000-00-00 00:00:00', '', 0, 'http://mywebsite.test/?p=38', 0, 'post', '', 0),
(39, 2, '2019-12-19 12:39:47', '2019-12-19 09:09:47', '<!-- wp:paragraph -->\n<p>بسیاری از سیستم های مدیریت محتوا که برای ساخت فروشگاه اینترنتی استفاده میشوند امکانات کامل ولی مشابهی را در اختیار شما قرار میدهند. به عنوان مثال قابلیت هایی مانند مقایسه و افزودن به لیست علاقه مندی ها برای یک فروشگاه اینترنتی که در حوزه فروش میوه فعالیت میکند هیچ کاربردی ندارد.<br> شاید تا به حال برایتان پیش آمده که از کنار یک مغازه عبور کنید و ناگهان مجذوب دکور یا ویترین آن شوید. همین ویترین مجلل و زیباست که باعث می‌شود که اگر نیازی به محتویات داخل مغازه نداشته باشید هم راه خود را کج کنید و وارد مغازه شوید. مغازه دار از چه ترفندی استفاده کرده که توجه شما اینقدر به ویترین جلب شد و شما را مجبور کرد تا وارد این فروشگاه شوید؟<br> فرض کنید یک پروژه جدید برای طراحی سایت به شما واگذار شده است و قصد دارید تمام دانش و تجربه خود را صرف طراحی یک سایت زیبا و کاربردی کنید. در اولین قدم تمام ویژگی‌های یک وب‌سایت خوب را از ذهن می‌گذرانید و تصمیم می‌گیرید همه این ایده‌ها را در سایت خود پیاده کنید. اما شاید لازم باشد درباره این روند بیشتر با خودتان فکر کنید. شاید این سوال برایتان پیش بیاید که اجرای تمام ویژگی‌های خوب در وب‌سایت چه اشکالی می‌تواند داشته باشد؟<br> استفاده از گرادیان در طراحی بک گراند صفحه موجب حرکت چشمان کاربر در تصویر میشود؛ مردمک چشم کاربر به یک نقطه از تصویر متمرکز می شود و به خاطر تغییر در طیف رنگ ها و سایه ها، چشمان او ناخودآگاه از یک طرف صفحه نمایش به سمت دیگر هدایت می شوند. گرادیان ابزار خوبی برای مجذوب کردن کاربران بوده و طرح های خسته کننده را زیبا و دلنشین می کند.<br> نمایش ویدیو در بک گراند صفحه اصلی معمولا در بالاترین بخش صفحه انجام میشود؛ جایی که کاربر اولین نمای سایت را مشاهده میکند. استفاده از ویدیو به عنوان بک گراند به نسبت تکنیک های دیگر جدید است و البته استفاده از آن محدود است زیرا موجب افزایش حجم صفحه و کاهش سرعت لود آن میشود.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>مدت هاست که استفاده از Flash Player در طراحی وب سایت منسوخ شده است، در حالیکه تا همین چند سال پیش بعنوان یکی از تکنولوژی های پرطرفدار طراحی سایت محسوب میشد. اما هنوز سایت هایی وجود دارند که بخش هایی از محتوا یا المان های آنها با استفاده از فلش در سایت نمایش داده میشوند. این تکنولوژی هم اکنون در بسیاری مرورگرها غیرفعال شده و برای استفاده از آن نیاز به اجازه مستقیم کاربر است. همچنین حجم صفحاتی از این دست بسیار بالا بوده و زمان بسیاری برای نمایش محتوا به کاربر نیاز دارند.<br>\nاحتمالا برای خود شما هم اتفاق افتاده است که وارد یک سایت میشوید و به دنبال اطلاعات خاصی در آن هستید ولی نمیتوانید مسیر مناسب برای دسترسی به آن را پیدا کنید. در این شرایط احتمالا فکر میکنید طراح این سایت هیچ تفکر و تجربه ای در ساخت آن نداشته است.<br>\nدر گذشته نه چندان دور فضای وب فارسی به چند فونت خاصی شامل arial، Tahoma و در مواردی BYekan محدود میشد ولی خوشبختانه در حال حاضر تنوع فونت های فارسی در دسترسی برای طراحی سایت بسیار زیاد شده است. با وجود تنوع زیاد، بسیاری از شرکت ها تلاش میکنند با طراحی یک فونت اختصاصی سایت و هویت برند خود را متمایز از دیگران ارایه کنند.<br>\nپیش از آنکه به مشکلات این تکنیک اشاره کنیم پیشنهاد میکنم مقاله استفاده از ویدیو بک گراند در طراحی سایت را مطالعه کنید. مهمترین مشکل موجود در این تکنیک حجم بالای ویدیو است، اگر ویدیویی که استفاده میکنید همخوانی لازم با سرعت اینترنت کاربران را نداشته باشد شانس دیده شدن و تاثیرگذاری آن به شدت کاهش خواهد یافت. در حال حاضر طراحان این تکنیک را به برخی از مشتریان طراحی سایت خود پیشنهاد میدهد و بیشتر برای افرادی کارایی دارد که ارایه دهنده خدمات یا محصولات لوکس هستند.<br>\nبا استفاده از اطلاعات به دست آمده شما میتوانید مهمترین صفحات سایت خود را شناسایی کرده و کلماتی که در حال حاضر جایگاه مناسبی در نتایج گوگل دارند را بدست آورید. در فرآیند بازطراحی باید برنامه ویژه ای برای این صفحات و عبارات هدف آنها داشته باشیم تا این فرآیند علاوه بر بهبود تجربه کاربری موجب بهبود وضعیت سئو سایت شما شود.</p>\n<!-- /wp:paragraph -->', 'پست سوم', '', 'inherit', 'closed', 'closed', '', '36-revision-v1', '', '', '2019-12-19 12:39:47', '2019-12-19 09:09:47', '', 36, 'http://mywebsite.test/2019/12/19/36-revision-v1_39', 0, 'revision', '', 0),
(40, 2, '2019-12-20 09:57:07', '0000-00-00 00:00:00', '', 'پیش‌نویس خودکار', '', 'auto-draft', 'open', 'open', '', '', '', '', '2019-12-20 09:57:07', '0000-00-00 00:00:00', '', 0, 'http://mywebsite.test/?p=40', 0, 'post', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pw_termmeta`
--

DROP TABLE IF EXISTS `pw_termmeta`;
CREATE TABLE `pw_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pw_terms`
--

DROP TABLE IF EXISTS `pw_terms`;
CREATE TABLE `pw_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pw_terms`
--

INSERT INTO `pw_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'دسته‌بندی نشده', '%d8%af%d8%b3%d8%aa%d9%87%e2%80%8c%d8%a8%d9%86%d8%af%db%8c-%d9%86%d8%b4%d8%af%d9%87', 0),
(2, 'fp-top-bar', 'fp-top-bar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pw_term_relationships`
--

DROP TABLE IF EXISTS `pw_term_relationships`;
CREATE TABLE `pw_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pw_term_relationships`
--

INSERT INTO `pw_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(21, 2, 0),
(22, 2, 0),
(23, 2, 0),
(29, 2, 0),
(30, 2, 0),
(32, 1, 0),
(34, 1, 0),
(36, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pw_term_taxonomy`
--

DROP TABLE IF EXISTS `pw_term_taxonomy`;
CREATE TABLE `pw_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pw_term_taxonomy`
--

INSERT INTO `pw_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 4),
(2, 2, 'nav_menu', '', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pw_usermeta`
--

DROP TABLE IF EXISTS `pw_usermeta`;
CREATE TABLE `pw_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pw_usermeta`
--

INSERT INTO `pw_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(24, 2, 'nickname', 'admin'),
(25, 2, 'first_name', 'وحید'),
(26, 2, 'last_name', 'میم'),
(27, 2, 'description', ''),
(28, 2, 'rich_editing', 'true'),
(29, 2, 'syntax_highlighting', 'true'),
(30, 2, 'comment_shortcuts', 'false'),
(31, 2, 'admin_color', 'fresh'),
(32, 2, 'use_ssl', '0'),
(33, 2, 'show_admin_bar_front', 'true'),
(34, 2, 'locale', ''),
(35, 2, 'pw_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(36, 2, 'pw_user_level', '10'),
(37, 2, 'dismissed_wp_pointers', ''),
(38, 2, 'session_tokens', 'a:1:{s:64:\"d39a599ef295360d136a9bd49b6652cbd6f71fbdb964a5abb63420353f95dd0d\";a:4:{s:10:\"expiration\";i:1578032825;s:2:\"ip\";s:9:\"127.0.0.1\";s:2:\"ua\";s:113:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36\";s:5:\"login\";i:1576823225;}}'),
(39, 2, 'pw_dashboard_quick_press_last_post_id', '40'),
(40, 2, 'community-events-location', 'a:1:{s:2:\"ip\";s:9:\"127.0.0.0\";}');

-- --------------------------------------------------------

--
-- Table structure for table `pw_users`
--

DROP TABLE IF EXISTS `pw_users`;
CREATE TABLE `pw_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pw_users`
--

INSERT INTO `pw_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(2, 'admin', '$P$BKwt8NgC5qzX/xNqJXIk2HonXv94/s0', 'admin', 'test2@mywebsite.test', 'http://mywebsite.test', '2019-12-20 06:25:35', '1576823137:$P$B12mjAmJxGZVmUjsXY1GcsT1LzhS2Y1', 0, 'وحید میم');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pw_commentmeta`
--
ALTER TABLE `pw_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `pw_comments`
--
ALTER TABLE `pw_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indexes for table `pw_links`
--
ALTER TABLE `pw_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `pw_options`
--
ALTER TABLE `pw_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`),
  ADD KEY `autoload` (`autoload`);

--
-- Indexes for table `pw_postmeta`
--
ALTER TABLE `pw_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `pw_posts`
--
ALTER TABLE `pw_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `pw_termmeta`
--
ALTER TABLE `pw_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `pw_terms`
--
ALTER TABLE `pw_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `pw_term_relationships`
--
ALTER TABLE `pw_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `pw_term_taxonomy`
--
ALTER TABLE `pw_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `pw_usermeta`
--
ALTER TABLE `pw_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `pw_users`
--
ALTER TABLE `pw_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pw_commentmeta`
--
ALTER TABLE `pw_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pw_comments`
--
ALTER TABLE `pw_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pw_links`
--
ALTER TABLE `pw_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pw_options`
--
ALTER TABLE `pw_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=389;

--
-- AUTO_INCREMENT for table `pw_postmeta`
--
ALTER TABLE `pw_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `pw_posts`
--
ALTER TABLE `pw_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pw_termmeta`
--
ALTER TABLE `pw_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pw_terms`
--
ALTER TABLE `pw_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pw_term_taxonomy`
--
ALTER TABLE `pw_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pw_usermeta`
--
ALTER TABLE `pw_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pw_users`
--
ALTER TABLE `pw_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
