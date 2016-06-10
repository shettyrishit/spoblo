-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2016 at 01:34 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spoblo`
--
CREATE DATABASE IF NOT EXISTS `spoblo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `spoblo`;

-- --------------------------------------------------------

--
-- Table structure for table `spoblo_academywise_gallery_master`
--

CREATE TABLE IF NOT EXISTS `spoblo_academywise_gallery_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `academy_id` int(11) NOT NULL,
  `image_path` varchar(250) NOT NULL,
  `isactive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `spoblo_academywise_gallery_master`
--

INSERT INTO `spoblo_academywise_gallery_master` (`id`, `academy_id`, `image_path`, `isactive`) VALUES
(1, 1, '../../spoblo_uploded_files/academy_gallery/academi-gallery-5732db1815d28.jpg', 1),
(2, 1, '../../spoblo_uploded_files/academy_gallery/academi-gallery-5732db181f582.jpg', 1),
(3, 1, '../../spoblo_uploded_files/academy_gallery/academi-gallery-5732db182b8d5.jpg', 1),
(4, 1, '../../spoblo_uploded_files/academy_gallery/academi-gallery-5732db183c279.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `spoblo_academywise_package_master`
--

CREATE TABLE IF NOT EXISTS `spoblo_academywise_package_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `academy_id` int(11) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `package_price` varchar(100) NOT NULL,
  `package_description` varchar(1000) NOT NULL,
  `created` date NOT NULL,
  `isactive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `spoblo_academywise_package_master`
--

INSERT INTO `spoblo_academywise_package_master` (`id`, `academy_id`, `package_name`, `package_price`, `package_description`, `created`, `isactive`) VALUES
(2, 1, 'Yearly Membership', '12500', 'Coaching +Video Analysis', '2016-05-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `spoblo_academywise_video_master`
--

CREATE TABLE IF NOT EXISTS `spoblo_academywise_video_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `academy_id` int(11) NOT NULL,
  `video_path` varchar(250) NOT NULL,
  `thumbnail` text NOT NULL,
  `isactive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `spoblo_academy_master`
--

CREATE TABLE IF NOT EXISTS `spoblo_academy_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `about_academy` varchar(5000) NOT NULL,
  `address_map` varchar(1000) NOT NULL,
  `facebook_link` varchar(500) NOT NULL,
  `city` varchar(100) NOT NULL,
  `logo_path` varchar(500) NOT NULL,
  `approved` enum('y','n') NOT NULL DEFAULT 'n',
  `created` date NOT NULL,
  `updated` date NOT NULL,
  `isactive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `spoblo_academy_master`
--

INSERT INTO `spoblo_academy_master` (`id`, `name`, `about_academy`, `address_map`, `facebook_link`, `city`, `logo_path`, `approved`, `created`, `updated`, `isactive`) VALUES
(1, 'Bayside sports ', 'Bayside Sports is a Cricket Academy that coaches Children on all the finer aspects of the game.\r\n\r\nSince our inception in 2013, we have coached over 1,500 children at our centers across Mumbai.The USP of Bayside Sports is that we focus not just on the physical aspects of the game but also on the mental or psychological approach towards Cricket.\r\n\r\nWe ensure that our students receive Motivational and Technical coaching simultaneously.', '', 'https://www.facebook.com/BaysideSports/', 'Mumbai', '../../spoblo_uploded_files/academy_logo/Bayside-sports-.jpg', 'y', '2016-05-11', '2016-05-11', 1),
(3, 'Abdul Ismail - Khar Gymkhanna', 'Abdul Ismail is a one of the finest fast bowlers Mumbai has ever produced. He had an amazing career where he got 244 wickets at an average of 18. He is a former Ranji Selector and has been coaching for more than 35 years. He has helped many players and has coached cricketers who have played for Mumbai in the Ranji trophy, As a players Ismail was a right-arm fast-medium bowler, Ismail played for Bombay between the 1969/70 and 1977/78 seasons. In his first match of the 1971â€“72 Ranji Trophy against Gujarat, Ismail had figures of 3/15 and 6/16, giving his team an innings win within two days.Later that season, Bombay registered a 284-run win in away game against Baroda, with Ismail taking 4/18 and 5/62, with Baroda being bowled out for 42 in their first innings. He finished the 1971/72 season with 56 wickets at an average of 13.98. He found success in the 1975â€“76 Ranji Trophy in which he finished as the leading wicket-taker with 38 scalps at an average of 16.In the final of that Ra', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.8496583545893!2d72.82956011490108!3d19.070346587091105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c90d96e6b9db%3A0x853aac8c04a0f8f4!2sKhar+Gym+Khana+Swimming+Pool!5e0!3m2!1sen!2sin!4v1464176925053" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>', 'https://www.facebook.com/groups/326934837352644/', 'Mumbai', '../../spoblo_uploded_files/academy_logo/Abdul-Ismail---Khar-Gymkhanna.jpg', 'y', '2016-05-23', '0000-00-00', 1),
(6, 'Khar Gymkhanna - Bharat Kunderan', 'Khar Gymkhana aims to bring the members under one roof with the aim of learning and encouraging individuals of all age groups to actively participate in sharing ideas, events, sport activities, team building and leadership.', '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15083.40406539198!2d72.8318805!3d19.0702869!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x20fdcb023fe55f28!2sKhar+Gymkhana!5e0!3m2!1sen!2sin!4v1464598526936" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>', '', 'Mumbai', '../../spoblo_uploded_files/academy_logo/Khar-Gymkhanna---Bharat-Kunderan.jpg', 'y', '2016-05-30', '2016-05-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `spoblo_coachwise_student_master`
--

CREATE TABLE IF NOT EXISTS `spoblo_coachwise_student_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `academy_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `spoblo_commentwise_photos`
--

CREATE TABLE IF NOT EXISTS `spoblo_commentwise_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commented_id` int(11) NOT NULL,
  `photo_path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `spoblo_commentwise_videos`
--

CREATE TABLE IF NOT EXISTS `spoblo_commentwise_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commented_id` int(11) NOT NULL,
  `video_path` varchar(1000) NOT NULL,
  `video_thumbnil` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `spoblo_getintouch_master`
--

CREATE TABLE IF NOT EXISTS `spoblo_getintouch_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mesaage` varchar(10000) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `spoblo_playerscomments_master`
--

CREATE TABLE IF NOT EXISTS `spoblo_playerscomments_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `spoblo_rolewise_video_master`
--

CREATE TABLE IF NOT EXISTS `spoblo_rolewise_video_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `video_name` varchar(250) NOT NULL,
  `video_description` varchar(1000) NOT NULL,
  `video_path` varchar(250) NOT NULL,
  `thumbnail` varchar(150) NOT NULL,
  `isactive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `spoblo_users`
--

CREATE TABLE IF NOT EXISTS `spoblo_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `about_user` varchar(1000) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `approved` char(1) NOT NULL,
  `academy_id` varchar(1000) NOT NULL,
  `facebook_id` varchar(250) NOT NULL,
  `created` date NOT NULL DEFAULT '0000-00-00',
  `updated` date NOT NULL DEFAULT '0000-00-00',
  `isactive` int(11) NOT NULL DEFAULT '1',
  `hash` varchar(10) DEFAULT NULL,
  `token` varchar(100) NOT NULL,
  `photo_path` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `spoblo_users`
--

INSERT INTO `spoblo_users` (`id`, `name`, `email`, `contactno`, `about_user`, `password`, `role`, `approved`, `academy_id`, `facebook_id`, `created`, `updated`, `isactive`, `hash`, `token`, `photo_path`) VALUES
(10, 'Spoblo admin', 'admin@gmail.com', '', '', 'admin', 'admin', 'y', '0', '', '2016-05-05', '0000-00-00', 1, NULL, '', ''),
(17, 'Sahil Kukreja', 'sahilkukreja99@gmail.com', '', '', 'Vko1luha', 'Coach', 'y', '6', '', '2016-05-23', '0000-00-00', 1, NULL, '', ''),
(24, 'Varun Dave', 'jhars20@yahoo.com ', '9892603539', '', 'gFPCf7Lx', 'Student', 'y', '6', '', '2016-05-30', '0000-00-00', 1, 'aQ4YtGFP', '', ''),
(25, 'Veer Shetty', 'sonalshetty@icloud.com ', '9820326969', 'Lorem ipsum dolor sit amet', 'qDJaszaW', 'Student', 'y', '6', '', '2016-05-30', '0000-00-00', 1, 'eNH1cYYr', '', ''),
(26, 'Jineet Shah', 'jineet20004@gmail.com', '9869002138', 'Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet', 'FpC5iAh0', 'Student', 'y', '6', '', '2016-05-30', '2016-06-08', 1, NULL, '', '../spoblo_uploded_files/profile_photos/profile-5757ff53dbf1b.jpg'),
(27, 'Jineet Shah', 'jineet2004@gmail.com', '', '', 'jineet2004', 'Student', 'y', '', '636608486494447', '2016-06-07', '0000-00-00', 1, '', '', ''),
(28, 'Nameless', 'name@', '9191919191', '', 'uVhxOMiJ', 'Student', 'y', '1', '', '2016-06-08', '0000-00-00', 1, 'vGYbK5fI', '', ''),
(29, 'Another test', 'shettyrishit@hotmail.com', '8041313138', '', 'tsMHuFqj', 'Student', 'y', '1', '', '2016-06-08', '0000-00-00', 1, '1YntQC9Y', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
