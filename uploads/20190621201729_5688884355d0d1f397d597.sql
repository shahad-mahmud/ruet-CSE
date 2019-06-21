-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2019 at 03:49 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(512) NOT NULL,
  `author_bio` mediumtext NOT NULL,
  `author_image` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `author_bio`, `author_image`) VALUES
(3, 'শীর্ষেন্দু মুখোপাধ্যায়', 'শীর্ষেন্দু মুখোপাধ্যায় ১৯৩৫ খ্রিস্টাব্দের ২রা নভেম্বর ব্রিটিশ ভারতের বেঙ্গল প্রেসিডেন্সির অন্তর্গত ময়মনসিংহে জন্মগ্রহণ করেন, যেখানে তাঁর জীবনের প্রথম এগারো বছর কাটে। ভারত বিভাজনের সময়, তাঁর পরিবার কলকাতা চলে আসে। এই সময় রেলওয়েতে চাকুরীরত পিতার সঙ্গে তিনি অসম, পশ্চিমবঙ্গ ও বিহারের বিভিন্ন স্থানে তাঁর জীবন অতিবাহিত করেন। তিনি কোচবিহারের ভিক্টোরিয়া কলেজ থেকে মাধ্যমিক শিক্ষা সম্পন্ন করেন। পরে, কলকাতা বিশ্ববিদ্যালয় থেকে বাংলায় স্নাতকোত্তর ডিগ্রি লাভ করেন। শীর্ষেন্দু একজন বিদ্যালয়ের শিক্ষক হিসেবে তাঁর কর্মজীবন শুরু করেন। বর্তমানে তিনি আনন্দবাজার পত্রিকা ও দেশ পত্রিকার সঙ্গে জড়িত।', '20190425130759_250794325cc1950f624ad.jpeg'),
(4, 'মোহাম্মদ নাজিম উদ্দিন', 'মোহাম্মদ নাজিম উদ্দিনের বাড়ি কিশোরগঞ্জ জেলার কুলিয়ারচর উপজেলার উসমানপুর ইউনিয়নের চৌহদ্দী গ্রামে। তাঁর বাবার নাম আরব আলী এবং মায়ের নাম মিশ্রি বেগম। তাঁর স্ত্রীর নাম আবেদা খাতুন । তাঁদের দুই মেয়ে।', '20190425151419_17442472365cc1b2ab9168a.');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(512) NOT NULL,
  `book_image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `book_image`) VALUES
(2, 'পার্থিব', '20190425133632_12983681545cc19bc0a58e0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `writes`
--

CREATE TABLE `writes` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `writes`
--

INSERT INTO `writes` (`id`, `book_id`, `author_id`) VALUES
(2, 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `writes`
--
ALTER TABLE `writes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `writes`
--
ALTER TABLE `writes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
