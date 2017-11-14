-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2017 at 01:12 AM
-- Server version: 5.6.36
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monsta_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentid` int(10) UNSIGNED NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentid`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'Anticipate this event!!!Hope to meet more friends there!', '2017-11-14 16:21:52', '2017-11-14 16:21:52'),
(2, 'Hope to meet more friends :)', '2017-11-14 16:32:22', '2017-11-14 16:32:22'),
(3, 'I would like to discover more healthy living', '2017-11-14 16:54:51', '2017-11-14 16:54:51'),
(4, 'Our event would definitely helps you to have healthier live!', '2017-11-14 16:55:46', '2017-11-14 16:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `companyid` int(10) UNSIGNED NOT NULL,
  `companyName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aboutcompany` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membershipDate` date NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `companyApproval` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`companyid`, `companyName`, `phone`, `image`, `aboutcompany`, `interest`, `status`, `membershipDate`, `userid`, `companyApproval`) VALUES
(1, 'H&M Sdn. Bhd.', 356232800, '/images/userpic/1510646097.jpg', 'H&M is passionate in fashion :D', 'Art', 'Basic', '2017-12-14', 2, 1),
(2, 'Tealive Sdn. Bhd.', 30213212, '/images/userpic/1510646151.jpg', 'Tealive loves bubble tea ^^', 'Business', 'Basic', '2017-12-14', 3, 1),
(3, 'Microsoft Sdn. Bhd.', 12304212, '/images/userpic/1510646248.png', 'Microsoft loves technology :)', 'Information Technology', 'Popular', '2018-02-14', 5, 1),
(4, 'Forever 21 Sdn. Bhd.', 34512421, '/images/userpic/1510646291.png', 'Forever 21 is young :)', 'Mass Comm', 'Epic', '2018-05-14', 6, 0),
(5, 'Padini Sdn. Bhd.', 41315312, '/images/userpic/1510646416.jpg', 'Welcome to Padini :D', 'Fashion', 'Basic', '2017-12-14', 8, 0),
(6, 'Nestle Sdn. Bhd.', 3952412, '/images/userpic/1510648123.jpg', 'Good Food, Good Life', 'Food&Beverages', 'Epic', '2018-05-14', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventid` int(10) UNSIGNED NOT NULL,
  `eventName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventDate` date NOT NULL,
  `eventVenue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventImage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventInterest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventSeats` int(11) NOT NULL,
  `eventFees` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventDescription` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companyid` int(10) UNSIGNED NOT NULL,
  `eventApproval` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventid`, `eventName`, `eventDate`, `eventVenue`, `eventImage`, `eventInterest`, `eventSeats`, `eventFees`, `eventDescription`, `companyid`, `eventApproval`) VALUES
(1, 'Gathering of Master', '2017-10-14', 'Sunway Pyramid', '/images/eventpic/1510647078.png', 'Business', 3, 'Free', 'Gathering with The Founder of Tealive', 2, 1),
(2, 'When We Are Young', '2017-12-20', 'Midvalley Convention Center', '/images/eventpic/1510647258.png', 'Mass Comm', 2, '15', 'Young Heart Young Energy', 1, 1),
(3, 'Monsta Xperience', '2018-01-20', 'Sunway University', '/images/eventpic/1510647421.png', 'Information Technology', 8, 'Free', 'Come and learn with us.', 3, 1),
(4, 'City Walk', '2018-01-01', 'Beach Street Penang', '/images/eventpic/1510648241.jpg', 'Health', 100, 'Free', 'Good Life Good Health', 6, 1),
(5, 'Mother\'s Day', '2017-11-25', 'Citta Mall', '/images/eventpic/1510648840.jpg', 'Business', 6, 'Free', 'Love Your Mother forever.', 6, 0),
(6, 'Kitkat with us', '2018-01-26', 'Paradigm Mall', '/images/eventpic/1510648958.jpg', 'Business', 5, 'Free', 'Take a Break with Kitkat', 6, 0),
(7, 'Amazing Cool', '2018-02-10', 'Inti Subang College', '/images/eventpic/1510649275.jpg', 'Mass Comm', 5, 'Free', 'Join our Ice cream Contest!', 6, 1),
(8, 'Breakfast Academy', '2017-09-14', 'One Utama Convention Center', '/images/eventpic/1510649392.jpg', 'Mass Comm', 5, 'Free', 'Eat Right Live Well', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `eventsnimages`
--

CREATE TABLE `eventsnimages` (
  `eventnimageid` int(10) UNSIGNED NOT NULL,
  `eventid` int(10) UNSIGNED NOT NULL,
  `imageid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eventsnimages`
--

INSERT INTO `eventsnimages` (`eventnimageid`, `eventid`, `imageid`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 8, 4),
(5, 8, 5),
(6, 8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imageid` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageid`, `image`) VALUES
(1, '/images/pasteventpic/event1.jpg'),
(2, '/images/pasteventpic/event2.jpg'),
(3, '/images/pasteventpic/event3.jpg'),
(4, '/images/pasteventpic/event4.jpg'),
(5, '/images/pasteventpic/event5.jpg'),
(6, '/images/pasteventpic/event6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2017_07_30_174348_create_users_table', 1),
(3, '2017_08_12_090931_create_companies_table', 1),
(4, '2017_08_12_090931_create_events_table', 1),
(5, '2017_08_18_183831_create_students_table', 1),
(6, '2017_09_19_015734_create_studentsnevents_table', 1),
(7, '2017_09_28_144756_create_comments_table', 1),
(8, '2017_09_28_161350_create_usersneventsncomments_table', 1),
(9, '2017_10_06_235710_create_images_table', 1),
(10, '2017_10_06_235919_create_eventsnimages_table', 1),
(11, '2017_10_13_153616_create_posts_table', 1),
(12, '2017_10_22_184013_create_postcomments_table', 1),
(13, '2017_10_22_184833_create_usersnpostsncomments_table', 1),
(14, '2017_11_12_024709_create_upgrademembership_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postcomments`
--

CREATE TABLE `postcomments` (
  `postcommentid` int(10) UNSIGNED NOT NULL,
  `postcomment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postcomments`
--

INSERT INTO `postcomments` (`postcommentid`, `postcomment`, `created_at`, `updated_at`) VALUES
(1, 'Hope to see you in our next activity :D', '2017-11-14 20:35:33', '2017-11-14 20:35:33'),
(2, 'Glad to hear positive feedback here ^^', '2017-11-14 21:38:42', '2017-11-14 21:38:42'),
(3, 'Noted, thanks :D', '2017-11-15 16:48:33', '2017-11-15 16:48:33'),
(4, 'Overall experience is great but one of the staff\'s attitude isn\'t friendly at all', '2017-11-14 17:06:32', '2017-11-14 17:06:32'),
(5, 'Noted', '2017-11-14 17:10:54', '2017-11-14 17:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postid` int(10) UNSIGNED NOT NULL,
  `postTitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postDescription` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postid`, `postTitle`, `postDescription`, `created_at`, `userid`) VALUES
(1, 'Gathering of Masters', 'Glad to have chance to join such memorable activity :D', '2017-11-14 08:34:22', 4),
(2, 'Notification of Monsta Experience', 'Note that, participants of Monsta Experience should bring their own laptop :D', '2017-11-14 08:47:58', 5),
(3, 'Feedback for Breakfast Academy', 'Thanks for joining us. How will you rate our activity?', '2017-11-14 09:04:41', 12),
(4, 'Website Maintenance', 'Our website will be upgrading tomorrow. Sorry for the inconvenience caused.', '2017-11-14 09:11:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentid` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `phone` int(11) NOT NULL,
  `campus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aboutme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` int(11) NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentid`, `firstName`, `lastName`, `dob`, `phone`, `campus`, `gender`, `education`, `interest`, `image`, `aboutme`, `status`, `experience`, `userid`) VALUES
(1, 'Jasmine', 'Leong', '1996-01-14', 125589746, 'SUNWAY', 'Female', 'Business', 'Mass Comm', '/images/userpic/1510646172.jpg', 'Hi I\'m Jasmine.', 'Newbie', 1100, 4),
(2, 'Jonathan', 'Lim', '1990-02-10', 111748965, 'INTI', 'Male', 'Accounting', 'Business', '/images/userpic/1510646305.jpg', 'Hi I\'m Jonathan.', 'Newbie', 1000, 7),
(3, 'Mathew', 'Tan', '1993-03-06', 136587496, 'TAYLOR', 'Male', 'Engineering', 'Business', '/images/userpic/1510646432.jpg', 'Hi I\'m Mathew!', 'Newbie', 1100, 9),
(4, 'Tiffany', 'Lee', '1998-10-05', 173698542, 'SUNWAY', 'Female', 'Computer Science', 'Law', '/images/userpic/1510646541.jpg', 'Hi I\'m Tiffany!', 'Newbie', 1100, 10),
(5, 'Michelle', 'Ooi', '1992-03-22', 162808032, 'SEGI', 'Female', 'Commerce', 'Mass Comm', '/images/userpic/1510647144.jpg', 'I love to attend fashion show :)', 'Newbie', 1100, 11);

-- --------------------------------------------------------

--
-- Table structure for table `studentsnevents`
--

CREATE TABLE `studentsnevents` (
  `studentneventid` int(10) UNSIGNED NOT NULL,
  `studentid` int(10) UNSIGNED NOT NULL,
  `eventid` int(10) UNSIGNED NOT NULL,
  `participate` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentsnevents`
--

INSERT INTO `studentsnevents` (`studentneventid`, `studentid`, `eventid`, `participate`) VALUES
(1, 5, 1, 1),
(2, 1, 1, 1),
(3, 1, 2, 0),
(4, 2, 2, 0),
(5, 3, 4, 0),
(6, 3, 3, 0),
(7, 4, 3, 0),
(8, 2, 8, 0),
(9, 4, 8, 1),
(10, 4, 7, 0),
(11, 3, 8, 1),
(12, 2, 7, 0),
(13, 4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `upgrademembership`
--

CREATE TABLE `upgrademembership` (
  `upgrademembershipid` int(10) UNSIGNED NOT NULL,
  `companyid` int(10) UNSIGNED NOT NULL,
  `upgradeStatus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upgradeApproval` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upgrademembership`
--

INSERT INTO `upgrademembership` (`upgrademembershipid`, `companyid`, `upgradeStatus`, `upgradeApproval`) VALUES
(1, 1, 'Epic', 0),
(2, 2, 'Popular', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'evonmiyako.em@gmail.com', '$2y$10$hfJRKuR6F3tHqucrsUhaTutiGwt5PsCj9JfJXOAUuUqjbB5wtQZ5W', 'TLOcI5hkCA3RubFTeAT301VUtFrZV7uMrwnE5cQHzGNinHdMkpEvaStOdIWJ', 3, '2017-11-13 12:21:08', '2017-11-13 12:21:08'),
(2, 'hnmx2017@gmail.com', '$2y$10$4nkzYcasQEOTXYRNYiXudORVZxUi3IEaJONA8ZfSuNVTvTv7nYHye', 'TxSUsSqyVE8WpZKVlW8PSI4XFfxFJK85BX5ZLANJDeAOpr9oDbOt2kLBvNHy', 2, '2017-11-14 15:54:57', '2017-11-14 15:54:57'),
(3, 'tealivex2017@gmail.com', '$2y$10$8L.xsyJUnGbejRxFeCEigeLh74K5aDn0vpyO060FG0fYetjiquUya', 'T5CkQbiaKbBy9Y09bKTUDqq8Ygv7IzdRKu0fQWhOSW6ewDJzT9BtjAGfeaMW', 2, '2017-11-14 15:55:51', '2017-11-14 15:55:51'),
(4, 'jasmineleong1112@gmail.com', '$2y$10$.5g9atLEf33rXEI3cdlgiuvnWnc91lEyOCKQc4EFqPXEq/HWUCyVu', 'ehsnkTHMzHNbAsJyFAp8oth7w9tqDI6lsSl95aQRzNoEYjSp6yenP8EgTGEy', 1, '2017-11-14 15:56:12', '2017-11-14 15:56:12'),
(5, 'microsoft@gmail.com', '$2y$10$KHGqx3BsnYX5HEvvG11z/uDb3wu9Epp1.hPi4AYH3QiAQpdZjJnuq', 'wUiVtcjrBW4XiR1gitGEpgN95EnHBo13D6RArGryKSGFTdq2J89RMviQLCw2', 2, '2017-11-14 15:57:28', '2017-11-14 15:57:28'),
(6, 'forever21@gmail.com', '$2y$10$VLVsc/q4idLYmgDo7EvSmOSYD.45kpOiBk6kPZ3gOzmCJR3aPPr/C', 'qOa4GgSF3t0L5ptv1jgsdxHfdPK5dYBn4S3cVeKVivZD8YI1GkA0am33yELu', 2, '2017-11-14 15:58:11', '2017-11-14 15:58:11'),
(7, 'jonathanlim1112@gmail.com', '$2y$10$l/xEDHZaEiZt/lvz7RYlwO.dgCCTTYhQbHKDrFiyT6sjN0gTfg8OK', 'ZF9l76KD8uow7QDIxCAXEKOjkJGbEWe4PYWYmlU0tNsk2sVYPX4MsPVK894V', 1, '2017-11-14 15:58:25', '2017-11-14 15:58:25'),
(8, 'padini@gmail.com', '$2y$10$vtrPe5caZhJJNfDoVcT7AuyTFTLjDYzyWWlr9qVEBg9d04hJ6f5wO', 'GP9wuSuyyjiLwZtQK2ELI7hKTerFl1oIurH8NqaVAmQEsYdHXeJ8Zw9UxApE', 2, '2017-11-14 16:00:16', '2017-11-14 16:00:16'),
(9, 'mathewtan@gmail.com', '$2y$10$4IrLrXj72v8TSBxgok7gru0xDPW/LT5QElbm.EvSESJOGEMRzswL6', 'S6IHGj5TJYC7WHTE4FCJqhrRPoJCIb42YtV8wuoZceksXS1qgmsTnmNwpQ2M', 1, '2017-11-14 16:00:33', '2017-11-14 16:00:33'),
(10, 'tiffanylee@gmail.com', '$2y$10$Tp1d0kFtgN0VmfZO5ozOcuttppCP5jnIt47l6G.qvDg./tVCUIFlu', 'Zt9hxsOP2N487G9lEJrymfwM9vNl2H51XH0cIfBxB58NRJ4QpHAR1HmPkgJY', 1, '2017-11-14 16:02:21', '2017-11-14 16:02:21'),
(11, 'michelleooi@gmail.com', '$2y$10$fSq8SFQvfdMFb4nAspJPAu2ahG5kBZcJSXHGwcaqzQ8QKwus4gYGe', 'ELaETNYpY5Mc6RWlcsSGfgwT4rsibqWhtQDjqiHkFxBZCUxol8Nmdr1pDRlj', 1, '2017-11-14 16:12:24', '2017-11-14 16:12:24'),
(12, 'nestle@gmail.com', '$2y$10$5b25DpeVhICHbeg9ZzaRL.TCWrKpa3.2zyiQocJNZXqplmxhVg0p.', 'GtuYo5clgnwFjv58t8uFm9gDicjeBA9IgeHZk1Wol67vUMsTmravMN8ak2VL', 2, '2017-11-14 16:28:43', '2017-11-14 16:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `usersneventsncomments`
--

CREATE TABLE `usersneventsncomments` (
  `commentfid` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `eventid` int(10) UNSIGNED NOT NULL,
  `commentid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usersneventsncomments`
--

INSERT INTO `usersneventsncomments` (`commentfid`, `userid`, `eventid`, `commentid`) VALUES
(1, 11, 1, 1),
(2, 7, 2, 2),
(3, 7, 8, 3),
(4, 12, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `usersnpostsncomments`
--

CREATE TABLE `usersnpostsncomments` (
  `postcommentfid` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `postid` int(10) UNSIGNED NOT NULL,
  `postcommentid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usersnpostsncomments`
--

INSERT INTO `usersnpostsncomments` (`postcommentfid`, `userid`, `postid`, `postcommentid`) VALUES
(1, 3, 1, 1),
(2, 1, 1, 2),
(3, 9, 2, 3),
(4, 9, 3, 4),
(5, 10, 2, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`companyid`),
  ADD KEY `companies_userid_foreign` (`userid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventid`),
  ADD KEY `events_companyid_foreign` (`companyid`);

--
-- Indexes for table `eventsnimages`
--
ALTER TABLE `eventsnimages`
  ADD PRIMARY KEY (`eventnimageid`),
  ADD KEY `eventsnimages_eventid_foreign` (`eventid`),
  ADD KEY `eventsnimages_imageid_foreign` (`imageid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageid`);

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
-- Indexes for table `postcomments`
--
ALTER TABLE `postcomments`
  ADD PRIMARY KEY (`postcommentid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `posts_userid_foreign` (`userid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentid`),
  ADD KEY `students_userid_foreign` (`userid`);

--
-- Indexes for table `studentsnevents`
--
ALTER TABLE `studentsnevents`
  ADD PRIMARY KEY (`studentneventid`),
  ADD KEY `studentsnevents_studentid_foreign` (`studentid`),
  ADD KEY `studentsnevents_eventid_foreign` (`eventid`);

--
-- Indexes for table `upgrademembership`
--
ALTER TABLE `upgrademembership`
  ADD PRIMARY KEY (`upgrademembershipid`),
  ADD KEY `upgrademembership_companyid_foreign` (`companyid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usersneventsncomments`
--
ALTER TABLE `usersneventsncomments`
  ADD PRIMARY KEY (`commentfid`),
  ADD KEY `usersneventsncomments_userid_foreign` (`userid`),
  ADD KEY `usersneventsncomments_eventid_foreign` (`eventid`),
  ADD KEY `usersneventsncomments_commentid_foreign` (`commentid`);

--
-- Indexes for table `usersnpostsncomments`
--
ALTER TABLE `usersnpostsncomments`
  ADD PRIMARY KEY (`postcommentfid`),
  ADD KEY `usersnpostsncomments_userid_foreign` (`userid`),
  ADD KEY `usersnpostsncomments_postid_foreign` (`postid`),
  ADD KEY `usersnpostsncomments_postcommentid_foreign` (`postcommentid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `companyid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `eventsnimages`
--
ALTER TABLE `eventsnimages`
  MODIFY `eventnimageid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `postcomments`
--
ALTER TABLE `postcomments`
  MODIFY `postcommentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `studentsnevents`
--
ALTER TABLE `studentsnevents`
  MODIFY `studentneventid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `upgrademembership`
--
ALTER TABLE `upgrademembership`
  MODIFY `upgrademembershipid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `usersneventsncomments`
--
ALTER TABLE `usersneventsncomments`
  MODIFY `commentfid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usersnpostsncomments`
--
ALTER TABLE `usersnpostsncomments`
  MODIFY `postcommentfid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_companyid_foreign` FOREIGN KEY (`companyid`) REFERENCES `companies` (`companyid`) ON DELETE CASCADE;

--
-- Constraints for table `eventsnimages`
--
ALTER TABLE `eventsnimages`
  ADD CONSTRAINT `eventsnimages_eventid_foreign` FOREIGN KEY (`eventid`) REFERENCES `events` (`eventid`) ON DELETE CASCADE,
  ADD CONSTRAINT `eventsnimages_imageid_foreign` FOREIGN KEY (`imageid`) REFERENCES `images` (`imageid`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `studentsnevents`
--
ALTER TABLE `studentsnevents`
  ADD CONSTRAINT `studentsnevents_eventid_foreign` FOREIGN KEY (`eventid`) REFERENCES `events` (`eventid`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentsnevents_studentid_foreign` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`) ON DELETE CASCADE;

--
-- Constraints for table `upgrademembership`
--
ALTER TABLE `upgrademembership`
  ADD CONSTRAINT `upgrademembership_companyid_foreign` FOREIGN KEY (`companyid`) REFERENCES `companies` (`companyid`) ON DELETE CASCADE;

--
-- Constraints for table `usersneventsncomments`
--
ALTER TABLE `usersneventsncomments`
  ADD CONSTRAINT `usersneventsncomments_commentid_foreign` FOREIGN KEY (`commentid`) REFERENCES `comments` (`commentid`) ON DELETE CASCADE,
  ADD CONSTRAINT `usersneventsncomments_eventid_foreign` FOREIGN KEY (`eventid`) REFERENCES `events` (`eventid`) ON DELETE CASCADE,
  ADD CONSTRAINT `usersneventsncomments_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usersnpostsncomments`
--
ALTER TABLE `usersnpostsncomments`
  ADD CONSTRAINT `usersnpostsncomments_postcommentid_foreign` FOREIGN KEY (`postcommentid`) REFERENCES `postcomments` (`postcommentid`) ON DELETE CASCADE,
  ADD CONSTRAINT `usersnpostsncomments_postid_foreign` FOREIGN KEY (`postid`) REFERENCES `posts` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `usersnpostsncomments_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
