-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2017 at 05:46 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'Anticipate this event!', '2017-10-26 15:45:51', '2017-10-26 15:45:51');

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
(1, 'Tealive Sdn. Bhd.', 356232800, '/images/userpic/1509030500.jpg', 'HI :D\r\nWE ARE TEALIVE', 'Food&Beverages', 'Basic', '2017-11-26', 3, 1),
(2, 'Microsoft Sdn. Bhd.', 31234312, '/images/userpic/1509031043.png', 'HI\r\nWE ARE MICROSOFT', 'Information Technology', 'Basic', '2017-11-26', 4, 0),
(3, 'H&M Sdn. Bhd.', 34124564, '/images/userpic/1509031098.jpg', 'WE ARE H&M', 'Art', 'Epic', '2018-04-26', 5, 1);

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
  `eventFees` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventDescription` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companyid` int(10) UNSIGNED NOT NULL,
  `eventApproval` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventid`, `eventName`, `eventDate`, `eventVenue`, `eventImage`, `eventInterest`, `eventFees`, `eventDescription`, `companyid`, `eventApproval`) VALUES
(1, 'When We Are Young', '2017-12-22', 'INTI Subang University', '/images/eventpic/1509031289.png', 'Business', 'Free', 'Meet with CEOs like Bryan Loo', 1, 1),
(2, 'Gathering of Masters', '2017-11-29', 'Sunway Pyramid', '/images/eventpic/1509031366.png', 'Mass Comm', 'Free', 'Gather with masters like director of H&M', 3, 0),
(3, 'MONSTA EXPERIENCE', '2017-10-25', 'HQ of H&M', '/images/eventpic/1509031438.png', 'Art', '50', 'Experience workshop!', 3, 1);

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
(1, 3, 1),
(2, 3, 2);

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
(13, '2017_10_22_184833_create_usersnpostsncomments_table', 1);

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
(1, 'It''s a shame I have missed the chance to participate this event!', '2017-10-26 15:43:32', '2017-10-26 15:43:32');

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
(1, 'Monsta Experience is fun!', 'I have great experience there! Great organizing team!', '2017-10-26 15:42:46', 2);

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
(1, 'Evon', 'Siow', '1996-06-25', 162808062, 'INTI', 'Female', 'Computer Science', 'Information Technology', '/images/userpic/1509030323.jpg', 'HI :D\r\nIM EVON :D', 'Newbie', 1100, 2),
(2, 'Nick', 'Lim', '1995-03-20', 125673212, 'TAYLOR', 'Male', 'Engineering', 'Information Technology', '/images/userpic/1509032319.jpg', 'HI NICK HERE :D', 'Newbie', 1000, 6);

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
(1, 1, 1, 0),
(2, 1, 3, 1),
(3, 2, 1, 0),
(4, 2, 3, 0);

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
(1, 'evonmiyako.em@gmail.com', '$2y$10$cMLWoPtmQZLPv7TFl6oIZ.uOvjdlsP33ygiZdRa4.SixqxZKPbPHa', 'aynyrtXrKc547qCrT32KGkFMSOzNGUTgBJ7fOO18YwgUDydKAOh5UCyALvrk', 3, '2017-10-26 14:55:24', '2017-10-26 14:55:24'),
(2, 'cqes231@uowmail.edu.au', '$2y$10$dsmAmOE7mL8amRWRfA/1HeSZ9BBy7.XNAFCzrINZmXJEShU70LTM6', 'YQCNrubU6M7MMWsqApcxQ7lUStFgkfnXJafNBk61AM2BGHX9cyBAr6V3Qq1n', 1, '2017-10-26 15:05:23', '2017-10-26 15:05:23'),
(3, 'tealive@gmail.com', '$2y$10$hrhY1op6YlPnKMJeGO.aVe5HHwcf8iPAvulflyi4MFgnChwPn3XK2', 'raWoj3QsgK8emBsTknSf8mKxuoGcqHO788haGNk0mhgnH7MYvRr81rj1c5aI', 2, '2017-10-26 15:08:20', '2017-10-26 15:08:20'),
(4, 'microsoft@gmail.com', '$2y$10$qNOLZpBGipjJ9WLbvbxvhuutZshtB4i2XZqf2eQAxON4CwwdHHdyu', 'IGKRcYoHlwfnjFE4MjnBtxsF30rKKkZ4eRZ8HbOgrnc1lFJc47HPX6HJAs8q', 2, '2017-10-26 15:17:23', '2017-10-26 15:17:23'),
(5, 'hnm@gmail.com', '$2y$10$UfghIqkCSDriqClIxkIZ9OqvS9j6ANz7hcPO2TQTFVh6f579LFjQW', 'v5wuO39gwJ0HlHD1oXZAV8nQqcN7QPtLT5fUpffA1Tqy9TtHp0BWpQoTW73u', 2, '2017-10-26 15:18:18', '2017-10-26 15:18:18'),
(6, 'adrian@gmail.com', '$2y$10$rs0LLPl8G2bVwzqH5gnNt.4UVZtkffGPpqlRROdp2nlcJtPcqLU2S', '0tTeb7cm10y7ZoGKJ0DsDwCrUE5v1tyvdIvEr5abN6pEHGu3ZwBlH8CIDQJC', 1, '2017-10-26 15:38:40', '2017-10-26 15:38:40');

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
(1, 6, 1, 1);

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
(1, 6, 1, 1);

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
  MODIFY `commentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `companyid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `eventsnimages`
--
ALTER TABLE `eventsnimages`
  MODIFY `eventnimageid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `postcomments`
--
ALTER TABLE `postcomments`
  MODIFY `postcommentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `studentsnevents`
--
ALTER TABLE `studentsnevents`
  MODIFY `studentneventid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usersneventsncomments`
--
ALTER TABLE `usersneventsncomments`
  MODIFY `commentfid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usersnpostsncomments`
--
ALTER TABLE `usersnpostsncomments`
  MODIFY `postcommentfid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
