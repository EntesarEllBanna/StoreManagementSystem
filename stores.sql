-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2017 at 04:03 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stores`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `email`, `user_id`, `mobile`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'مدير النظام', 'info@admin.com', 1, '0599624984', 1, '2017-04-27 00:00:00', 1, '0000-00-00 00:00:00', 0),
(2, 'Vision Plus', 'basel1090@gmail.com', 2, '599624984', 1, '2017-05-07 13:15:01', 1, '2017-05-07 13:15:01', NULL),
(4, 'محمود خليل أبو جياب', 'mhd@jayyab.com', 6, '0599624984', 1, '2017-05-07 13:52:11', 1, '2017-05-07 13:58:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_link`
--

CREATE TABLE `admin_link` (
  `admin_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_link`
--

INSERT INTO `admin_link` (`admin_id`, `link_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `unit_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `unit_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'عطور', 3, '2017-04-27 15:49:34', 1, '2017-04-27 15:49:34', NULL),
(2, 'شاشات', 1, '2017-04-27 15:50:48', 1, '2017-04-27 15:51:09', 1),
(3, 'قماش', 4, '2017-04-27 15:51:03', 1, '2017-04-27 15:51:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `category_id`, `active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '1 Million', 1, 1, 1, '2017-04-30 12:19:19', NULL, '2017-04-30 12:19:19'),
(2, 'شاشة LG', 2, 1, 1, '2017-04-30 12:19:32', 1, '2017-05-04 13:07:27'),
(3, 'كمفنس', 3, 1, 1, '2017-04-30 12:19:52', NULL, '2017-04-30 12:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `showinmenu` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `title`, `url`, `icon`, `parent_id`, `order_id`, `showinmenu`) VALUES
(1, 'الثوابت', '#', 'icon-home', 0, 1, 1),
(2, 'الوحدات', '/unit', 'icon-bar-chart', 1, 1, 1),
(3, 'تصنيفات الاصناف', '/category', 'icon-bulb', 1, 1, 1),
(4, 'الاصناف', '/item', 'icon-graph', 1, 1, 1),
(5, 'المخازن', '/store', 'fa fa-diamond', 1, 1, 1),
(6, 'الحركات', '#', 'fa fa-eraser', 0, 1, 1),
(7, 'صادر', '/transaction/outcome', 'fa fa-arrow-left', 6, 1, 1),
(8, 'وارد', '/transaction/income', 'fa fa-arrow-right', 6, 1, 1),
(9, 'نقل', '/transaction/move', 'fa fa-exchange', 6, 1, 1),
(10, 'اتلاف', '/transaction/destroy', 'fa fa-trash', 6, 1, 1),
(11, 'جرد', '/transaction/inventory', 'fa fa-caret-square-o-down', 6, 1, 1),
(12, 'ارشيف الحركات', '/transaction/archive', 'fa fa-list', 6, 1, 1),
(13, 'الارصدة', '#', 'fa fa-calendar-plus-o', 0, 1, 1),
(14, 'رصيد المخازن والاصناف', '/balance/store', 'fa fa-list', 13, 1, 1),
(15, 'المستخدمين', '#', 'fa fa-users', 0, 1, 1),
(16, 'اضافة مستخدم جديد', '/admin/create', 'fa fa-plus', 15, 1, 1),
(17, 'عرض جميع المستخدمين', '/admin', 'fa fa-list', 15, 1, 1),
(18, 'صلاحيات المستخدم', '/admin/permission', '', 15, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `name`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'المخزن الرئيسي', 1, '2017-04-30 12:14:31', 1, '2017-04-30 12:15:10', 1),
(3, 'المخزن الجنوبي', 1, '2017-04-30 12:18:50', 1, '2017-04-30 12:18:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_item_balance`
--

CREATE TABLE `store_item_balance` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `balance` double NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `store_item_balance`
--

INSERT INTO `store_item_balance` (`id`, `store_id`, `item_id`, `unit_id`, `balance`, `updated_at`, `created_at`) VALUES
(3, 1, 1, 3, 1, '2017-05-04 15:54:20', '2017-05-02 16:00:03'),
(4, 1, 2, 1, 3, '2017-05-04 15:54:20', '2017-05-02 16:00:03'),
(5, 3, 3, 4, 29, '2017-05-04 15:56:09', '2017-05-02 16:01:59'),
(6, 3, 2, 1, 63, '2017-05-04 15:56:09', '2017-05-02 16:01:59'),
(7, 1, 3, 4, 3, '0000-00-00 00:00:00', '2017-05-04 15:54:20');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `transaction_type_id` int(11) NOT NULL,
  `is_input` tinyint(4) DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `notes` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `store_id`, `transaction_type_id`, `is_input`, `transaction_date`, `notes`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(12, 1, 1, 1, '2015-05-05', NULL, '2017-05-02 13:00:03', 1, '2017-05-02 13:00:03', NULL),
(13, 3, 1, 1, '2007-07-07', NULL, '2017-05-02 13:01:59', 1, '2017-05-02 13:01:59', NULL),
(14, 1, 1, 1, '2015-05-05', NULL, '2017-05-02 13:26:09', 1, '2017-05-02 13:26:09', NULL),
(15, 1, 1, 1, '2015-05-05', NULL, '2017-05-02 13:36:43', 1, '2017-05-02 13:36:43', NULL),
(16, 1, 2, 0, '2015-05-05', NULL, '2017-05-02 13:39:09', 1, '2017-05-02 13:39:09', NULL),
(17, 1, 4, 0, '2015-05-05', NULL, '2017-05-02 13:41:32', 1, '2017-05-02 13:41:32', NULL),
(18, 1, 3, 0, '2015-05-05', NULL, '2017-05-02 13:46:44', 1, '2017-05-02 13:46:44', NULL),
(19, 3, 3, 1, '2015-05-05', NULL, '2017-05-02 13:46:44', 1, '2017-05-02 13:46:44', NULL),
(20, 1, 3, 0, '2015-05-05', NULL, '2017-05-02 13:47:07', 1, '2017-05-02 13:47:07', NULL),
(21, 3, 3, 1, '2015-05-05', NULL, '2017-05-02 13:47:07', 1, '2017-05-02 13:47:07', NULL),
(22, 1, 1, 5, '2015-05-05', NULL, '2017-05-04 12:54:20', 1, '2017-05-04 12:54:20', NULL),
(23, 3, 1, 5, '2015-05-05', NULL, '2017-05-04 12:54:59', 1, '2017-05-04 12:54:59', NULL),
(24, 3, 5, 1, '2015-05-05', NULL, '2017-05-04 12:56:09', 1, '2017-05-04 12:56:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `balance` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `item_id`, `unit_id`, `quantity`, `balance`, `created_at`, `updated_at`) VALUES
(15, 12, 1, 3, 10, 0, '2017-05-02 13:00:03', '2017-05-02 13:00:03'),
(16, 12, 2, 1, 20, 0, '2017-05-02 13:00:03', '2017-05-02 13:00:03'),
(17, 13, 3, 4, 30, 0, '2017-05-02 13:01:59', '2017-05-02 13:01:59'),
(18, 13, 2, 1, 60, 0, '2017-05-02 13:01:59', '2017-05-02 13:01:59'),
(19, 14, 1, 3, 200, 10, '2017-05-02 13:26:09', '2017-05-02 13:26:09'),
(20, 15, 1, 3, 250, 210, '2017-05-02 13:36:43', '2017-05-02 13:36:43'),
(21, 16, 1, 3, 460, 460, '2017-05-02 13:39:09', '2017-05-02 13:39:09'),
(22, 17, 2, 1, 3, 20, '2017-05-02 13:41:32', '2017-05-02 13:41:32'),
(23, 18, 2, 1, 10, 17, '2017-05-02 13:46:44', '2017-05-02 13:46:44'),
(24, 19, 2, 1, 10, 60, '2017-05-02 13:46:44', '2017-05-02 13:46:44'),
(25, 20, 2, 1, 5, 7, '2017-05-02 13:47:07', '2017-05-02 13:47:07'),
(26, 21, 2, 1, 5, 70, '2017-05-02 13:47:07', '2017-05-02 13:47:07'),
(27, 22, 1, 3, 1, 0, '2017-05-04 12:54:20', '2017-05-04 12:54:20'),
(28, 22, 2, 1, 1, 2, '2017-05-04 12:54:20', '2017-05-04 12:54:20'),
(29, 22, 3, 4, 3, 0, '2017-05-04 12:54:20', '2017-05-04 12:54:20'),
(30, 23, 3, 4, 29, 30, '2017-05-04 12:54:59', '2017-05-04 12:54:59'),
(31, 23, 2, 1, 73, 75, '2017-05-04 12:54:59', '2017-05-04 12:54:59'),
(32, 23, 1, 3, 0, 0, '2017-05-04 12:54:59', '2017-05-04 12:54:59'),
(33, 24, 3, 4, 29, 59, '2017-05-04 12:56:09', '2017-05-04 12:56:09'),
(34, 24, 2, 1, 63, 148, '2017-05-04 12:56:09', '2017-05-04 12:56:09'),
(35, 24, 1, 3, 0, 0, '2017-05-04 12:56:09', '2017-05-04 12:56:09');

--
-- Triggers `transaction_details`
--
DELIMITER $$
CREATE TRIGGER `transaction_details_insert` AFTER INSERT ON `transaction_details` FOR EACH ROW begin
DECLARE _store_id int;    
DECLARE _item_id int;      
DECLARE _unit_id int;      
DECLARE _transaction_type_id int;   
DECLARE _is_input tinyint;     
DECLARE _quantity double;
declare is_exists int;

select item_id INTO _item_id from transaction_details where id=NEW.ID;

select quantity into _quantity from transaction_details where id=NEW.ID;

select unit_id into _unit_id from transaction_details where id=NEW.ID;

SET _store_id = (SELECT store_id FROM transaction WHERE id=NEW.transaction_id LIMIT 1); 

SET _transaction_type_id = (SELECT transaction_type_id FROM transaction WHERE id=NEW.transaction_id LIMIT 1); 

SET _is_input = (SELECT is_input FROM transaction WHERE id=NEW.transaction_id LIMIT 1); 

set is_exists=(select count(*) from store_item_balance where item_id=_item_id and store_id=_store_id);

if(_transaction_type_id=5) THEN

if (is_exists=1)
then
	UPDATE store_item_balance set balance=_quantity,
    updated_at=sysdate()
    where store_id=_store_id and item_id=_item_id;
ELSE
	if (_quantity>0) then
	insert into store_item_balance(item_id,store_id,balance,unit_id,created_at)
    values (_item_id,_store_id,_quantity,_unit_id,sysdate());
    end if;
end if;
else 


if (_is_input=0)
then
set _quantity=_quantity*-1;
end if;

if (is_exists=1)
then
	UPDATE store_item_balance set balance=balance+_quantity,
    updated_at=sysdate()
    where store_id=_store_id and item_id=_item_id;
ELSE
	if(_quantity>0) then
	insert into store_item_balance(item_id,store_id,balance,unit_id,created_at)
    values (_item_id,_store_id,_quantity,_unit_id,sysdate());
    end if;
end if;


end if;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE `transaction_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction_type`
--

INSERT INTO `transaction_type` (`id`, `name`) VALUES
(1, 'وارد'),
(2, 'صادر'),
(3, 'نقل'),
(4, 'اتلاف'),
(5, 'جرد');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'وحدة', 1, '2017-04-27 15:24:31', NULL, '2017-04-27 15:24:31'),
(2, 'كغم', 1, '2017-04-27 15:24:42', NULL, '2017-04-27 15:24:42'),
(3, 'لتر', 1, '2017-04-27 15:24:46', NULL, '2017-04-27 15:24:46'),
(4, 'متر', 1, '2017-04-27 15:36:16', NULL, '2017-04-27 15:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'مدير النظام', 'info@admin.com', '$2y$10$hyaSy7602YnHoN0D780iKuNIQEfiuo2tnA2Xyvq3nn8wubNLuP/GW', 'nnVWiEsvGYYnKk0SGINiXnhERtQoSN6I1vLuoO7bGmkMNZsODhdkxFZ6NgbP', '2017-05-07 10:38:34', '2017-05-07 10:38:34'),
(2, 'Vision Plus', 'basel1090@gmail.com', '$2y$10$wsjW7GEeH0k1y9l.6cT6m.cdPOeVfGMby9EWZVfCIH02eSxELkJda', 'L55Ib123jueKmc1kWoXoy9Pc0hNF1AxGdc5uwKDZENomxaALfI03B3mkYClt', '2017-05-07 10:40:04', '2017-05-07 10:40:04'),
(6, 'محمود خليل أبو جياب', 'mhd@jayyab.com', '$2y$10$2gpmFpDT0VzhZX0R7kyycOo1GMKmfytp8j4B8ed/FZSP7FebPXLle', 'PhX2RBqfw01O5xC8ZXNIcRNWeI9zXZuqJyCFt5hqscAIgvlcyelddidi6rCp', '2017-05-07 10:52:11', '2017-05-07 10:58:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `admin_link`
--
ALTER TABLE `admin_link`
  ADD PRIMARY KEY (`admin_id`,`link_id`),
  ADD KEY `link_id` (`link_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_item_balance`
--
ALTER TABLE `store_item_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `transaction_type_id` (`transaction_type_id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `store_item_balance`
--
ALTER TABLE `store_item_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `admin_link`
--
ALTER TABLE `admin_link`
  ADD CONSTRAINT `admin_link_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `admin_link_ibfk_2` FOREIGN KEY (`link_id`) REFERENCES `link` (`id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `store_item_balance`
--
ALTER TABLE `store_item_balance`
  ADD CONSTRAINT `store_item_balance_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`),
  ADD CONSTRAINT `store_item_balance_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `store_item_balance_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_type` (`id`);

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`),
  ADD CONSTRAINT `transaction_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `transaction_details_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
