-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 15, 2016 at 03:57 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hetic_panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

CREATE TABLE `absences` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `date` int(64) NOT NULL,
  `course` int(11) NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `updated` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `absences`
--

INSERT INTO `absences` (`id`, `student`, `date`, `course`, `reason`, `state`, `updated`) VALUES
(2, 1, 1457910000, 2, '', 0, 1458001706);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `teacher` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `startdate` int(64) NOT NULL,
  `enddate` int(64) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `dayofweek` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `code`, `teacher`, `group`, `startdate`, `enddate`, `starttime`, `endtime`, `dayofweek`) VALUES
(1, 'Ingénierie Informatique', 'ALGO', 2, 1, 1443391200, 1465164000, 32400, 43200, 1),
(2, 'Ingénierie Informatique', 'ALGO', 2, 2, 1443391200, 1465164000, 50400, 61200, 1),
(3, 'Développement Web', 'DEVWEB', 5, 1, 1443391200, 1465164000, 50400, 61200, 1),
(4, 'Développement Web', 'DEVWEB', 5, 2, 1443391200, 1465164000, 32400, 43200, 1),
(5, 'Design Initiatique', 'DESIGN', 6, 1, 1443564000, 1465336800, 32400, 43200, 3),
(6, 'Design Initiatique', 'DESIGN', 6, 2, 1443564000, 1465336800, 50400, 61200, 3);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  `promotion` int(11) NOT NULL,
  `students` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courses` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `index`, `promotion`, `students`, `courses`) VALUES
(1, 1, 1, '', '1,3,5'),
(2, 2, 1, '1,4', '2,4,6');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `groups` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `year`, `groups`) VALUES
(1, 2019, '1,2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `permission` int(11) NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `permission`, `group`) VALUES
(1, 'jclerc', 'sha256:UTcEs4Kbcs144wfJf1D4actS8/0mopms:2cd35396f20415544a20481ce130c1892f410ad65794efba10baaa81e8c2ff1c', 'jonathan.clerc@hetic.net', 'Jonathan', 'Clerc', 1, 2),
(2, 'flepoivre', 'sha256:ZwaH9Tyw6iPfPWAhRbgrmkXFUYCAXgBd:987e7d5c42d783cc3fcf8e4e513a53eb1cc76ae72cf617add650a100ac3641fe', 'franck.lepoivre@hetic.net', 'Franck', 'Lepoivre', 2, 0),
(3, 'jpineau', 'sha256:1M7Htx008F4A0edaQXX3chWQRa3MwQ62:abc808fc3943645d4b41d96f00dae328f2bc862f227c09dbbefb93ed001e6ac4', 'pineau@hetic.net', 'Johanna', 'Pineau', 3, 0),
(4, 'bbergaglia', 'sha256:hKhgSFdZbMXGBKB1XVJ0sln8b9mIRR4M:a7f2ad6434c713e4ecbf744108d5240ccbdd936ee36caa103dfe08a4b76bb91d', 'bastien.bergaglia@hetic.net', 'Bastien', 'Bergaglia', 1, 2),
(5, 'bsimon', 'sha256:F5ikhDn+cj6vprWaPsvKezUuVhAHvKdS:7e2e5953acfb24632f49f6032342d231eb270011016fc2ed78f4998413040a86', 'bruno.simon@hetic.net', 'Bruno', 'Simon', 2, 0),
(6, 'mcharpentier', 'sha256:8boYR1I5idMcj4CzBuiInYIZTThO0Fl1:8c6b3f284add0d09918ddd4878a228d8eb6d26565c2cfdda6367522e66c77b33', 'martin.charpentier@hetic.net', 'Martin', 'Charpentier', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absences`
--
ALTER TABLE `absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
