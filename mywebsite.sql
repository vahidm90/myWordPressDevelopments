-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2019 at 02:45 AM
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
(1, 1, 'A WordPress Commenter', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2019-08-14 15:46:05', '2019-08-14 15:46:05', 'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href=\"https://gravatar.com\">Gravatar</a>.', 0, '1', '', '', 0, 0);

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
(3, 'blogname', 'My Personal Website', 'yes'),
(4, 'blogdescription', 'Just another WordPress site', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'test@mywebsite.test', 'yes'),
(7, 'start_of_week', '1', 'yes'),
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
(28, 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:90:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:58:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:68:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:88:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:83:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:83:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:64:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:53:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$\";s:91:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$\";s:85:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1\";s:77:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:72:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:65:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]\";s:72:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]\";s:61:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]\";s:47:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:57:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:77:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:72:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:72:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:53:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]\";s:51:\"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]\";s:38:\"([0-9]{4})/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&cpage=$matches[2]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:0:{}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'VM-WPT-Personal', 'yes'),
(41, 'stylesheet', 'VM-WPT-Personal', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '44719', 'yes'),
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
(79, 'widget_text', 'a:0:{}', 'yes'),
(80, 'widget_rss', 'a:0:{}', 'yes'),
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
(96, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(97, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(98, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(99, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(100, 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(101, 'sidebars_widgets', 'a:2:{s:19:\"wp_inactive_widgets\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:13:\"array_version\";i:3;}', 'yes'),
(102, 'cron', 'a:8:{i:1566002770;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1566013570;a:2:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1566013571;a:1:{s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1566056768;a:1:{s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1566056783;a:1:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1566056784;a:1:{s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1566056787;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}s:7:\"version\";i:2;}', 'yes'),
(103, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(104, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(105, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(106, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(113, 'recovery_keys', 'a:0:{}', 'yes'),
(114, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.2.2.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.2.2.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.2.2-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.2.2-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.2.2\";s:7:\"version\";s:5:\"5.2.2\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.0\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1566002681;s:15:\"version_checked\";s:5:\"5.2.2\";s:12:\"translations\";a:0:{}}', 'no'),
(116, '_site_transient_update_plugins', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1566002682;s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:0:{}}', 'no'),
(119, '_site_transient_update_themes', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1566002684;s:7:\"checked\";a:4:{s:20:\"RasoulShiri-Personal\";s:3:\"1.0\";s:3:\"SNT\";s:11:\"0.0.1 alpha\";s:15:\"VM-WPT-Personal\";s:3:\"1.0\";s:13:\"VMBusinessRep\";s:3:\"1.0\";}s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}}', 'no'),
(120, '_site_transient_timeout_browser_2be68fe1eb6a3565a2cb3a83c8a70998', '1566402385', 'no'),
(121, '_site_transient_browser_2be68fe1eb6a3565a2cb3a83c8a70998', 'a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:13:\"76.0.3809.100\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(122, '_site_transient_timeout_php_check_f0b6411b8c82dcf39302e5312c1fbd33', '1566402385', 'no'),
(123, '_site_transient_php_check_f0b6411b8c82dcf39302e5312c1fbd33', 'a:5:{s:19:\"recommended_version\";s:3:\"7.3\";s:15:\"minimum_version\";s:6:\"5.6.20\";s:12:\"is_supported\";b:1;s:9:\"is_secure\";b:1;s:13:\"is_acceptable\";b:1;}', 'no'),
(131, 'can_compress_scripts', '1', 'no'),
(138, 'theme_mods_twentynineteen', 'a:1:{s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1565797660;s:4:\"data\";a:2:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}}}}', 'yes'),
(139, 'current_theme', 'VM Personal', 'yes'),
(140, 'theme_mods_VM-WPT-Personal', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(141, 'theme_switched', '', 'yes'),
(209, 'category_children', 'a:3:{i:4;a:2:{i:0;i:5;i:1;i:13;}i:2;a:1:{i:0;i:11;}i:13;a:1:{i:0;i:14;}}', 'yes'),
(213, '_site_transient_timeout_theme_roots', '1566004483', 'no'),
(214, '_site_transient_theme_roots', 'a:4:{s:20:\"RasoulShiri-Personal\";s:7:\"/themes\";s:3:\"SNT\";s:7:\"/themes\";s:15:\"VM-WPT-Personal\";s:7:\"/themes\";s:13:\"VMBusinessRep\";s:7:\"/themes\";}', 'no');

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
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default'),
(3, 5, '_edit_lock', '1565882355:1'),
(4, 5, '_oembed_b5bb4785f74722b84bea26aa1ad74301', '{{unknown}}'),
(5, 5, '_oembed_6392cac532399305d26fbcb228346f1f', '{{unknown}}'),
(6, 5, '_oembed_996e8ac30a14814a396caed2d561fb6d', '{{unknown}}'),
(7, 5, '_oembed_d2c19543d0003297836d5385fec6eaff', '{{unknown}}'),
(8, 5, '_oembed_6606f8b19291a8cc9a522a6ae5085499', '{{unknown}}'),
(9, 5, '_oembed_1aecef73c6373e8737948b72448ec1ae', '{{unknown}}'),
(10, 5, '_oembed_3457f5e79c7e9ab873f14b4041a3e4d2', '{{unknown}}'),
(12, 7, '_edit_lock', '1565956808:1');

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
(1, 1, '2019-08-14 15:46:05', '2019-08-14 15:46:05', '<!-- wp:paragraph -->\n<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>\n<!-- /wp:paragraph -->', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2019-08-14 15:46:05', '2019-08-14 15:46:05', '', 0, 'http://mywebsite.test/?p=1', 0, 'post', '', 1),
(2, 1, '2019-08-14 15:46:05', '2019-08-14 15:46:05', '<!-- wp:paragraph -->\n<p>This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>...or something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>As a new WordPress user, you should go to <a href=\"http://mywebsite.test/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>\n<!-- /wp:paragraph -->', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2019-08-14 15:46:05', '2019-08-14 15:46:05', '', 0, 'http://mywebsite.test/?page_id=2', 0, 'page', '', 0),
(3, 1, '2019-08-14 15:46:05', '2019-08-14 15:46:05', '<!-- wp:heading --><h2>Who we are</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Our website address is: http://mywebsite.test.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>What personal data we collect and why we collect it</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Comments</h3><!-- /wp:heading --><!-- wp:paragraph --><p>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Media</h3><!-- /wp:heading --><!-- wp:paragraph --><p>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Contact forms</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Cookies</h3><!-- /wp:heading --><!-- wp:paragraph --><p>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Embedded content from other websites</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Analytics</h3><!-- /wp:heading --><!-- wp:heading --><h2>Who we share your data with</h2><!-- /wp:heading --><!-- wp:heading --><h2>How long we retain your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>What rights you have over your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Where we send your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Visitor comments may be checked through an automated spam detection service.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Your contact information</h2><!-- /wp:heading --><!-- wp:heading --><h2>Additional information</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>How we protect your data</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What data breach procedures we have in place</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What third parties we receive data from</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What automated decision making and/or profiling we do with user data</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Industry regulatory disclosure requirements</h3><!-- /wp:heading -->', 'Privacy Policy', '', 'draft', 'closed', 'open', '', 'privacy-policy', '', '', '2019-08-14 15:46:05', '2019-08-14 15:46:05', '', 0, 'http://mywebsite.test/?page_id=3', 0, 'page', '', 0),
(4, 1, '2019-08-14 15:46:26', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2019-08-14 15:46:26', '0000-00-00 00:00:00', '', 0, 'http://mywebsite.test/?p=4', 0, 'post', '', 0),
(5, 1, '2019-08-15 15:17:47', '2019-08-15 15:17:47', '<!-- wp:paragraph {\"className\":\"purpose\"} -->\n<p class=\"purpose\">We want to collect certain files of a given directory and some of its subdirectories and put them in a single archive file. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"objective\"} -->\n<p class=\"objective\">This article helps you <span class=\"obj-part\">create a \'.bat\' file</span> which archives <span class=\"obj-part\">certain file types (based on extensions or partial names)</span> of <span class=\"obj-part\">desired subdirectories (you pick which directories/paths to include/exclude)</span> inside a parent directory <span class=\"obj-part\">in a \'.zip\' file</span>, using the MS Windows command-line interface.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"prerequisite\"} -->\n<p class=\"prerequisite\">Here, we assume that</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:list {\"ordered\":true,\"className\":\"prerequisite\"} -->\n<ol class=\"prerequisite\"><li>You know how to create a blank text file in Windows and convert it to a DOS batch (\".bat\") file. </li><li>You are familiar with the MS Windows command-line interface (aka \"cmd\")  and its basic functionalities.</li><li>You are familiar with regular expressions. </li><li>You have installed the \"7-zip Extra: standalone console version\".</li></ol>\n<!-- /wp:list -->\n\n<!-- wp:paragraph -->\n<p>In the parent directory where your target files/folders are located (this could be the root of a partition), create a new text file. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Insert the following in the text file:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"code\"} -->\n<p class=\"code\"><code>FOR /F \"delims=\" %%A IN (\'DIR /S /B ^| findstr \"^.*\\\\{directory}\\\\.*$ ^.*{file name without extension}\\..*$ ^.*{{file name}\\.{file extension}}$ ^.*{partial file name}.*$ ^.*\\.{file extension}$ {... (any similar expression separated by space)}\"\') DO 7za u -tzip %userprofile%\\Desktop\\{.zip file name}.zip -spf2 %%~fA</code></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Replace <code>{directory}</code>, <code>{file name without extension}</code>, <code>{file name}</code>, <code>{file extenstion}</code>, <code>{partial file name}</code>, and <code>{.zip file name}</code> with your desired values, without curly brackets (<code>{}</code>). </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Save the file and run (double click) it.  </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>You will have a <code>{.zip file name}.zip</code> file on your desktop containing all the directories (if not empty) and files you prescribed in the code above.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>Elaborating the code:</h2>\n<!-- /wp:heading -->\n\n<!-- wp:heading {\"level\":3} -->\n<h3>Example in practice: </h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Here\'s a sample code which collects</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:list {\"ordered\":true} -->\n<ol><li>all <code>bin</code> directories recursively (with their contents),</li><li>all files with the names <code style=\"font-size: 16px;\">add to archive</code> (spaces are escaped using <code style=\"font-size: 16px;\">\\</code>) regardless of their extensions,</li><li>all <code>myfile.file</code> files,</li><li>all files/directories which contain <code>name</code> in their names or extensions,</li><li> all <code>.jpg</code> files</li></ol>\n<!-- /wp:list -->\n\n<!-- wp:paragraph -->\n<p>inside our target directory, and puts them into the <code>archive.zip</code> file on our desktop:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"code\"} -->\n<p class=\"code\">FOR /F \"delims=\" %%A IN (\'DIR /S /B ^| findstr \"^.*\\\\bin\\\\.*$ ^.*add\\ to\\ archive\\..*$ ^.*myfile\\.file$ ^.*name.*$ ^.*\\.{jpg}$\"\') DO 7za u -tzip %userprofile%\\Desktop\\arhcive.zip -spf2 %%~fA</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading {\"level\":3} -->\n<h3>Breaking it up:</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>At the heart of the code there is a <code>for</code> command: </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"code\"} -->\n<p class=\"code\">FOR /F \"options\" %%variable IN (set) DO command [command-parameters] </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>with</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:list {\"ordered\":true} -->\n<ol><li>file set (<code>/F</code>) parameter and its <code>\"options\"</code> denoted as <code>/F \"delims=\"</code> </li><li><code>%%variable</code> denoted as <code>%%A</code>,  </li><li><code>(set)</code> denoted as  <code>(\'DIR /S /B ^| findstr \"^.*\\\\bin\\\\.*$ ^.*add\\ to\\ archive\\..*$ ^.*myfile\\.file$ ^.*name.*$ ^.*\\.{jpg}$\"\')</code>,  </li><li><code>command [command-parameters]</code> denoted as <code>7za u -tzip %userprofile%\\Desktop\\arhcive.zip -spf2 %%~fA</code></li></ol>\n<!-- /wp:list -->\n\n<!-- wp:paragraph -->\n<p>As described <a href=\"https://ss64.com/nt/for.html\">here</a>, <code>FOR</code> with <code>/F</code> takes every line of <code>(set)</code> based on rules prescribed in (\"options\"), puts it in <code>%variable</code>, and executes the <code>command [command-parameters]</code>. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>By using the <code>/F</code> parameter, we have instructed <code>FOR</code> that it is going to iterate over contents of a file set.  </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>By setting <code>\"delimiter=\"</code> as the options for <code>/F</code> (leaving the value empty), we have instructed <code>FOR</code> not to treat anything as a delimiter (breaking point) in the string, except for new lines.  </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Now let\'s see what our <code>(set)</code> does: </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"code\"} -->\n<p class=\"code\"><code>(\'dir /s /b ^| findstr \"^.*\\\\bin\\\\.*$ ^.*add\\ to\\ archive\\..*$ ^.*myfile\\.file$ ^.*name.*$ ^.*\\.{jpg}$\"\') </code></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Moving inside, the first bracket (<code>(</code>) is just the opening delimiter of the set scope and the single quote (<code>\'</code>) declares that we want <code>FOR</code> to iterate over lines of a string. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Thus, <code>FOR</code>, in each iteration of its loop is passing a line of the output produced by <code>DIR /S /B ^| findstr \"^.*\\\\bin\\\\.*$ ^.*add\\ to\\ archive\\..*$ ^.*myfile\\.file$ ^.*name.*$ ^.*\\.{jpg}$\"</code> and putting it in <code>%%A</code>. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>As per the <a href=\"https://ss64.com/nt/dir.html\">manual page</a>, <code>DIR /S /B</code> lists the contents of a directory, recurses into its subdirectories, and omits the extra information (i.e. no heading, file sizes, or summary). The additional <code>^</code> means the output produced by <code>DIR</code> consists of more than one line, and that they all together should be piped (<code>|</code>) into the next command, which in our example is <code>findstr</code>. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p><code>findstr</code> searches inside the output of our <code>DIR</code> and returns the lines that match any of the regular expression patterns (separated by spaces) inside double quotes (<code>\"\"</code>). </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>So far, we have a list of our files we want to archive that is iterated over, one line at a time. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Now, to add the files to the <code>archives.zip</code> file on our desktop:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"code\"} -->\n<p class=\"code\"><code>DO 7za u -tzip %userprofile%\\Desktop\\arhcive.zip -spf2 %%~fA </code></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>We want the zip (<code>-tzip</code>) archive (<code>%userprofile%\\Desktop\\arhcive.zip)</code> to be updated (the<code>u</code> command), i.e. keep the files already inside the archive and only replace them if the given file (<code>%%~fA</code>) is newer than the one in the archive. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>We are using <code>%%~fA</code> (full path to file) instead of simply using <code>%%A</code> because we want the archive file to save the full directory structure of the files which are being archived. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>References: </h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>I would like to thank the people who wrote these, as if it wasn\'t for their help, I would not have learnt what is written above. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://stackoverflow.com/questions/8055371/how-do-i-run-two-commands-in-one-line-in-windows-cmd\">https://stackoverflow.com/questions/8055371/how-do-i-run-two-commands-in-one-line-in-windows-cmd</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://stackoverflow.com/questions/19878136/how-can-i-use-a-batch-file-to-write-to-a-text-file/19879594\">https://stackoverflow.com/questions/19878136/how-can-i-use-a-batch-file-to-write-to-a-text-file/19879594</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://stackoverflow.com/questions/2376801/recursive-directory-listing-in-dos\">https://stackoverflow.com/questions/2376801/recursive-directory-listing-in-dos</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://stackoverflow.com/questions/29976780/forfile-command-to-delete-all-except-a-directory\">https://stackoverflow.com/questions/29976780/forfile-command-to-delete-all-except-a-directory</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://superuser.com/questions/653860/list-files-recursively-showing-only-full-path-and-file-size-from-windows-command\">https://superuser.com/questions/653860/list-files-recursively-showing-only-full-path-and-file-size-from-windows-command</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://superuser.com/questions/383641/excluding-files-of-particular-extension-using-dir-command-on-windows-command-lin\">https://superuser.com/questions/383641/excluding-files-of-particular-extension-using-dir-command-on-windows-command-lin</a></p>\n<!-- /wp:paragraph -->', 'Archive certain directories/files using MS Windows command-line interface', 'Collect certain files/directories of a given directory and put them in a single archive file. ', 'publish', 'open', 'open', '', 'archive-certain-directories-files-using-ms-windows-command-line-interface', '', '', '2019-08-15 15:17:47', '2019-08-15 15:17:47', '', 0, 'http://mywebsite.test/?p=5', 0, 'post', '', 0),
(6, 1, '2019-08-15 15:17:47', '2019-08-15 15:17:47', '<!-- wp:paragraph {\"className\":\"purpose\"} -->\n<p class=\"purpose\">We want to collect certain files of a given directory and some of its subdirectories and put them in a single archive file. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"objective\"} -->\n<p class=\"objective\">This article helps you <span class=\"obj-part\">create a \'.bat\' file</span> which archives <span class=\"obj-part\">certain file types (based on extensions or partial names)</span> of <span class=\"obj-part\">desired subdirectories (you pick which directories/paths to include/exclude)</span> inside a parent directory <span class=\"obj-part\">in a \'.zip\' file</span>, using the MS Windows command-line interface.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"prerequisite\"} -->\n<p class=\"prerequisite\">Here, we assume that</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:list {\"ordered\":true,\"className\":\"prerequisite\"} -->\n<ol class=\"prerequisite\"><li>You know how to create a blank text file in Windows and convert it to a DOS batch (\".bat\") file. </li><li>You are familiar with the MS Windows command-line interface (aka \"cmd\")  and its basic functionalities.</li><li>You are familiar with regular expressions. </li><li>You have installed the \"7-zip Extra: standalone console version\".</li></ol>\n<!-- /wp:list -->\n\n<!-- wp:paragraph -->\n<p>In the parent directory where your target files/folders are located (this could be the root of a partition), create a new text file. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Insert the following in the text file:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"code\"} -->\n<p class=\"code\"><code>FOR /F \"delims=\" %%A IN (\'DIR /S /B ^| findstr \"^.*\\\\{directory}\\\\.*$ ^.*{file name without extension}\\..*$ ^.*{{file name}\\.{file extension}}$ ^.*{partial file name}.*$ ^.*\\.{file extension}$ {... (any similar expression separated by space)}\"\') DO 7za u -tzip %userprofile%\\Desktop\\{.zip file name}.zip -spf2 %%~fA</code></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Replace <code>{directory}</code>, <code>{file name without extension}</code>, <code>{file name}</code>, <code>{file extenstion}</code>, <code>{partial file name}</code>, and <code>{.zip file name}</code> with your desired values, without curly brackets (<code>{}</code>). </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Save the file and run (double click) it.  </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>You will have a <code>{.zip file name}.zip</code> file on your desktop containing all the directories (if not empty) and files you prescribed in the code above.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>Elaborating the code:</h2>\n<!-- /wp:heading -->\n\n<!-- wp:heading {\"level\":3} -->\n<h3>Example in practice: </h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Here\'s a sample code which collects</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:list {\"ordered\":true} -->\n<ol><li>all <code>bin</code> directories recursively (with their contents),</li><li>all files with the names <code style=\"font-size: 16px;\">add to archive</code> (spaces are escaped using <code style=\"font-size: 16px;\">\\</code>) regardless of their extensions,</li><li>all <code>myfile.file</code> files,</li><li>all files/directories which contain <code>name</code> in their names or extensions,</li><li> all <code>.jpg</code> files</li></ol>\n<!-- /wp:list -->\n\n<!-- wp:paragraph -->\n<p>inside our target directory, and puts them into the <code>archive.zip</code> file on our desktop:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"code\"} -->\n<p class=\"code\">FOR /F \"delims=\" %%A IN (\'DIR /S /B ^| findstr \"^.*\\\\bin\\\\.*$ ^.*add\\ to\\ archive\\..*$ ^.*myfile\\.file$ ^.*name.*$ ^.*\\.{jpg}$\"\') DO 7za u -tzip %userprofile%\\Desktop\\arhcive.zip -spf2 %%~fA</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading {\"level\":3} -->\n<h3>Breaking it up:</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>At the heart of the code there is a <code>for</code> command: </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"code\"} -->\n<p class=\"code\">FOR /F \"options\" %%variable IN (set) DO command [command-parameters] </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>with</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:list {\"ordered\":true} -->\n<ol><li>file set (<code>/F</code>) parameter and its <code>\"options\"</code> denoted as <code>/F \"delims=\"</code> </li><li><code>%%variable</code> denoted as <code>%%A</code>,  </li><li><code>(set)</code> denoted as  <code>(\'DIR /S /B ^| findstr \"^.*\\\\bin\\\\.*$ ^.*add\\ to\\ archive\\..*$ ^.*myfile\\.file$ ^.*name.*$ ^.*\\.{jpg}$\"\')</code>,  </li><li><code>command [command-parameters]</code> denoted as <code>7za u -tzip %userprofile%\\Desktop\\arhcive.zip -spf2 %%~fA</code></li></ol>\n<!-- /wp:list -->\n\n<!-- wp:paragraph -->\n<p>As described <a href=\"https://ss64.com/nt/for.html\">here</a>, <code>FOR</code> with <code>/F</code> takes every line of <code>(set)</code> based on rules prescribed in (\"options\"), puts it in <code>%variable</code>, and executes the <code>command [command-parameters]</code>. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>By using the <code>/F</code> parameter, we have instructed <code>FOR</code> that it is going to iterate over contents of a file set.  </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>By setting <code>\"delimiter=\"</code> as the options for <code>/F</code> (leaving the value empty), we have instructed <code>FOR</code> not to treat anything as a delimiter (breaking point) in the string, except for new lines.  </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Now let\'s see what our <code>(set)</code> does: </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"code\"} -->\n<p class=\"code\"><code>(\'dir /s /b ^| findstr \"^.*\\\\bin\\\\.*$ ^.*add\\ to\\ archive\\..*$ ^.*myfile\\.file$ ^.*name.*$ ^.*\\.{jpg}$\"\') </code></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Moving inside, the first bracket (<code>(</code>) is just the opening delimiter of the set scope and the single quote (<code>\'</code>) declares that we want <code>FOR</code> to iterate over lines of a string. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Thus, <code>FOR</code>, in each iteration of its loop is passing a line of the output produced by <code>DIR /S /B ^| findstr \"^.*\\\\bin\\\\.*$ ^.*add\\ to\\ archive\\..*$ ^.*myfile\\.file$ ^.*name.*$ ^.*\\.{jpg}$\"</code> and putting it in <code>%%A</code>. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>As per the <a href=\"https://ss64.com/nt/dir.html\">manual page</a>, <code>DIR /S /B</code> lists the contents of a directory, recurses into its subdirectories, and omits the extra information (i.e. no heading, file sizes, or summary). The additional <code>^</code> means the output produced by <code>DIR</code> consists of more than one line, and that they all together should be piped (<code>|</code>) into the next command, which in our example is <code>findstr</code>. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p><code>findstr</code> searches inside the output of our <code>DIR</code> and returns the lines that match any of the regular expression patterns (separated by spaces) inside double quotes (<code>\"\"</code>). </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>So far, we have a list of our files we want to archive that is iterated over, one line at a time. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Now, to add the files to the <code>archives.zip</code> file on our desktop:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"code\"} -->\n<p class=\"code\"><code>DO 7za u -tzip %userprofile%\\Desktop\\arhcive.zip -spf2 %%~fA </code></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>We want the zip (<code>-tzip</code>) archive (<code>%userprofile%\\Desktop\\arhcive.zip)</code> to be updated (the<code>u</code> command), i.e. keep the files already inside the archive and only replace them if the given file (<code>%%~fA</code>) is newer than the one in the archive. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>We are using <code>%%~fA</code> (full path to file) instead of simply using <code>%%A</code> because we want the archive file to save the full directory structure of the files which are being archived. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>References: </h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>I would like to thank the people who wrote these, as if it wasn\'t for their help, I would not have learnt what is written above. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://stackoverflow.com/questions/8055371/how-do-i-run-two-commands-in-one-line-in-windows-cmd\">https://stackoverflow.com/questions/8055371/how-do-i-run-two-commands-in-one-line-in-windows-cmd</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://stackoverflow.com/questions/19878136/how-can-i-use-a-batch-file-to-write-to-a-text-file/19879594\">https://stackoverflow.com/questions/19878136/how-can-i-use-a-batch-file-to-write-to-a-text-file/19879594</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://stackoverflow.com/questions/2376801/recursive-directory-listing-in-dos\">https://stackoverflow.com/questions/2376801/recursive-directory-listing-in-dos</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://stackoverflow.com/questions/29976780/forfile-command-to-delete-all-except-a-directory\">https://stackoverflow.com/questions/29976780/forfile-command-to-delete-all-except-a-directory</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://superuser.com/questions/653860/list-files-recursively-showing-only-full-path-and-file-size-from-windows-command\">https://superuser.com/questions/653860/list-files-recursively-showing-only-full-path-and-file-size-from-windows-command</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"className\":\"reference\"} -->\n<p class=\"reference\"><a href=\"https://superuser.com/questions/383641/excluding-files-of-particular-extension-using-dir-command-on-windows-command-lin\">https://superuser.com/questions/383641/excluding-files-of-particular-extension-using-dir-command-on-windows-command-lin</a></p>\n<!-- /wp:paragraph -->', 'Archive certain directories/files using MS Windows command-line interface', 'Collect certain files/directories of a given directory and put them in a single archive file. ', 'inherit', 'closed', 'closed', '', '5-revision-v1', '', '', '2019-08-15 15:17:47', '2019-08-15 15:17:47', '', 5, 'http://mywebsite.test/2019/08/15/5-revision-v1/', 0, 'revision', '', 0),
(7, 1, '2019-08-16 11:59:50', '2019-08-16 11:59:50', '<!-- wp:paragraph -->\n<p>I am a teacher of English as a second language, a website developer, and a news translator from Iran. Currently, I live in the capital, Tehran. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>I have always been very interested in computers and digital equipment. My first experiences of working with a computer go back to high school years when I learnt basic programming lessons. Luckily, I was accepted for a bachelor in computer science and from which I graduated in 2014. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>By the middle of my bachelor studies, I was too indulged in human science to ignore it! That, along with my skills in English, which had significantly improved due to years of experience teaching the language, set the stage for another 2 years of academic studies; this time a master\'s degree in business administration, which for its part also paid for my interest in human science. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>I was married by then, and therefore, Tehran with a vast business potential seemed a very promising city to settle down. I moved to Tehran in 2016 and that\'s where I still live. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>I have never been away from computers for long. I started my professional experience in developing websites in 2016 and it has been so much fun, that I can hardly feel like that I am really working. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Since when I started programming, open-source technologies and free question and answer platforms have been very helpful. I have always felt the burden of having to teach at least parts of what I have learnt for free to others too. That is the fundamental reason behind this website. To share, at least parts of what I have learnt on the web, especially with fellow Iranians and those native Farsi speaking web and computer enthusiasts, who find the English-dominated media too hard to understand communicate with. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>As an English teacher, I also try to use the website as a medium to communicate with my students and of course, other interested learners who are looking for alternative sources to acquire more knowledge about everyday applications of the language. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>I am also using this website to expose my mind to a greater spectrum of thoughts and criticism to make my mostly naive thoughts develop to more sensible and comprehensive ideas. </p>\n<!-- /wp:paragraph -->', 'About Me', '', 'publish', 'closed', 'closed', '', 'about-me', '', '', '2019-08-16 11:59:50', '2019-08-16 11:59:50', '', 0, 'http://mywebsite.test/?page_id=7', 0, 'page', '', 0),
(8, 1, '2019-08-16 11:59:50', '2019-08-16 11:59:50', '<!-- wp:paragraph -->\n<p>I am a teacher of English as a second language, a website developer, and a news translator from Iran. Currently, I live in the capital, Tehran. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>I have always been very interested in computers and digital equipment. My first experiences of working with a computer go back to high school years when I learnt basic programming lessons. Luckily, I was accepted for a bachelor in computer science and from which I graduated in 2014. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>By the middle of my bachelor studies, I was too indulged in human science to ignore it! That, along with my skills in English, which had significantly improved due to years of experience teaching the language, set the stage for another 2 years of academic studies; this time a master\'s degree in business administration, which for its part also paid for my interest in human science. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>I was married by then, and therefore, Tehran with a vast business potential seemed a very promising city to settle down. I moved to Tehran in 2016 and that\'s where I still live. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>I have never been away from computers for long. I started my professional experience in developing websites in 2016 and it has been so much fun, that I can hardly feel like that I am really working. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Since when I started programming, open-source technologies and free question and answer platforms have been very helpful. I have always felt the burden of having to teach at least parts of what I have learnt for free to others too. That is the fundamental reason behind this website. To share, at least parts of what I have learnt on the web, especially with fellow Iranians and those native Farsi speaking web and computer enthusiasts, who find the English-dominated media too hard to understand communicate with. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>As an English teacher, I also try to use the website as a medium to communicate with my students and of course, other interested learners who are looking for alternative sources to acquire more knowledge about everyday applications of the language. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>I am also using this website to expose my mind to a greater spectrum of thoughts and criticism to make my mostly naive thoughts develop to more sensible and comprehensive ideas. </p>\n<!-- /wp:paragraph -->', 'About Me', '', 'inherit', 'closed', 'closed', '', '7-revision-v1', '', '', '2019-08-16 11:59:50', '2019-08-16 11:59:50', '', 7, 'http://mywebsite.test/2019/08/16/7-revision-v1/', 0, 'revision', '', 0);

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
(1, 'Miscellaneous', 'miscellaneous', 0),
(2, 'Makes', 'makes', 0),
(3, 'Ideas', 'ideas', 0),
(4, 'Guides', 'guides', 0),
(5, 'Day-to-day Computer', 'day-to-day-computer', 0),
(8, 'CMD', 'cmd', 0),
(9, 'MS_Windows', 'ms_windows', 0),
(10, 'Shares', 'shares', 0),
(11, 'Translations', 'translations', 0),
(12, 'Series', 'series', 0),
(13, 'Learning English', 'learning-english', 0),
(14, 'Learning English for native Iranians', 'learning-english-for-native-iranians', 0);

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
(5, 4, 0),
(5, 5, 0),
(5, 8, 0),
(5, 9, 0);

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
(1, 1, 'category', 'What I don\'t know where to put', 0, 1),
(2, 2, 'category', 'What I create', 0, 0),
(3, 3, 'category', 'What I think', 0, 0),
(4, 4, 'category', 'What I know', 0, 1),
(5, 5, 'category', 'Guides you might find helpful working on a computer', 4, 1),
(8, 8, 'post_tag', '', 0, 1),
(9, 9, 'post_tag', '', 0, 1),
(10, 10, 'category', 'What I share', 0, 0),
(11, 11, 'category', 'My Persian to English translations', 2, 0),
(12, 12, 'category', 'Stories that come in more than one post', 0, 0),
(13, 13, 'category', 'Guides for those who are learning English as a second language', 4, 0),
(14, 14, 'category', 'Guides for native Iranians who are learning English', 13, 0);

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
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'false'),
(11, 1, 'locale', ''),
(12, 1, 'pw_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'pw_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', ''),
(15, 1, 'show_welcome_panel', '1'),
(16, 1, 'session_tokens', 'a:1:{s:64:\"e711c4defc17a0160c2c0c7d7dbaae2d7d19aa68929412efc132f2bda51e9d40\";a:4:{s:10:\"expiration\";i:1567007182;s:2:\"ip\";s:9:\"127.0.0.1\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\";s:5:\"login\";i:1565797582;}}'),
(17, 1, 'pw_user-settings', 'libraryContent=browse'),
(18, 1, 'pw_user-settings-time', '1565797581'),
(19, 1, 'pw_dashboard_quick_press_last_post_id', '4'),
(20, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:9:\"127.0.0.0\";}');

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
(1, 'admin', '$P$BTafzG/1z/ztLZxzBjzy1hhk/Gbqe00', 'admin', 'test@mywebsite.test', '', '2019-08-14 15:46:04', '', 0, 'admin');

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
  ADD UNIQUE KEY `option_name` (`option_name`);

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
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `pw_postmeta`
--
ALTER TABLE `pw_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pw_posts`
--
ALTER TABLE `pw_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pw_termmeta`
--
ALTER TABLE `pw_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pw_terms`
--
ALTER TABLE `pw_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pw_term_taxonomy`
--
ALTER TABLE `pw_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pw_usermeta`
--
ALTER TABLE `pw_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pw_users`
--
ALTER TABLE `pw_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
