-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01. Sep, 2016 03:57 a.m.
-- Server-versjon: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `northcraft`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `avatar`
--

CREATE TABLE `avatar` (
  `id` int(128) NOT NULL,
  `username` varchar(32) NOT NULL,
  `url` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `changelog`
--

CREATE TABLE `changelog` (
  `id` int(128) NOT NULL,
  `author` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `typeID` int(16) NOT NULL,
  `db` text NOT NULL,
  `note` text NOT NULL,
  `time` int(16) NOT NULL,
  `revision` int(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `faq`
--

CREATE TABLE `faq` (
  `id` int(128) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'What is World of Northcraft?', 'World of Northcraft is a 3.3.5a project developed on the Sunwell Core. \r\nSince Sunwell.pl released their work, we decided to continue its development efforts; we are steadily on our way to create a very solid and well-rounded server, especially the endgame content.'),
(2, 'What approach will World of Northcraft take?', 'We will be running a blizzlike (1x rates) method with an optional function to skip to level 68. \r\nThe content schedule will be akin to retail; progressive, and patch-by-patch.'),
(3, 'Why not start from level 1?', 'We feel that previous content (Vanilla & BC) would be a massive development undertaking and that it isn\'t in line with our development goals.\r\nOur focus is endgame, we want it to be perfect, and as such, all of our efforts are being put towards it.\r\n'),
(4, 'Estimated release date?', 'Because of the current development rate we are experiencing, a release date could be set in the near future, however, we cannot give you an estimation at this time. \r\nTo stay up to date with our development progress, and for any news or information, join our Discord Channel or keep an eye out on the forums.'),
(5, 'What makes you different from other wotlk realms?', 'We\'re a dedicated team formed out of ex-trinitycore contributors, and server developers. \r\nWe\'re passionate about wow emulation and have members with over 6 years of experience in the scene. \r\nWe\'ve already done hundreds of bug fixes since we started on 26th march 2016.\r\nAnd within that short time span our change log grew bigger than most veteran servers out there.'),
(6, 'What will be open on launch?', 'You can find a schedule for our content release [here] ( work in progress )'),
(7, 'Will the server be pay to win?', 'We\'ll not allow donations for armor/gold/weapons or anything that will allow you to get the slightest advantage over other players. \r\nWe believe that play to win and quality is what makes the game great.'),
(8, 'Where will the server be located?', 'We\'re currently developing on a OVH server located in the EU.');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `news`
--

CREATE TABLE `news` (
  `id` int(128) NOT NULL,
  `title` tinytext NOT NULL,
  `author` tinytext NOT NULL,
  `author_avatar` text NOT NULL,
  `content` text NOT NULL,
  `time` int(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `support`
--

CREATE TABLE `support` (
  `id` int(128) NOT NULL,
  `email` tinytext NOT NULL,
  `subject` tinytext NOT NULL,
  `message` text NOT NULL,
  `time` int(16) NOT NULL,
  `ip` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `changelog`
--
ALTER TABLE `changelog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `changelog`
--
ALTER TABLE `changelog`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
