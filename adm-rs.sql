-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2018 at 04:42 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adm-rs`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(1) NOT NULL,
  `app_name` varchar(100) NOT NULL,
  `app_company` varchar(100) NOT NULL,
  `app_logo` varchar(100) DEFAULT NULL,
  `app_logo_lg` varchar(20) NOT NULL,
  `app_logo_mini` varchar(5) NOT NULL,
  `app_theme` varchar(50) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`id`, `app_name`, `app_company`, `app_logo`, `app_logo_lg`, `app_logo_mini`, `app_theme`, `updated_at`) VALUES
(1, 'Apps Name', 'Company', NULL, 'AdminLTE', 'LTE', 'skin-black', '2018-01-03 14:26:29');

-- --------------------------------------------------------

--
-- Table structure for table `foto_rumah_sakit`
--

CREATE TABLE `foto_rumah_sakit` (
  `id` int(3) NOT NULL,
  `rumah_sakit_id` int(3) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_rumah_sakit`
--

CREATE TABLE `jadwal_rumah_sakit` (
  `id` int(3) NOT NULL,
  `rumah_sakit_id` int(3) NOT NULL,
  `hari` varchar(15) NOT NULL,
  `jam_mulai` varchar(25) DEFAULT NULL,
  `jam_selesai` varchar(25) DEFAULT NULL,
  `operational` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_rumah_sakit`
--

CREATE TABLE `jenis_rumah_sakit` (
  `id` int(3) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_rumah_sakit`
--

INSERT INTO `jenis_rumah_sakit` (`id`, `description`, `created_at`, `update_at`) VALUES
(1, 'Rumah Sakit Ibu dan Anak', '2018-05-19 14:08:38', '2018-05-19 14:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `log` varchar(128) NOT NULL,
  `activity` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log`, `activity`, `user_id`, `created_by`, `created_at`) VALUES
(1, '/users/add', '', 1, 'admin', '2018-01-22 03:51:11'),
(2, '/users/update', '', 1, 'admin', '2018-01-22 03:56:29'),
(3, '/users/update', '', 1, 'admin', '2018-01-22 03:57:33'),
(4, '/users/update', '', 1, 'admin', '2018-01-22 03:58:15'),
(5, '/users/update', '', 1, 'admin', '2018-01-22 03:59:06'),
(9, '/users/update', '', 1, 'admin', '2018-01-22 04:01:02'),
(10, '/users/update', '', 1, 'admin', '2018-01-22 04:12:06'),
(11, '/users/update/3', '', 1, 'admin', '2018-01-22 04:18:05'),
(12, '/users/delete/3', '', 1, 'admin', '2018-01-22 04:19:08'),
(13, '/users/add', '{\"username\":\"username\",\"password\":\"$2y$11$2Xhy0ci\\/Ctxs6pfFmqCMbuHVNa107sYGXofwcy419Ix8D62cfpslm\",\"role_id\":2,\"created_at\":\"2018-01-22 07:15:42\",\"user_id\":21,\"fullname\":\"fullmane\",\"address\":\"address\",\"phone\":\"09877\",\"gender\":\"2\"}', 1, 'admin', '2018-01-22 07:15:42'),
(14, '/users/update/21', '{\"password\":\"$2y$11$HSXEVFb6zqFd6TwWpd.aY.VdNLRv0xaVdFdw7w0a.VLIEenohufZu\",\"fullname\":\"update\",\"address\":\"update\",\"phone\":\"09877\",\"gender\":\"2\",\"created_at\":\"2018-01-22 07:21:06\"}', 1, 'admin', '2018-01-22 07:21:06'),
(15, '/users/delete/21', '{\"id\":\"21\",\"user_id\":\"21\",\"fullname\":\"update\",\"address\":\"update\",\"phone\":\"09877\",\"gender\":\"2\",\"created_at\":\"2018-01-22 07:15:42\",\"updated_at\":\"2018-01-22 13:21:06\",\"role_id\":\"2\",\"username\":\"username\",\"password\":\"$2y$11$HSXEVFb6zqFd6TwWpd.aY.VdNLRv0xaVdFdw7w0a.VLIEenohufZu\",\"last_login\":\"0000-00-00 00:00:00\"}', 1, 'admin', '2018-01-22 07:30:15'),
(16, '/group_user/add', '[{\"role_id\":3,\"menu_id\":\"23\",\"priv_create\":0,\"priv_read\":0,\"priv_update\":0,\"priv_delete\":0,\"created_at\":\"2018-01-22 07:39:30\"},{\"role_id\":3,\"menu_id\":\"22\",\"priv_create\":0,\"priv_read\":0,\"priv_update\":0,\"priv_delete\":0,\"created_at\":\"2018-01-22 07:39:30\"},{\"role_id\":3,\"menu_id\":\"21\",\"priv_create\":0,\"priv_read\":0,\"priv_update\":0,\"priv_delete\":0,\"created_at\":\"2018-01-22 07:39:30\"},{\"role_id\":3,\"menu_id\":\"20\",\"priv_create\":0,\"priv_read\":0,\"priv_update\":0,\"priv_delete\":0,\"created_at\":\"2018-01-22 07:39:30\"},{\"role_id\":3,\"menu_id\":\"9\",\"priv_create\":0,\"priv_read\":0,\"priv_update\":0,\"priv_delete\":0,\"created_at\":\"2018-01-22 07:39:30\"},{\"role_id\":3,\"menu_id\":\"8\",\"priv_create\":0,\"priv_read\":0,\"priv_update\":0,\"priv_delete\":0,\"created_at\":\"2018-01-22 07:39:30\"}]', 1, 'admin', '2018-01-22 07:39:30'),
(17, '/group_user/delete/3', '{\"id\":\"3\",\"role\":\"oemar bakri\",\"created_at\":\"2018-01-22 07:39:30\",\"updated_at\":null}', 1, 'admin', '2018-01-22 07:41:05'),
(18, '/privileges_user/update_priv/34', '{\"priv_update\":\"0\"}', 1, 'admin', '2018-01-22 08:09:56'),
(19, '/privileges_user/update_priv/34', '{\"priv_update\":\"1\"}', 1, 'admin', '2018-01-22 08:10:11'),
(20, '/list_menus/add', '{\"menu\":\"tambah\",\"parent\":\"0\",\"link\":\"link\",\"is_published\":1,\"menu_order\":\"8000\",\"created_at\":\"2018-01-22 10:43:56\",\"level\":0,\"icon\":\"fa-bars\",\"0\":{\"role_id\":\"2\",\"menu_id\":24,\"priv_create\":0,\"priv_read\":0,\"priv_update\":0,\"priv_delete\":0,\"created_at\":\"2018-01-22 10:43:56\"},\"1\":{\"role_id\":\"1\",\"menu_id\":24,\"priv_create\":1,\"priv_read\":1,\"priv_update\":1,\"priv_delete\":1,\"created_at\":\"2018-01-22 10:43:56\"}}', 1, 'admin', '2018-01-22 10:43:56'),
(24, '/list_menus/add', '{\"menu\":\"gabut\",\"parent\":\"0\",\"link\":\"gabut\",\"is_published\":1,\"menu_order\":\"1111111\",\"created_at\":\"2018-01-22 10:54:56\",\"level\":0,\"icon\":\"fa-bitbucket-square\",\"0\":{\"role_id\":\"2\",\"menu_id\":25,\"priv_create\":0,\"priv_read\":0,\"priv_update\":0,\"priv_delete\":0,\"created_at\":\"2018-01-22 10:54:56\"},\"1\":{\"role_id\":\"1\",\"menu_id\":25,\"priv_create\":1,\"priv_read\":1,\"priv_update\":1,\"priv_delete\":1,\"created_at\":\"2018-01-22 10:54:56\"}}', 1, 'admin', '2018-01-22 10:54:56'),
(25, '/list_menus/delete/25', '{\"id\":\"54\",\"level\":\"0\",\"parent\":\"0\",\"menu\":\"gabut\",\"link\":\"gabut\",\"is_published\":\"1\",\"menu_order\":\"1111111\",\"icon\":\"fa-bitbucket-square\",\"created_at\":\"2018-01-22 10:54:56\",\"updated_at\":null,\"role_id\":\"1\",\"menu_id\":\"25\",\"priv_create\":\"1\",\"priv_read\":\"1\",\"priv_update\":\"1\",\"priv_delete\":\"1\"}', 1, 'admin', '2018-01-22 10:55:16'),
(26, '/users/update/2', '{\"username\":\"djuned92\",\"password\":\"$2y$11$Iyo4rJ6MpGhl93z7wNf5zOZAx8QDmugqz2Eoc6\\/HK0YEp0CTCIrRy\",\"fullname\":\"User\",\"address\":\"user\",\"phone\":\"988833\",\"gender\":\"1\",\"created_at\":\"2018-01-23 02:25:43\"}', 1, 'admin', '2018-01-23 02:25:43'),
(27, '/users/update/2', '{\"username\":\"djuned92\",\"password\":\"$2y$11$zTMEv9\\/HI0gK5SpU3CMjbuMiyWrJIyV1CdGOTdZyVUom1VaMQKJO6\",\"fullname\":\"Ahmad Djunaedi\",\"address\":\"Bekasi, Jati Asih\",\"phone\":\"988833\",\"gender\":\"1\",\"created_at\":\"2018-01-23 02:26:10\"}', 1, 'admin', '2018-01-23 02:26:10'),
(28, '/users/update/1', '{\"username\":\"admin\",\"password\":\"$2y$11$qrn0A.uXSnfGGGul\\/JSLGOxmtrYhbJf7rlkKTkYyM0h.TRewUKt.2\",\"fullname\":\"Admin\",\"address\":\"Indonesia\",\"phone\":\"218489878\",\"gender\":\"2\",\"created_at\":\"2018-01-23 02:29:56\"}', 1, 'admin', '2018-01-23 02:29:56'),
(29, '/privileges_user/update_priv/9', '{\"priv_read\":\"1\"}', 1, 'admin', '2018-01-31 07:50:19'),
(30, '/privileges_user/update_priv/36', '{\"priv_update\":\"0\"}', 1, 'admin', '2018-01-31 08:02:22'),
(31, '/privileges_user/update_priv/36', '{\"priv_update\":\"1\"}', 1, 'admin', '2018-01-31 08:02:36'),
(32, '/privileges_user/update_priv/36', '{\"priv_update\":\"0\"}', 1, 'admin', '2018-01-31 08:02:38'),
(33, '/privileges_user/update_priv/36', '{\"priv_delete\":\"0\"}', 1, 'admin', '2018-01-31 08:02:39'),
(34, '/privileges_user/update_priv/36', '{\"priv_create\":\"0\"}', 1, 'admin', '2018-01-31 08:02:50'),
(35, '/privileges_user/update_priv/34', '{\"priv_update\":\"1\"}', 1, 'admin', '2018-01-31 08:03:16'),
(36, '/privileges_user/update_priv/34', '{\"priv_delete\":\"1\"}', 1, 'admin', '2018-01-31 08:03:18'),
(37, '/privileges_user/update_priv/34', '{\"priv_create\":\"1\"}', 1, 'admin', '2018-01-31 08:03:19'),
(38, '/privileges_user/update_priv/36', '{\"priv_update\":\"1\"}', 1, 'admin', '2018-01-31 08:03:24'),
(39, '/privileges_user/update_priv/36', '{\"priv_delete\":\"1\"}', 1, 'admin', '2018-01-31 08:03:25'),
(40, '/privileges_user/update_priv/36', '{\"priv_create\":\"1\"}', 1, 'admin', '2018-01-31 08:03:27'),
(41, '/privileges_user/update_priv/35', '{\"priv_read\":\"1\"}', 1, 'admin', '2018-04-07 07:18:12'),
(42, '/privileges_user/update_priv/9', '{\"priv_read\":\"0\"}', 1, 'admin', '2018-04-07 07:18:16'),
(43, '/list_menus/update/21', '{\"menu\":\"Data Users\",\"parent\":\"0\",\"link\":\"users\",\"is_published\":1,\"menu_order\":\"100\",\"level\":0,\"icon\":\"fa-users\"}', 1, 'admin', '2018-05-19 06:00:27'),
(44, '/list_menus/add', '{\"menu\":\"Master\",\"parent\":\"0\",\"link\":\"\",\"is_published\":1,\"menu_order\":\"200\",\"created_at\":\"2018-05-19 06:01:41\",\"level\":0,\"icon\":\"fa-plus-square-o\",\"0\":{\"role_id\":\"2\",\"menu_id\":24,\"priv_create\":0,\"priv_read\":0,\"priv_update\":0,\"priv_delete\":0,\"created_at\":\"2018-05-19 06:01:41\"},\"1\":{\"role_id\":\"1\",\"menu_id\":24,\"priv_create\":1,\"priv_read\":1,\"priv_update\":1,\"priv_delete\":1,\"created_at\":\"2018-05-19 06:01:41\"}}', 1, 'admin', '2018-05-19 06:01:41'),
(45, '/list_menus/add', '{\"menu\":\"Rumah Sakit\",\"parent\":\"24\",\"link\":\"rumah_sakit\",\"is_published\":1,\"menu_order\":\"210\",\"created_at\":\"2018-05-19 06:02:19\",\"level\":1,\"icon\":null,\"0\":{\"role_id\":\"2\",\"menu_id\":25,\"priv_create\":0,\"priv_read\":0,\"priv_update\":0,\"priv_delete\":0,\"created_at\":\"2018-05-19 06:02:19\"},\"1\":{\"role_id\":\"1\",\"menu_id\":25,\"priv_create\":1,\"priv_read\":1,\"priv_update\":1,\"priv_delete\":1,\"created_at\":\"2018-05-19 06:02:19\"}}', 1, 'admin', '2018-05-19 06:02:19'),
(46, '/list_menus/add', '{\"menu\":\"Jenis Rumah Sakit\",\"parent\":\"24\",\"link\":\"jenis_rumah_sakit\",\"is_published\":1,\"menu_order\":\"202\",\"created_at\":\"2018-05-19 06:05:16\",\"level\":1,\"icon\":null,\"0\":{\"role_id\":\"2\",\"menu_id\":26,\"priv_create\":0,\"priv_read\":0,\"priv_update\":0,\"priv_delete\":0,\"created_at\":\"2018-05-19 06:05:16\"},\"1\":{\"role_id\":\"1\",\"menu_id\":26,\"priv_create\":1,\"priv_read\":1,\"priv_update\":1,\"priv_delete\":1,\"created_at\":\"2018-05-19 06:05:16\"}}', 1, 'admin', '2018-05-19 06:05:16'),
(47, '/list_menus/update/26', '{\"menu\":\"Jenis Rumah Sakit\",\"parent\":\"24\",\"link\":\"jenis_rumah_sakit\",\"is_published\":1,\"menu_order\":\"220\",\"level\":1,\"icon\":null}', 1, 'admin', '2018-05-19 06:05:37'),
(48, '/list_menus/update/24', '{\"menu\":\"Master\",\"parent\":\"0\",\"link\":\"\",\"is_published\":1,\"menu_order\":\"200\",\"level\":0,\"icon\":\"fa-dot-circle-o\"}', 1, 'admin', '2018-05-19 07:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `level` int(4) NOT NULL DEFAULT '0',
  `parent` int(4) NOT NULL DEFAULT '0',
  `menu` varchar(64) NOT NULL,
  `link` varchar(64) NOT NULL,
  `is_published` int(1) NOT NULL DEFAULT '0',
  `menu_order` int(4) NOT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `level`, `parent`, `menu`, `link`, `is_published`, `menu_order`, `icon`, `created_at`, `updated_at`) VALUES
(8, 0, 0, 'Settings', '', 1, 1300, 'fa-gear', '2017-12-21 05:46:14', '2018-01-15 14:55:03'),
(9, 1, 8, 'Menu', 'list_menus', 1, 1320, NULL, '2017-12-21 05:47:19', '2018-01-15 14:55:06'),
(20, 1, 8, 'User', '', 1, 1310, NULL, '2017-12-23 07:23:25', '2018-01-15 14:55:10'),
(21, 0, 0, 'Data Users', 'users', 1, 100, 'fa-users', '2017-12-23 07:24:31', '2018-05-19 11:00:27'),
(22, 2, 20, 'Group User', 'group_user', 1, 1312, NULL, '2017-12-23 07:25:25', '2018-01-15 14:55:17'),
(23, 2, 20, 'Privileges User', 'privileges_user', 1, 1313, NULL, '2017-12-23 11:03:14', '2018-01-15 14:55:20'),
(24, 0, 0, 'Master', '', 1, 200, 'fa-dot-circle-o', '2018-05-19 06:01:41', '2018-05-19 12:32:17'),
(25, 1, 24, 'Rumah Sakit', 'rumah_sakit', 1, 210, NULL, '2018-05-19 06:02:19', NULL),
(26, 1, 24, 'Jenis Rumah Sakit', 'jenis_rumah_sakit', 1, 220, NULL, '2018-05-19 06:05:16', '2018-05-19 11:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` int(1) NOT NULL COMMENT '1.male 2.female',
  `photo` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `fullname`, `address`, `phone`, `email`, `gender`, `photo`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'Indonesia', '218489878', '', 2, NULL, '2018-01-23 02:29:56', '2018-05-19 16:32:08'),
(2, 2, 'Ahmad Djunaedi', 'Bekasi, Jati Asih', '988833', '', 1, 'isyana.jpg', '2018-01-23 02:26:10', '2018-05-19 16:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(2) NOT NULL,
  `role` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2017-12-16 00:00:00', '2017-12-23 14:24:15'),
(2, 'user', '2017-12-22 00:00:00', '2017-12-23 14:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `rumah_sakit`
--

CREATE TABLE `rumah_sakit` (
  `id` int(3) NOT NULL,
  `jenis_rumah_sakit_id` int(3) NOT NULL,
  `nama_rumah_sakit` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `lat` varchar(25) NOT NULL,
  `lng` varchar(25) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `no_fax` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rumah_sakit`
--

INSERT INTO `rumah_sakit` (`id`, `jenis_rumah_sakit_id`, `nama_rumah_sakit`, `alamat`, `lat`, `lng`, `no_telp`, `no_fax`, `email`, `created_at`, `update_at`) VALUES
(1, 1, 'Rumah Sakit Pondok Indah', 'Pondok Indah, Jakarta Selatan DKI JAKARTA', '', '', NULL, NULL, NULL, '2018-05-21 00:00:00', '2018-05-26 13:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(60) NOT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `device_token`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '$2y$11$XBYAcNFBwa1e1dvc1zrUdOfBvvA1LQoWWVZNDW2kKyF7kqWU.iezG', NULL, '2018-06-03 11:22:04', '2017-12-11 04:57:04', '2018-06-03 16:22:04'),
(2, 2, 'djuned92', '$2y$11$XBYAcNFBwa1e1dvc1zrUdOfBvvA1LQoWWVZNDW2kKyF7kqWU.iezG', NULL, '2018-04-07 07:18:40', '2017-12-24 11:55:52', '2018-04-07 12:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_privileges`
--

CREATE TABLE `user_privileges` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `priv_create` int(1) NOT NULL DEFAULT '0',
  `priv_read` int(1) NOT NULL DEFAULT '0',
  `priv_update` int(1) NOT NULL DEFAULT '0',
  `priv_delete` int(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_privileges`
--

INSERT INTO `user_privileges` (`id`, `role_id`, `menu_id`, `priv_create`, `priv_read`, `priv_update`, `priv_delete`, `created_at`, `updated_at`) VALUES
(7, 2, 8, 0, 1, 0, 0, '2017-12-21 05:46:14', '2017-12-24 17:53:51'),
(8, 1, 8, 1, 1, 1, 1, '2017-12-21 05:46:14', NULL),
(9, 2, 9, 0, 0, 0, 0, '2017-12-21 05:47:19', '2018-04-07 12:18:16'),
(10, 1, 9, 1, 1, 1, 1, '2017-12-21 05:47:19', '2017-12-27 10:19:23'),
(31, 2, 20, 0, 1, 0, 0, '2017-12-23 07:23:25', '2017-12-24 17:53:55'),
(32, 1, 20, 1, 1, 1, 1, '2017-12-23 07:23:25', '2017-12-24 22:45:33'),
(33, 2, 21, 1, 1, 0, 0, '2017-12-23 07:24:31', '2017-12-29 11:16:59'),
(34, 1, 21, 1, 1, 1, 1, '2017-12-23 07:24:31', '2018-01-22 14:10:11'),
(35, 2, 22, 0, 1, 0, 0, '2017-12-23 07:25:25', '2018-04-07 12:18:12'),
(36, 1, 22, 1, 1, 1, 1, '2017-12-23 07:25:25', '2018-01-31 14:03:26'),
(43, 2, 23, 0, 0, 0, 0, '2017-12-23 11:03:14', NULL),
(44, 1, 23, 1, 1, 1, 1, '2017-12-23 11:03:14', '2017-12-24 17:07:21'),
(45, 2, 24, 0, 0, 0, 0, '2018-05-19 06:01:41', NULL),
(46, 1, 24, 1, 1, 1, 1, '2018-05-19 06:01:41', NULL),
(47, 2, 25, 0, 0, 0, 0, '2018-05-19 06:02:19', NULL),
(48, 1, 25, 1, 1, 1, 1, '2018-05-19 06:02:19', NULL),
(49, 2, 26, 0, 0, 0, 0, '2018-05-19 06:05:16', NULL),
(50, 1, 26, 1, 1, 1, 1, '2018-05-19 06:05:16', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto_rumah_sakit`
--
ALTER TABLE `foto_rumah_sakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_rumah_sakit`
--
ALTER TABLE `jenis_rumah_sakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rumah_sakit`
--
ALTER TABLE `rumah_sakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_previllages_ibfk_1_idx` (`role_id`),
  ADD KEY `user_previllages_ibfk_2_idx` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto_rumah_sakit`
--
ALTER TABLE `foto_rumah_sakit`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jenis_rumah_sakit`
--
ALTER TABLE `jenis_rumah_sakit`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rumah_sakit`
--
ALTER TABLE `rumah_sakit`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_privileges`
--
ALTER TABLE `user_privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
