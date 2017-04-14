-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2017 at 05:39 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pointer-management-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Admin User ID',
  `name` varchar(40) DEFAULT NULL COMMENT 'User Name',
  `kananame` varchar(40) DEFAULT NULL COMMENT 'User Kana Name',
  `email` varchar(128) DEFAULT NULL COMMENT 'User Email',
  `password` varchar(255) DEFAULT NULL COMMENT 'User Password',
  `confirm_code` varchar(255) DEFAULT NULL COMMENT 'Confirm Code',
  `logdate` timestamp NULL DEFAULT NULL COMMENT 'User Last Login Time',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'User Created Time',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'User Modified Time',
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin User Table';

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `name`, `kananame`, `email`, `password`, `confirm_code`, `logdate`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'redstar2', 'Zhao Qing Shu', 'a1', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '0000-00-00 00:00:00', '2015-06-16 12:01:02', 'VBDfS3yTmxwM6zdJV0hkmkHeJVSlfz6X61htz2G3Uu5dDADN4b8qWJfRJbYd'),
(2, 'www', 'Li Yuan Ge', 'd8', '$2y$10$utS7KZMvVgW480kvRPF20.LNl9OvfW9klxcW8AHa23r9y9/qKiEXG', NULL, '2015-06-03 03:51:36', '2015-05-27 18:08:44', '2015-06-03 04:51:24', ''),
(3, 'god', 'rgb', 'rgb@hotmail.com', '$2y$10$utS7KZMvVgW480kvRPF20.LNl9OvfW9klxcW8AHa23r9y9/qKiEXG', NULL, '2015-12-02 04:51:34', '2015-06-04 00:42:38', '2015-12-02 04:51:34', 'yzV3lrjnSuWKUtBFwMe0NruDmT9gkHSOmCSRnSpzYHLVWY5GzjYNgReNDB75'),
(4, 's', 'j', 'lk8@a.com', '$2y$10$MuUsvu3ndXfe/tH/3u7CjOZnmqO5dSpPkgU2TttNccE6yNij7XxLy', 'lk', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-07-03 10:43:26', 'l'),
(5, 'lk', 'lk', 'lk19', 'lk', 'lk', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'lk'),
(6, 'lk', 'lk', 'lk20', 'j', 'kj', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'kj'),
(7, 'kih', 'i', 'u', 'u', 'gu', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'g'),
(8, 'u', 'guyg', 'uy', 'guy', 'gu', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'g'),
(9, 'oy', 'go', NULL, 'jh', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(11, 'go2', 'uyg', 'ou@a.com', '$2y$10$.eHdAIUOKtezUjIEQxafg.G2bzFOjjetOQ0U0orUjQI.k1xfKGOX6', 'ouy', NULL, '0000-00-00 00:00:00', '2015-06-16 11:40:10', 'g'),
(12, 'uyg', 'u', 'd7', 'uy', 'g', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ou'),
(13, 'uy', 'g', 'uyg', 'uy', 'go', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(14, 'uyg', 'uy', 'guy', 'gou', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'yg'),
(15, 'u', 'gou', 'g', 'ou', 'yg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'uyg'),
(16, 'ygou', 'ygo', 'ug1', 'ouyg', 'ou', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ug'),
(17, 'gu', 'ygo', 'ug', 'oug', 'ou', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'gu'),
(18, 'ug', 'u', 'g2', 'ug', 'ug', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'u'),
(19, 'g', 'u', 'o', 'ugo', 'ug', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'g'),
(20, 'u', 'fsd', 'kk7', 'jk', 'jk', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'kj'),
(21, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-16 07:59:43', NULL, NULL),
(22, 'god4', NULL, 'a@a.com', '$2y$10$QR6hXKASJg3lT3fehVueeOQf8S6OHuyOFNa7HOk8bmuB.elpr/O5O', NULL, NULL, '2015-06-16 10:22:40', '2015-06-16 10:22:40', NULL),
(23, 'wq', 'wq', 'wq@d.com', '$2y$10$fykflNpWWaloJMEKZRFc9OewfxIAK4pQpLqYUu1MSMBB7tXirfyEW', NULL, NULL, '2015-06-16 10:37:20', '2015-06-16 10:37:20', NULL),
(24, 'wq2', 'wq2', 'ad@a.com', '$2y$10$KvhvAM1Y8rDbSVh1WXUGiuw3Nihz8l4b87oR13ThljJAZESxvrDZm', NULL, NULL, '2015-06-16 10:37:50', '2015-06-16 10:37:50', NULL),
(25, 'asfd', 'asdf', 'asfda@a.com', '$2y$10$6oxKS20WL5jx0j96Fr1jxel4xHFziVbGYVOLq9bhi/RAQQ9hnJdYi', NULL, NULL, '2015-06-16 10:39:27', '2015-06-16 10:39:27', NULL),
(26, 'rgb', 'rgbkana', 'a@rgb.com', '$2y$10$f4B6JaY5Kih9u8hNp1GOc.EBDVfPZEKmxm1In.JMS5wSnGlXr6HP.', NULL, NULL, '2015-06-16 10:41:59', '2015-06-16 10:41:59', NULL),
(27, 'fdsafd', 'afds', 'af1@e.com', '$2y$10$zVi5wNhsjL2sVJJlcoKZzOv3.Lv9dIBVkTk7PqrfphBgErZLyNKru', NULL, NULL, '2015-06-16 10:57:33', '2015-06-16 10:57:33', NULL),
(28, 'fdsa', 'afds', 'asfda2@a.com', '$2y$10$P2nI55Gm2Y5Ioh59tdBH8OqJjJB88thm/j.GB/AH8hiL0OPZFVQjK', NULL, NULL, '2015-06-16 11:01:48', '2015-06-16 11:01:48', NULL),
(29, 'qwre', 'qrew', 'af@1e.com', '$2y$10$B6dxALrSTx3rZwhD1M4jJeUoyz5ujGpL0Qu8kXqo4Fof6.8Hn.2wC', NULL, NULL, '2015-06-16 11:02:30', '2015-06-16 11:02:30', NULL),
(30, 'afs', 'afs', 'af@2e.com', '$2y$10$km9NKqJ.UEwEphbqyyt2zeqrlgZi459wI0t9HSdNyG2cnXzM3KAVG', NULL, NULL, '2015-06-16 11:03:05', '2015-06-16 11:03:05', NULL),
(31, 'q', 'q', 'af2@e.com', '$2y$10$U1p/l9kGryev8CGj.LnoKOJ5HHPjKDXzB3YxjDMK/xgLrKA0Sprv6', NULL, NULL, '2015-06-16 11:04:33', '2015-06-16 11:04:33', NULL),
(32, 'a', 'a', 'af@e.com', '$2y$10$gp0z/dKOd3BkL4U4gf0uLu.9/73KQr62jZAzi52mf8cfi.ORNDxdq', NULL, NULL, '2015-06-16 11:05:17', '2015-06-16 11:05:17', NULL),
(33, 'b', 'a', 'abf@e.com', '$2y$10$ty1wgURQNe6yBJsoSgFsQO4.cewhI9uHduPa75E1vknBpx5FKbCaS', NULL, NULL, '2015-06-16 11:10:59', '2015-06-16 11:10:59', NULL),
(34, NULL, NULL, NULL, '$2y$10$KrEPyFWMmdh2o09GZcpyLOw60VMnuSbVZfb6OIH7CNPXPGkrbMxRy', NULL, NULL, '2015-06-17 08:04:38', '2015-06-17 08:04:38', NULL),
(35, NULL, NULL, NULL, '$2y$10$dJJWJA4Ufj4..hRM7YwmiOcz9LpLMQwni4GOBOD.bCtbZmssBKOt2', NULL, NULL, '2015-06-17 08:05:05', '2015-06-17 08:05:05', NULL),
(36, NULL, NULL, NULL, '$2y$10$WzXzgLb3F/rMKPYe9.4XhudITl5OgbPo3BMThJfpUjqYtypA49Eu6', NULL, NULL, '2015-06-17 08:06:18', '2015-06-17 08:06:18', NULL),
(37, NULL, 'j', 'j2', 'k', 'k', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'k'),
(38, NULL, 'j', 'j3', 'k', 'j', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'k'),
(39, 'k', 'kj', 'kj1', 'kj', 'kj', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'kj'),
(40, 'kj', 'k', 'j4', 'kj', 'kj', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'j'),
(41, 'k', NULL, 'kj2', 'k', 'j', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'j'),
(42, 'kj', 'k', 'j5', 'k', 'k', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'kj'),
(43, 'k', NULL, 'kj3', 'kj', 'j', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'kj'),
(44, 'j', 'kj', 'kj4', 'k', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'kj'),
(45, 'k', 'j', 'kj5', 'kj', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'k'),
(46, 'kj', 'k', 'jk1', 'k', 'j', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'kj'),
(47, 'k', 'k', 'jk2', 'j', 'kjk', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(48, 'jk', 'jkj', 'k', 'j', 'kj', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'k'),
(49, 'j', 'k', 'j6', 'kj', 'k', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'k'),
(50, 'kj', 'k', 'j8', 'kj', 'kj', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'k'),
(51, 'j', 'k', 'j9', 'kj', 'k', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'kj'),
(52, 'jk', 'j', 'kj6', 'k', 'jk', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'jkj'),
(53, 'j', 'k', 'j0', NULL, NULL, NULL, '2015-06-17 11:55:54', NULL, NULL),
(54, 'redstar2', 'Zhao Qing Shu', 'a2', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(55, 'redstar2', 'Zhao Qing Shu', 'a3', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(56, 'redstar2', 'Zhao Qing Shu', 'a4a', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(57, 'redstar2', 'Zhao Qing Shu', 'a5', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(58, 'redstar2', 'Zhao Qing Shu', 'a6a', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(59, 'redstar2', 'Zhao Qing Shu', 'a7', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(60, 'redstar2', 'Zhao Qing Shu', 'a8', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(61, 'redstar2', 'Zhao Qing Shu', 'aaaa9', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(62, 'redstar2', 'Zhao Qing Shu', 'a11', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(63, 'redstar2', 'Zhao Qing Shu', 'a12', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(64, 'redstar2', 'Zhao Qing Shu', 'a111', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(65, 'redstar2', 'Zhao Qing Shu', 'a112', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(66, 'redstar2', 'Zhao Qing Shu', 'a113', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(67, 'redstar2', 'Zhao Qing Shu', 'a114', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(68, 'redstar2', 'Zhao Qing Shu', 'a115', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(69, 'redstar2', 'Zhao Qing Shu', 'a116', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(70, 'redstar2', 'Zhao Qing Shu', 'a117', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(71, 'redstar2', 'Zhao Qing Shu', 'a118', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(72, 'redstar2', 'Zhao Qing Shu', 'a119', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(73, 'redstar2', 'Zhao Qing Shu', 'a1111', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(74, 'redstar2', 'Zhao Qing Shu', 'a11112', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(75, 'redstar2', 'Zhao Qing Shu', 'a11113', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(76, 'redstar2', 'Zhao Qing Shu', 's1', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(77, 'redstar2', 'Zhao Qing Shu', 's2', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(78, 'redstar2', 'Zhao Qing Shu', 's3', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(79, 'redstar2', 'Zhao Qing Shu', 's4', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(80, 'redstar2', 'Zhao Qing Shu', 's5', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(81, 'redstar2', 'Zhao Qing Shu', 's6', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(82, 'redstar2', 'Zhao Qing Shu', 's7', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(83, 'redstar2', 'Zhao Qing Shu', 's8', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(84, 'redstar2', 'Zhao Qing Shu', 's9', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(85, 'redstar2', 'Zhao Qing Shu', 's10', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(86, 'redstar2', 'Zhao Qing Shu', 'd1', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(87, 'redstar2', 'Zhao Qing Shu', 'd2', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(88, 'redstar2', 'Zhao Qing Shu', 'd3', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(89, 'redstar2', 'Zhao Qing Shu', 'd4', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(90, 'redstar2', 'Zhao Qing Shu', 'd5', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(91, 'redstar2', 'Zhao Qing Shu', 'd6', '$2y$10$RRzc82//.QrX9pvvFyGghuGe21WhxXzfjsXFYJlrnAQ5q5S0xiunS', 'q', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 04:48:51', '2015-05-28 12:48:51'),
(92, 'RGBNAME', 'rgbkananame', 'rgb@gmail.com', '$2y$10$4DBO6.SFjlJNIblA8mA4ju6GSpBCqs4aI1zaCWTkhf.BKYED6l1gW', NULL, NULL, '2015-06-29 08:21:27', '2015-06-29 08:21:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Category ID',
  `category_name` varchar(40) DEFAULT NULL COMMENT 'Category Name',
  `pointer_color` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Category Created Time',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Category Updated Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Category Table';

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `pointer_color`, `created_at`, `updated_at`) VALUES
(1, 'category1', '#7bd148', '2015-05-27 02:51:41', '2015-05-27 03:34:27'),
(2, 'category2', '#9fe1e7', '2015-05-27 03:34:48', '2015-05-27 03:34:48'),
(3, 'category3', '#b99aff', '2015-05-27 05:07:33', '2015-05-27 19:34:05'),
(6, 'category_edit', '#f691b2', '2015-06-17 08:11:36', '2015-07-03 10:26:40'),
(8, 'ww', '#0B2C1D', '2015-07-03 07:55:41', '2015-07-14 02:09:34'),
(9, 'aaa', '#9fe1e7', '2015-07-06 08:58:10', '2015-07-06 08:58:10'),
(10, 'dasfd', '#ffad46', '2015-07-09 04:36:15', '2015-07-09 04:36:15'),
(11, 's', '#ffad46', '2015-07-10 11:51:23', '2015-07-10 11:51:23'),
(12, 'ffa', '#ffad46', '2015-07-14 01:49:39', '2015-07-14 01:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Group ID',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Group Created Time',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Group Updated Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Group Table';

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `created_at`, `updated_at`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '2015-06-07 17:01:58', '2015-06-07 17:01:58'),
(3, '2015-06-07 17:03:35', '2015-06-07 17:03:35'),
(4, '2015-06-07 17:03:46', '2015-06-07 17:03:46'),
(5, '2015-06-11 03:08:05', '2015-06-11 03:08:05'),
(6, '2015-06-11 03:31:08', '2015-06-11 03:31:08'),
(7, '2015-06-11 03:56:51', '2015-06-11 03:56:51'),
(8, '2015-06-12 02:41:06', '2015-06-12 02:41:06'),
(9, '2015-06-17 12:00:45', '2015-06-17 12:00:45'),
(10, '2015-06-17 12:14:48', '2015-06-17 12:14:48'),
(11, '2015-06-17 12:16:10', '2015-06-17 12:16:10'),
(12, '2015-06-17 12:16:55', '2015-06-17 12:16:55'),
(13, '2015-06-17 12:18:04', '2015-06-17 12:18:04'),
(14, '2015-06-17 12:18:46', '2015-06-17 12:18:46'),
(15, '2015-06-17 12:21:16', '2015-06-17 12:21:16'),
(16, '2015-06-18 19:34:51', '2015-06-18 19:34:51'),
(17, '2015-06-26 02:23:46', '2015-06-26 02:23:46'),
(18, '2015-06-26 02:51:48', '2015-06-26 02:51:48'),
(19, '2015-06-26 02:54:14', '2015-06-26 02:54:14'),
(20, '2015-06-26 02:59:11', '2015-06-26 02:59:11'),
(21, '2015-06-26 03:02:08', '2015-06-26 03:02:08'),
(22, '2015-06-26 03:04:05', '2015-06-26 03:04:05'),
(23, '2015-06-26 03:06:54', '2015-06-26 03:06:54'),
(24, '2015-06-26 03:08:06', '2015-06-26 03:08:06'),
(25, '2015-06-26 03:11:51', '2015-06-26 03:11:51'),
(26, '2015-06-26 03:29:39', '2015-06-26 03:29:39'),
(27, '2015-06-26 03:57:02', '2015-06-26 03:57:02'),
(28, '2015-06-26 04:00:43', '2015-06-26 04:00:43'),
(29, '2015-06-26 04:08:04', '2015-06-26 04:08:04'),
(30, '2015-06-26 04:09:27', '2015-06-26 04:09:27'),
(31, '2015-06-26 04:13:26', '2015-06-26 04:13:26'),
(32, '2015-06-26 04:22:53', '2015-06-26 04:22:53'),
(33, '2015-06-26 04:24:46', '2015-06-26 04:24:46'),
(34, '2015-06-26 04:26:50', '2015-06-26 04:26:50'),
(35, '2015-06-26 04:29:58', '2015-06-26 04:29:58'),
(36, '2015-06-26 04:30:55', '2015-06-26 04:30:55'),
(37, '2015-06-26 04:40:50', '2015-06-26 04:40:50'),
(38, '2015-06-26 09:25:12', '2015-06-26 09:25:12'),
(39, '2015-06-26 12:29:01', '2015-06-26 12:29:01'),
(40, '2015-07-14 06:58:55', '2015-07-14 06:58:55'),
(41, '2015-07-17 07:34:52', '2015-07-17 07:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pointer`
--

CREATE TABLE `pointer` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Pointer ID',
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Group ID',
  `pointer_age` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Pointer Age',
  `pointer_period` varchar(128) DEFAULT NULL COMMENT 'Category ID',
  `category_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Category ID',
  `pointer_name` varchar(128) DEFAULT NULL COMMENT 'Pointer Name',
  `pointer_kananame` varchar(128) DEFAULT NULL COMMENT 'Pointer Kana Name',
  `pointer_address` varchar(255) DEFAULT NULL COMMENT 'Pointer Address',
  `pointer_longitude` double DEFAULT NULL COMMENT 'Pointer Position(Logitude)',
  `pointer_latitude` double DEFAULT NULL COMMENT 'Pointer Position(Latitude)',
  `pointer_longlatdisp` varchar(128) DEFAULT '0',
  `pointer_curaddress` varchar(255) DEFAULT NULL COMMENT 'Pointer Current Address',
  `pointer_comment` text COMMENT 'Pointer Comment',
  `pointer_extra` text COMMENT 'Pointer Extra',
  `pointer_show` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Flag if pointer show',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Pointer Created Time',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Pointer Modified Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Pointer Table';

--
-- Dumping data for table `pointer`
--

INSERT INTO `pointer` (`id`, `group_id`, `pointer_age`, `pointer_period`, `category_id`, `pointer_name`, `pointer_kananame`, `pointer_address`, `pointer_longitude`, `pointer_latitude`, `pointer_longlatdisp`, `pointer_curaddress`, `pointer_comment`, `pointer_extra`, `pointer_show`, `created_at`, `updated_at`) VALUES
(62, 17, 1, 'newpointer', 8, 'asf', 'asdfasdfasdf', 'aaaaaaa', -6574807.4249777, 10175297.205323, '138.21402｜34.89336', 'aaaaaaa', '', '', 1, '2015-07-20 02:13:41', '2015-07-20 03:13:41'),
(63, 18, 2, 'afds', 2, 'afd', 'afds', 'fdsa', -7122708.043725871, 9549125.069610499, '138.21433｜34.89351', 'fdsa', '', '', 0, '2015-07-20 04:13:48', '2015-07-17 06:28:36'),
(72, 27, 1, 'asdfasdf', 3, 'asdfasdfasdfasf', 'asdf', 'asdfas', -9549125.069610503, 8218509.281222152, '138.21565｜34.89385', 'asdfas', 'fa', '', 1, '2015-07-17 05:28:41', '2015-07-17 06:28:41'),
(73, 28, 2, 'adsfas', 2, 'fdasdaaaa', 'fasdfasdfasd', 'a', -5244191.636589378, 1330615.788388349, '138.21330｜34.89678', 'a', '', '', 0, '2015-07-20 04:13:51', '2015-07-17 06:28:22'),
(74, 29, 3, 'asdfasfd', 1, 'asdfaaaa', 'aa', 'f', -6066042.564711563, 10370975.99773302, '138.21375｜34.89332', 'f', '', '', 1, '2015-07-20 04:13:52', '2015-07-17 07:13:11'),
(75, 30, 2, 'qrew', 8, 'qrewqwre', 'rewqrewqrew', 'q', -12758257.265134953, 12171220.887904916, '138.21741｜34.89299', 'q', '', '', 1, '2015-07-20 04:13:52', '2015-07-17 07:13:19'),
(76, 31, 3, 'asdf', 6, 'aaaaaaaaaaafioio', 'a', 'a', -1252344.2714243159, 2426417.025884658, '138.21111｜34.89619', 'ex_a', '', '', 0, '2015-07-20 04:13:53', '2015-07-17 07:13:52'),
(77, 32, 2, 'asdf', 2, 'aaaaaf', 'asfasf', 'f', 8441769.844027698, 7792680.231861625, '138.20580｜34.89398', 'f', '', '', 1, '2015-07-20 04:13:53', '2015-07-17 07:13:05'),
(78, 33, 1, 'rew', 1, 'new', 'new', 's', -3905902.170067303, 469629.1017841138, '138.21256｜34.89725', 's', '', '', 1, '2015-07-17 06:13:25', '2015-07-17 07:13:25'),
(79, 34, 2, 'sfgsdgf', 8, 'sdfgsdgf', 'sgfsdgf', 's', -3835304.331236951, 3287403.7124888226, '138.21252｜34.89576', 's', '', '', 0, '2015-07-20 04:13:54', '2015-07-17 07:14:18'),
(80, 35, 3, 'afsdf', 6, 'asdfah', 'sfd', 'f', -6105178.3231936395, 9979618.412912931, '138.21377｜34.89341', 'f', '', '', 0, '2015-07-20 04:13:54', '2015-07-17 07:14:30'),
(81, 36, 2, 'fff', 3, 'aaa', 'vvv', 'a', 7435794.111581981, 665307.8941941708, '138.20635｜34.89714', 'ex_a', '', '', 1, '2015-07-20 04:13:54', '2015-07-17 07:14:09'),
(82, 37, 3, 'afds', 2, 'asdfasp', 'dfasdf', 'a', -9001224.450862385, 8257645.0397042, '138.21535｜34.89384', 'a', '', '', 1, '2015-07-20 04:13:54', '2015-07-17 07:14:37'),
(83, 38, 2, 'REDSTAR', 3, 'OK', 'OKKANA', 'TOKYO', 1258008.5297059119, 7352855.315266777, '138.20973｜34.89411', 'TOKYO', '', '', 1, '2015-07-20 04:13:55', '2015-07-17 07:14:47'),
(84, 39, 1, 'ff', 3, 'jia', 'jia', 'a', -5372390.935159996, 7200873.786739662, '138.21337｜34.89416', 'a', '', '', 1, '2015-07-17 06:15:22', '2015-07-17 07:15:22'),
(86, 40, 3, 'a', 2, 'f', 'f', 'asd', -9157767.484790407, 6613943.18345974, '138.21544｜34.89436', 'aaa', 'aa', 'a', 1, '2015-07-17 06:15:36', '2015-07-17 07:15:36'),
(87, 41, 1, 'afas', 8, 'fssasdf', 'asdf', 'long', 0, 4070118.8821290657, '138.21042｜34.89539', 'lat', 'asdf', 'asdf', 1, '2015-07-17 07:34:52', '2015-07-17 07:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `pointer_photo`
--

CREATE TABLE `pointer_photo` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Pointer Photo ID',
  `pointer_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Pointer ID for This Photo',
  `photo_name` varchar(255) DEFAULT NULL COMMENT 'Photo Name',
  `photo_comment` text COMMENT 'Photo Comment',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Photo Created Time',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Photo Modified Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Pointer Photo Table';

--
-- Dumping data for table `pointer_photo`
--

INSERT INTO `pointer_photo` (`id`, `pointer_id`, `photo_name`, `photo_comment`, `created_at`, `updated_at`) VALUES
(342, 73, 'god15-06-11-13-31-05Blue hills.jpg', '', '2015-07-17 06:28:22', '2015-07-17 06:28:22'),
(343, 73, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-17 06:28:22', '2015-07-17 06:28:22'),
(344, 73, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-17 06:28:22', '2015-07-17 06:28:22'),
(351, 63, 'god15-06-11-13-31-05Blue hills.jpg', '', '2015-07-17 06:28:36', '2015-07-17 06:28:36'),
(352, 63, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-17 06:28:36', '2015-07-17 06:28:36'),
(353, 63, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-17 06:28:36', '2015-07-17 06:28:36'),
(354, 72, 'god15-06-11-13-31-05Blue hills.jpg', '', '2015-07-17 06:28:41', '2015-07-17 06:28:41'),
(355, 72, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-17 06:28:41', '2015-07-17 06:28:41'),
(356, 72, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-17 06:28:41', '2015-07-17 06:28:41'),
(357, 77, 'god15-06-11-13-31-05Blue hills.jpg', '', '2015-07-17 07:13:05', '2015-07-17 07:13:05'),
(358, 77, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-17 07:13:05', '2015-07-17 07:13:05'),
(359, 77, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-17 07:13:05', '2015-07-17 07:13:05'),
(360, 74, 'god15-06-11-13-31-05Blue hills.jpg', '', '2015-07-17 07:13:11', '2015-07-17 07:13:11'),
(361, 74, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-17 07:13:11', '2015-07-17 07:13:11'),
(362, 74, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-17 07:13:11', '2015-07-17 07:13:11'),
(363, 75, 'god15-06-11-13-31-05Blue hills.jpg', '', '2015-07-17 07:13:19', '2015-07-17 07:13:19'),
(364, 75, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-17 07:13:19', '2015-07-17 07:13:19'),
(365, 75, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-17 07:13:19', '2015-07-17 07:13:19'),
(366, 78, 'god15-06-11-13-31-05Blue hills.jpg', '', '2015-07-17 07:13:25', '2015-07-17 07:13:25'),
(367, 78, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-17 07:13:25', '2015-07-17 07:13:25'),
(368, 78, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-17 07:13:25', '2015-07-17 07:13:25'),
(369, 76, 'god15-06-11-13-31-05Blue hills.jpg', '', '2015-07-17 07:13:52', '2015-07-17 07:13:52'),
(370, 76, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-17 07:13:52', '2015-07-17 07:13:52'),
(371, 76, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-17 07:13:52', '2015-07-17 07:13:52'),
(375, 81, 'god15-06-11-13-31-05Blue hills.jpg', '', '2015-07-17 07:14:09', '2015-07-17 07:14:09'),
(376, 81, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-17 07:14:09', '2015-07-17 07:14:09'),
(377, 81, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-17 07:14:09', '2015-07-17 07:14:09'),
(378, 79, 'god15-06-11-13-31-05Blue hills.jpg', '', '2015-07-17 07:14:18', '2015-07-17 07:14:18'),
(379, 79, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-17 07:14:18', '2015-07-17 07:14:18'),
(380, 79, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-17 07:14:18', '2015-07-17 07:14:18'),
(381, 80, 'god15-06-11-13-31-05Blue hills.jpg', '', '2015-07-17 07:14:30', '2015-07-17 07:14:30'),
(382, 80, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-17 07:14:30', '2015-07-17 07:14:30'),
(383, 80, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-17 07:14:30', '2015-07-17 07:14:30'),
(398, 62, 'god15-06-11-13-31-05Blue hills.jpg', '1234\n      5678\n             90', '2015-07-20 03:13:41', '2015-07-20 03:13:41'),
(399, 62, 'god15-06-12-06-17-40Winter.jpg', '', '2015-07-20 03:13:41', '2015-07-20 03:13:41'),
(400, 62, 'god15-06-12-08-37-32Sunset.jpg', '', '2015-07-20 03:13:41', '2015-07-20 03:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'rgb', 'rgb@gmail.com', '$2y$10$8ZQIFASq9rZKjRqGGhw8Ce7QsUoarS7HoJKigXPw2TMXpWaAw45oe', 'sdJj877bs1ZxBKulnRSp1QQ6S4gTRSSBcXCxH4gvE78p6BANRnfPoIIJ3Kg8', '2015-05-30 23:37:37', '2015-05-31 00:15:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pointer`
--
ALTER TABLE `pointer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pointer` (`group_id`),
  ADD KEY `FK_pointer2` (`category_id`);

--
-- Indexes for table `pointer_photo`
--
ALTER TABLE `pointer_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pointer_photo` (`pointer_id`);

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
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Admin User ID', AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Category ID', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Group ID', AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `pointer`
--
ALTER TABLE `pointer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Pointer ID', AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `pointer_photo`
--
ALTER TABLE `pointer_photo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Pointer Photo ID', AUTO_INCREMENT=401;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pointer`
--
ALTER TABLE `pointer`
  ADD CONSTRAINT `FK_pointer` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_pointer2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pointer_photo`
--
ALTER TABLE `pointer_photo`
  ADD CONSTRAINT `FK_pointer_photo` FOREIGN KEY (`pointer_id`) REFERENCES `pointer` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
