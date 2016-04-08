-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2016 at 05:58 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elmal3ab`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `photographer` varchar(64) DEFAULT NULL,
  `main_image` varchar(64) NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published` tinyint(4) NOT NULL,
  `published_by` varchar(64) DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `hits` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `photographer`, `main_image`, `created_by`, `created_at`, `published`, `published_by`, `published_at`, `hits`) VALUES
(5, 'البوم1', 'البوم2', '11857720581460137048.jpg', 'فارس أحمد', '2016-04-08 17:37:44', 1, 'فارس أحمد', '2016-04-08 17:37:44', 0),
(6, 'البوم2', 'البوم2', '10269964351460137073.jpg', 'فارس أحمد', '2016-04-08 17:38:03', 1, 'فارس أحمد', '2016-04-08 17:38:03', 0),
(7, 'البوم3', 'البوم3', '8564727211460137118.jpg', 'فارس أحمد', '2016-04-08 17:38:47', 1, 'فارس أحمد', '2016-04-08 17:38:47', 0),
(8, 'البوم4', 'البوم4', '4291550241460137137.jpg', 'فارس أحمد', '2016-04-08 17:39:06', 1, 'فارس أحمد', '2016-04-08 17:39:06', 0),
(9, 'البوم5', 'البوم5', '20992846891460137156.jpg', 'فارس أحمد', '2016-04-08 17:39:27', 1, 'فارس أحمد', '2016-04-08 17:39:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `album_images`
--

CREATE TABLE `album_images` (
  `id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `image_name` varchar(64) NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album_images`
--

INSERT INTO `album_images` (`id`, `image_id`, `image_name`, `album_id`) VALUES
(24, 40, '19129021460129890.jpg', 5),
(25, 41, '21242815151460129890.jpg', 5),
(26, 42, '1112635911460129891.jpg', 5),
(27, 43, '6964887861460129891.jpg', 5),
(28, 44, '19306817541460129892.jpg', 5),
(40, 56, '14742181781460137049.jpg', 5),
(41, 57, '14078621141460137049.jpg', 5),
(42, 58, '10269964351460137073.jpg', 6),
(43, 59, '12217268801460137073.jpg', 6),
(44, 60, '18312847231460137074.jpg', 6),
(45, 64, '8564727211460137118.jpg', 7),
(46, 65, '14063598501460137119.jpg', 7),
(47, 66, '14721358531460137119.jpg', 7),
(48, 67, '3137011391460137136.jpg', 8),
(49, 68, '7743744881460137136.jpg', 8),
(50, 69, '4291550241460137137.jpg', 8),
(51, 70, '6459959171460137137.jpg', 8),
(52, 71, '16075621061460137137.jpg', 8),
(53, 72, '11599942061460137138.jpg', 8),
(54, 73, '2306587081460137154.jpg', 9),
(55, 74, '21081949461460137155.jpg', 9),
(56, 75, '6302250581460137155.jpg', 9),
(57, 76, '810345721460137155.jpg', 9),
(58, 77, '20992846891460137156.jpg', 9),
(59, 78, '8073025701460137156.jpg', 9);

-- --------------------------------------------------------

--
-- Table structure for table `featured_albums`
--

CREATE TABLE `featured_albums` (
  `id` int(10) NOT NULL,
  `album_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `featured_albums`
--

INSERT INTO `featured_albums` (`id`, `album_id`) VALUES
(19, 9),
(20, 8),
(21, 7);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `stadiums` tinyint(4) NOT NULL,
  `images_albums` tinyint(4) NOT NULL,
  `videos` tinyint(4) NOT NULL,
  `users_groups` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `stadiums`, `images_albums`, `videos`, `users_groups`) VALUES
(1, 'admin', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  `uploaded_by` varchar(64) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `session_id` varchar(32) NOT NULL,
  `times_used` int(11) NOT NULL DEFAULT '0',
  `watermarked` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `description`, `uploaded_by`, `uploaded_at`, `session_id`, `times_used`, `watermarked`) VALUES
(1, '12080092471459787673.jpg', '', 'فارس أحمد', '2016-04-04 16:34:34', '1459787670', 0, 0),
(2, '19613254131459787734.jpg', '', 'فارس أحمد', '2016-04-04 16:35:34', '1459787730', 0, 0),
(3, '2138493951459789204.jpg', '', 'فارس أحمد', '2016-04-04 17:00:04', '1459789188', 0, 0),
(4, '4089846661459789316.jpg', 'asdasdasd', 'فارس أحمد', '2016-04-04 17:01:56', '1459789311', 0, 0),
(5, '14276538501459790984.jpg', '', 'فارس أحمد', '2016-04-04 17:29:44', '1459790977', 0, 0),
(6, '15990176981459790984.jpg', '', 'فارس أحمد', '2016-04-04 17:29:44', '1459790977', 0, 0),
(7, '13183399921459790985.jpg', '', 'فارس أحمد', '2016-04-04 17:29:45', '1459790977', 0, 0),
(8, '13874895891459790985.jpg', '', 'فارس أحمد', '2016-04-04 17:29:45', '1459790977', 0, 0),
(9, '9874986931459790985.jpg', '', 'فارس أحمد', '2016-04-04 17:29:45', '1459790977', 0, 0),
(10, '7574439631459790985.jpg', '', 'فارس أحمد', '2016-04-04 17:29:46', '1459790977', 0, 0),
(11, '3024437731459791115.jpg', '', 'فارس أحمد', '2016-04-04 17:31:55', '1459791110', 0, 0),
(12, '19323752031459791120.jpg', '', 'فارس أحمد', '2016-04-04 17:32:00', '1459791110', 0, 0),
(13, '17022274521459791120.jpg', '', 'فارس أحمد', '2016-04-04 17:32:00', '1459791110', 0, 0),
(14, '8437783531459791120.jpg', '', 'فارس أحمد', '2016-04-04 17:32:01', '1459791110', 0, 0),
(15, '1567763621459791121.jpg', '', 'فارس أحمد', '2016-04-04 17:32:01', '1459791110', 0, 0),
(16, '4297585241459791121.jpg', '', 'فارس أحمد', '2016-04-04 17:32:01', '1459791110', 0, 0),
(17, '13039852891459796871.jpg', 'wwww', 'فارس أحمد', '2016-04-04 19:07:52', '1459796868', 0, 0),
(18, '13552249941459796948.jpg', 'd', 'فارس أحمد', '2016-04-04 19:09:09', '1459796946', 0, 0),
(19, '15791095551459796966.jpg', '', 'فارس أحمد', '2016-04-04 19:09:26', '1459796963', 0, 0),
(20, '13533291621459796966.jpg', '', 'فارس أحمد', '2016-04-04 19:09:27', '1459796963', 0, 0),
(21, '11548856871459796967.jpg', '', 'فارس أحمد', '2016-04-04 19:09:27', '1459796963', 0, 0),
(22, '8326492901459796967.jpg', '', 'فارس أحمد', '2016-04-04 19:09:27', '1459796963', 0, 0),
(23, '6809249111459796967.jpg', '', 'فارس أحمد', '2016-04-04 19:09:27', '1459796963', 0, 0),
(24, '4489904891459807365.jpg', 'asdasd', 'فارس أحمد', '2016-04-04 22:02:45', '1459807362', 0, 0),
(25, '12648084511459807431.jpg', '', 'فارس أحمد', '2016-04-04 22:03:51', '1459807427', 0, 0),
(26, '10574356031459807431.jpg', '', 'فارس أحمد', '2016-04-04 22:03:51', '1459807427', 0, 0),
(27, '4809540541459807431.jpg', '', 'فارس أحمد', '2016-04-04 22:03:51', '1459807427', 0, 0),
(28, '15308315591459807431.jpg', '', 'فارس أحمد', '2016-04-04 22:03:52', '1459807427', 0, 0),
(29, '11381629581459807432.jpg', '', 'فارس أحمد', '2016-04-04 22:03:52', '1459807427', 0, 0),
(30, '15081494941459807432.jpg', '', 'فارس أحمد', '2016-04-04 22:03:52', '1459807427', 0, 0),
(31, '14381323481459877429.jpg', 'test', 'فارس أحمد', '2016-04-05 17:30:30', '1459877421', 2, 0),
(32, '8285113921459884316.jpg', '', 'فارس أحمد', '2016-04-05 19:25:16', '1459884312', 0, 0),
(33, '13734915751459884316.jpg', '', 'فارس أحمد', '2016-04-05 19:25:16', '1459884312', 0, 0),
(34, '10887836791459884316.jpg', '', 'فارس أحمد', '2016-04-05 19:25:17', '1459884312', 0, 0),
(35, '9497294831459884317.jpg', '', 'فارس أحمد', '2016-04-05 19:25:17', '1459884312', 0, 0),
(36, '3762103681459884317.jpg', '', 'فارس أحمد', '2016-04-05 19:25:17', '1459884312', 0, 0),
(37, '9346084231459890809.jpg', '', 'فارس أحمد', '2016-04-05 21:13:29', '1459890805', 0, 0),
(38, '8525827331459890810.jpg', '', 'فارس أحمد', '2016-04-05 21:13:30', '1459890805', 0, 0),
(39, '196498121459890810.jpg', '', 'فارس أحمد', '2016-04-05 21:13:30', '1459890805', 0, 0),
(40, '19129021460129890.jpg', '', 'فارس أحمد', '2016-04-08 15:38:10', '1460129871', 0, 0),
(41, '21242815151460129890.jpg', '', 'فارس أحمد', '2016-04-08 15:38:11', '1460129871', 0, 0),
(42, '1112635911460129891.jpg', '', 'فارس أحمد', '2016-04-08 15:38:11', '1460129871', 0, 0),
(43, '6964887861460129891.jpg', '', 'فارس أحمد', '2016-04-08 15:38:12', '1460129871', 0, 0),
(44, '19306817541460129892.jpg', '', 'فارس أحمد', '2016-04-08 15:38:12', '1460129871', 0, 0),
(45, '16606858111460129892.jpg', '', 'فارس أحمد', '2016-04-08 15:38:12', '1460129871', 0, 0),
(46, '17563057691460136950.jpg', '', 'فارس أحمد', '2016-04-08 17:35:50', '1460136929', 0, 0),
(47, '14054399091460136951.jpg', '', 'فارس أحمد', '2016-04-08 17:35:51', '1460136929', 0, 0),
(48, '12973624051460136951.jpg', '', 'فارس أحمد', '2016-04-08 17:35:51', '1460136929', 0, 0),
(49, '4757684391460136951.jpg', '', 'فارس أحمد', '2016-04-08 17:35:51', '1460136929', 0, 0),
(50, '13610492871460136951.jpg', '', 'فارس أحمد', '2016-04-08 17:35:52', '1460136929', 0, 0),
(51, '15697352871460136952.jpg', '', 'فارس أحمد', '2016-04-08 17:35:52', '1460136929', 0, 0),
(52, '11857720581460137048.jpg', '', 'فارس أحمد', '2016-04-08 17:37:28', '1460137043', 0, 0),
(53, '5022253051460137048.jpg', '', 'فارس أحمد', '2016-04-08 17:37:28', '1460137043', 0, 0),
(54, '4382686431460137049.jpg', '', 'فارس أحمد', '2016-04-08 17:37:29', '1460137043', 0, 0),
(55, '1734896521460137049.jpg', '', 'فارس أحمد', '2016-04-08 17:37:29', '1460137043', 0, 0),
(56, '14742181781460137049.jpg', '', 'فارس أحمد', '2016-04-08 17:37:29', '1460137043', 0, 0),
(57, '14078621141460137049.jpg', '', 'فارس أحمد', '2016-04-08 17:37:30', '1460137043', 0, 0),
(58, '10269964351460137073.jpg', '', 'فارس أحمد', '2016-04-08 17:37:53', '1460137068', 0, 0),
(59, '12217268801460137073.jpg', '', 'فارس أحمد', '2016-04-08 17:37:54', '1460137068', 0, 0),
(60, '18312847231460137074.jpg', '', 'فارس أحمد', '2016-04-08 17:37:54', '1460137068', 0, 0),
(61, '5471463481460137102.jpg', '', 'فارس أحمد', '2016-04-08 17:38:22', '1460137085', 0, 0),
(62, '9407708051460137103.jpg', '', 'فارس أحمد', '2016-04-08 17:38:23', '1460137085', 0, 0),
(63, '9190962571460137103.jpg', '', 'فارس أحمد', '2016-04-08 17:38:23', '1460137085', 0, 0),
(64, '8564727211460137118.jpg', '', 'فارس أحمد', '2016-04-08 17:38:39', '1460137114', 0, 0),
(65, '14063598501460137119.jpg', '', 'فارس أحمد', '2016-04-08 17:38:39', '1460137114', 0, 0),
(66, '14721358531460137119.jpg', '', 'فارس أحمد', '2016-04-08 17:38:39', '1460137114', 0, 0),
(67, '3137011391460137136.jpg', '', 'فارس أحمد', '2016-04-08 17:38:56', '1460137132', 0, 0),
(68, '7743744881460137136.jpg', '', 'فارس أحمد', '2016-04-08 17:38:56', '1460137132', 0, 0),
(69, '4291550241460137137.jpg', '', 'فارس أحمد', '2016-04-08 17:38:57', '1460137132', 0, 0),
(70, '6459959171460137137.jpg', '', 'فارس أحمد', '2016-04-08 17:38:57', '1460137132', 0, 0),
(71, '16075621061460137137.jpg', '', 'فارس أحمد', '2016-04-08 17:38:57', '1460137132', 0, 0),
(72, '11599942061460137138.jpg', '', 'فارس أحمد', '2016-04-08 17:38:58', '1460137132', 0, 0),
(73, '2306587081460137154.jpg', '', 'فارس أحمد', '2016-04-08 17:39:15', '1460137151', 0, 0),
(74, '21081949461460137155.jpg', '', 'فارس أحمد', '2016-04-08 17:39:15', '1460137151', 0, 0),
(75, '6302250581460137155.jpg', '', 'فارس أحمد', '2016-04-08 17:39:15', '1460137151', 0, 0),
(76, '810345721460137155.jpg', '', 'فارس أحمد', '2016-04-08 17:39:16', '1460137151', 0, 0),
(77, '20992846891460137156.jpg', '', 'فارس أحمد', '2016-04-08 17:39:16', '1460137151', 0, 0),
(78, '8073025701460137156.jpg', '', 'فارس أحمد', '2016-04-08 17:39:16', '1460137151', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stadiums`
--

CREATE TABLE `stadiums` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(250) NOT NULL,
  `address` varchar(70) NOT NULL,
  `phone` int(15) NOT NULL,
  `workhours_from` varchar(16) NOT NULL,
  `workhours_to` varchar(16) NOT NULL,
  `ground_type` varchar(50) NOT NULL,
  `hour_price` varchar(4) NOT NULL,
  `image` varchar(64) NOT NULL,
  `main_album` varchar(64) DEFAULT NULL,
  `video_link` varchar(256) DEFAULT NULL,
  `published` tinyint(4) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_by_id` int(10) NOT NULL,
  `published_at` varchar(200) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stadiums`
--

INSERT INTO `stadiums` (`id`, `user_id`, `title`, `description`, `address`, `phone`, `workhours_from`, `workhours_to`, `ground_type`, `hour_price`, `image`, `main_album`, `video_link`, `published`, `created_date`, `published_by_id`, `published_at`, `hits`) VALUES
(1, 1, 'مركز شباب الجيزة', 'ملت أعمال التطوير رفع كفاءة اساحة لعدد 2 نادى اجتماعى وفرشها بالأثاث', 'جديدasdasdasdad1', 114654, '10:00 PM', '11:30 PM', 'asdasd', '100', '4089846661459789316.jpg', NULL, NULL, 1, '2016-04-04 17:02:34', 1, '2016-04-04 17:02:34', 0),
(2, 1, 'asdasdasd', 'ملت أعمال التطوير رفع كفاءة اساحة لعدد 2 نادى اجتماعى وفرشها بالأثاث', 'جديد', 654654, '10:00 PM', '11:30 PM', 'qsdasd', '100', '4489904891459807365.jpg', NULL, NULL, 1, '2016-04-04 22:02:56', 0, '2016-04-05 00:03:08', 0),
(3, 1, 'gg', 'gg', 'gg', 33, '10:00 PM', '11:30 PM', 'rr', '44', '4489904891459807365.jpg', NULL, NULL, 1, '2016-04-05 16:23:18', 1, '2016-04-05 16:23:18', 0),
(4, 1, 'test', 'test test test test test testtesttestte sttesttestte sttesttestt esttesttest', '654654test', 654, '10:00 PM', '11:30 PM', 'testtesttest', '654', '14381323481459877429.jpg', NULL, NULL, 1, '2016-04-05 17:30:39', 1, '2016-04-05 17:30:39', 0),
(5, 1, 'ملعب جديد', 'ملعب جديد ملعب جديد ملعب جديد ملعب جديد ملعب جديد ملعب جديد ملعب جديد ملعب جديد ملعب جديد ملعب جديد ملعب جديد ملعب جديد', 'ملعب جديد', 65465465, '11:00 PM', '11:30 PM', 'نجيلة', '150', '4489904891459807365.jpg', NULL, NULL, 1, '2016-04-05 20:10:22', 1, '2016-04-05 20:10:22', 0),
(11, 1, 'qwe', 'qwe', 'qwe', 654, '11:11 PM', '11:11 PM', 'qwe', '50', '13552249941459796948.jpg', '3&10574356031459807431.jpg', '1:s5-bI8MBKb0:0', 1, '2016-04-05 21:12:26', 1, '2016-04-05 21:12:26', 0),
(12, 1, 'asd', 'wqe', 'qwe', 34, '3:16 AM', '3:16 AM', '234', '234', '14381323481459877429.jpg', '4&10887836791459884316.jpg', NULL, 1, '2016-04-07 01:18:22', 1, '2016-04-07 01:18:22', 0),
(13, 1, 'asd', 'qwe', 'qq', 654, '4:13 AM', '4:13 AM', 'qwqwe', '4654', '14381323481459877429.jpg', '3&10574356031459807431.jpg', '1:s5-bI8MBKb0:0', 1, '2016-04-07 02:13:48', 1, '2016-04-07 02:13:48', 0),
(14, 1, 'qwe', 'q', 'qwe', 2, '7:48 PM', '7:48 PM', '123123', '123', '4489904891459807365.jpg', '4&10887836791459884316.jpg', '1:s5-bI8MBKb0:0', 1, '2016-04-07 17:48:27', 1, '2016-04-07 17:48:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stadiums_rate`
--

CREATE TABLE `stadiums_rate` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stadium_id` int(11) NOT NULL,
  `rate` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stadiums_rate`
--

INSERT INTO `stadiums_rate` (`id`, `user_id`, `stadium_id`, `rate`) VALUES
(1, 1, 1, 2),
(2, 2, 3, 4),
(3, 3, 3, 5),
(4, 1, 2, 5),
(5, 2, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users_details`
--

CREATE TABLE `users_details` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `group_id` smallint(6) NOT NULL,
  `picture` varchar(128) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `mobile` varchar(16) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_details`
--

INSERT INTO `users_details` (`id`, `name`, `group_id`, `picture`, `username`, `password`, `mobile`, `email`) VALUES
(1, 'فارس أحمد', 1, '1_1459370548.jpg', 'faris', '$2y$10$MbkviR3//rv3ft88W9215u/G3b4OjGWs3daeOFoY1SJbFV3bvu8ni', '', ''),
(2, 'منير', 1, '', 'mounir', '$2y$10$XRS.4pEqNZLjyPd4t4Am8OiUaspWR1.XDYUYXl.2z4wu33/R3aiLS', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `stadiums` tinyint(4) NOT NULL,
  `images_albums` tinyint(4) NOT NULL,
  `videos` tinyint(4) NOT NULL,
  `users_groups` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`user_id`, `group_id`, `stadiums`, `images_albums`, `videos`, `users_groups`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `video_type` int(2) NOT NULL DEFAULT '0',
  `user_id` int(10) NOT NULL,
  `title` text NOT NULL,
  `author` varchar(128) NOT NULL,
  `image` varchar(64) NOT NULL,
  `link` text NOT NULL,
  `published` tinyint(4) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_by_id` int(10) NOT NULL,
  `published_at` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `video_type`, `user_id`, `title`, `author`, `image`, `link`, `published`, `created_date`, `published_by_id`, `published_at`) VALUES
(1, 0, 1, 'qwe', 'qwe', '14381323481459877429.jpg', 's5-bI8MBKb0', 1, '2016-04-05 21:11:57', 1, '2016-04-05 21:11:57'),
(3, 0, 1, 'asd', 'asd', '14381323481459877429.jpg', '132', 1, '2016-04-07 20:29:54', 1, '2016-04-07 20:29:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_title_idx` (`title`(255));

--
-- Indexes for table `album_images`
--
ALTER TABLE `album_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_idx` (`album_id`);

--
-- Indexes for table `featured_albums`
--
ALTER TABLE `featured_albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stadiums`
--
ALTER TABLE `stadiums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stadiums_rate`
--
ALTER TABLE `stadiums_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_details`
--
ALTER TABLE `users_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `album_images`
--
ALTER TABLE `album_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `featured_albums`
--
ALTER TABLE `featured_albums`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `stadiums`
--
ALTER TABLE `stadiums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `stadiums_rate`
--
ALTER TABLE `stadiums_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_details`
--
ALTER TABLE `users_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_permissions`
--
ALTER TABLE `users_permissions`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
