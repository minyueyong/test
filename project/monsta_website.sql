-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 04:17 PM
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
(1, 'Anticipate this event!', '2017-10-27 14:05:55', '2017-10-27 14:05:55'),
(2, 'We will see you soon, Michelle :D', '2017-10-27 14:09:33', '2017-10-27 14:09:33');

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
(1, 'Tealive Sdn. Bhd.', 356232800, '/images/userpic/1509112014.jpg', 'HI \r\nWE ARE TEALIVE', 'Food&Beverages', 'Basic', '2017-11-27', 3, 1),
(2, 'Microsoft Sdn. Bhd.', 356232812, '/images/userpic/1509112042.png', 'WE ARE MICROSOFT', 'Information Technology', 'Basic', '2017-11-27', 4, 0),
(3, 'H&M Sdn. Bhd.', 31243212, '/images/userpic/1509112102.jpg', 'H&M HERE', 'Art', 'Epic', '2017-11-27', 5, 1);

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
(1, 'Gathering of Masters', '2017-12-22', 'INTI Subang University', '/images/eventpic/1509112321.png', 'Business', 3, 'Free', 'Gather with Bryan Loo', 1, 1),
(2, 'MONSTA EXPERIENCE', '2017-10-26', 'Sunway Pyramid', '/images/eventpic/1509112945.png', 'Art', 5, '50', 'Experience with CEO of H&M', 3, 1),
(3, 'When We Are Young', '2017-11-30', 'INTI Subang University', '/images/eventpic/1509112989.png', 'Mass Comm', 3, 'Free', 'Fashion Show :D', 3, 1),
(4, 'Fashion Passion', '2018-01-11', 'Sunway Pyramid', '/images/eventpic/1509113299.jpg', 'Art', 3, 'Free', 'Fashion show in Sunway Pyramid', 3, 0);

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
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4);

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
(1, 'It''s a shame that I missed to participate this event!', '2017-10-27 14:05:46', '2017-10-27 14:05:46'),
(2, 'No worries definitely have a chance to join us again! :D', '2017-10-27 14:09:11', '2017-10-27 14:09:11');

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
(1, 'Monsta Experience is fun!', 'Fun event!!!', '2017-10-27 14:05:25', 2);

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
(1, 'Evon', 'Siow', '1996-06-25', 162808062, 'INTI', 'Female', 'Computer Science', 'Information Technology', '/images/userpic/1509111986.jpg', 'HI\r\nIM EVON', 'Newbie', 1100, 2),
(2, 'Nick', 'Lim', '1992-03-22', 192043212, 'TAYLOR', 'Male', 'Engineering', 'Engineering', '/images/userpic/1509112494.jpg', 'HI IM NICK', 'Newbie', 1000, 6),
(3, 'Michelle', 'Tan', '1995-03-20', 132342531, 'SEGI', 'Female', 'Commerce', 'Business', '/images/userpic/1509112611.jpg', 'MICHELLE HERE', 'Newbie', 1000, 7),
(4, 'Michael', 'Chua', '1993-05-30', 164321243, 'SUNWAY', 'Male', 'Accounting', 'Mass Comm', '/images/userpic/1509112715.jpg', 'IM\r\nMICHAEL', 'Newbie', 1000, 8);

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
(2, 2, 1, 0),
(3, 3, 1, 0),
(4, 1, 2, 1),
(5, 3, 2, 0),
(6, 1, 3, 0),
(7, 2, 3, 0);

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
(1, 'evonmiyako.em@gmail.com', '$2y$10$4yLh25K7imlvvJHqxMnG1.ArfAe0MECI6RjPza5bA7JnaE88bfQua', 'MDudW53imSEblCR4oissy3MbDd6w4PT5xqqPIWMzj9SlvlyMCu0hGa75eCI3', 3, '2017-10-27 13:43:37', '2017-10-27 13:43:37'),
(2, 'cqes231@uowmail.edu.au', '$2y$10$RY2AmOPLQ0MGyXmcJ2wk0em2PcnYkPg4.cbzDVkH1caXLixH.47H2', 'EAIy7VroMKE7yKZtLhP3tEjlBhggl4fDKL67yn6zQ6ozGJiwqeOlD4ptePXy', 1, '2017-10-27 13:46:27', '2017-10-27 13:46:27'),
(3, 'tealive@gmail.com', '$2y$10$4C1yLF2fmo879Ox/caoeZ.8mepMqsMfaygWt6CrNsCb9uzjrJpiiW', 'eSmEkGATjkyGVlCxzbhHSU3snGziWTdyS6AhArK8Izz4vGi1WrhqibdhSh7o', 2, '2017-10-27 13:46:54', '2017-10-27 13:46:54'),
(4, 'microsoft@gmail.com', '$2y$10$MaRNXxdDwWd7UgHB0pLQTuGaXGCdQ8PDYcW3unDR0vIOfzRagMP7i', 'r14emPrnqIvlTkjm7oup9uhOwKpbBR1xVfzZ9fXsFLDgpG7ziD2mzNt55ejv', 2, '2017-10-27 13:47:22', '2017-10-27 13:47:22'),
(5, 'hnm@gmail.com', '$2y$10$8Wn6XG0Ex24VdakGmBHnS.4NoLfSggP19REQdHMXmX8Tr3Knzgwpi', 'TWKdcSK0XCdOfQcojZEgj3tXCMqb4Ty1IpuRTwEYFEdESOjKQLHkpC4HdRqx', 2, '2017-10-27 13:48:23', '2017-10-27 13:48:23'),
(6, 'nick@gmail.com', '$2y$10$FWV7yQLPOJmfRz2SXeOObu9RQ7yZ5aJgPKEHuqv7FgNrvJDp1c7Wa', 'ux3trrVIlRUKibZOo1ws2VK5r4G6aQRCyFKrgwenYzkwEmfgzgry7d5KTNir', 1, '2017-10-27 13:54:55', '2017-10-27 13:54:55'),
(7, 'michelle@gmail.com', '$2y$10$i62gZj1juQLw3XO0S0YqKecuNDk7JgUs8Y9G0a0yKETVk8Seyk6gm', 'Qe5F4oVYPeYCZc0YczXM2hGPK7Psftf3DcLkbhRDXBDnAd8UCQUB1LrphagS', 1, '2017-10-27 13:56:51', '2017-10-27 13:56:51'),
(8, 'michael@gmail.com', '$2y$10$dngFtjx6M1qmxqsV0UcPqer8DO683cAaaqKmdpHg8tTMmjM5hVDum', 'l10xwCNN04hm3HjIrUygIxshHMMkBCOufBpsua0gaYY4Fc8czetrrDnvFFYR', 1, '2017-10-27 13:58:36', '2017-10-27 13:58:36');

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
(1, 7, 3, 1),
(2, 5, 3, 2);

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
(1, 7, 1, 1),
(2, 1, 1, 2);

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
  MODIFY `commentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `companyid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `eventsnimages`
--
ALTER TABLE `eventsnimages`
  MODIFY `eventnimageid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `postcommentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `studentsnevents`
--
ALTER TABLE `studentsnevents`
  MODIFY `studentneventid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `usersneventsncomments`
--
ALTER TABLE `usersneventsncomments`
  MODIFY `commentfid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usersnpostsncomments`
--
ALTER TABLE `usersnpostsncomments`
  MODIFY `postcommentfid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
