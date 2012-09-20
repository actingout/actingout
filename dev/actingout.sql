-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2012 at 05:27 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `actingout`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE IF NOT EXISTS `achievements` (
  `ach_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `game_category` varchar(255) NOT NULL,
  `ach_count` int(11) NOT NULL,
  `status` enum('Act','Guess') NOT NULL,
  PRIMARY KEY (`ach_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`ach_id`, `user_id`, `game_category`, `ach_count`, `status`) VALUES
(1, 1, '1', 4, 'Guess'),
(2, 1, '1', 1, 'Guess'),
(3, 26, '1', 2, 'Guess'),
(4, 1, '3', 1, 'Guess');

-- --------------------------------------------------------

--
-- Table structure for table `achievement_details`
--

CREATE TABLE IF NOT EXISTS `achievement_details` (
  `ach_id` int(11) NOT NULL AUTO_INCREMENT,
  `ach_name` varchar(255) NOT NULL,
  `ach_desc` text NOT NULL,
  `earned` enum('True','False') NOT NULL,
  `applies_for` enum('Guess','Act') NOT NULL,
  `in_row` enum('Yes','No') NOT NULL,
  `category` varchar(255) NOT NULL,
  `ach_con` int(11) NOT NULL,
  PRIMARY KEY (`ach_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `achievement_details`
--

INSERT INTO `achievement_details` (`ach_id`, `ach_name`, `ach_desc`, `earned`, `applies_for`, `in_row`, `category`, `ach_con`) VALUES
(1, 'Break a Leg', '', 'False', 'Guess', 'Yes', 'Any', 5),
(2, 'Act The Part', '', 'False', 'Guess', 'Yes', 'Any', 10),
(3, 'Got My Act Together', '', 'False', 'Guess', 'Yes', 'Any', 25),
(4, 'Keeping Up The Act', '', 'False', 'Guess', 'Yes', 'Any', 50),
(5, 'Tough Act To Follow', '', 'False', 'Guess', 'Yes', 'Any', 100),
(6, 'Best Director', '', 'False', 'Guess', 'Yes', 'Any', 150),
(7, 'Best Picture', '', 'False', 'Guess', 'Yes', 'Any', 200),
(8, 'Get in on the Act', '', 'False', 'Guess', 'No', 'Any', 1),
(9, 'TV Extra', '', 'False', 'Guess', 'No', 'Any', 5),
(10, 'Movie Extra', '', 'False', 'Guess', 'No', 'Any', 10),
(11, 'Stunt Double', '', 'False', 'Guess', 'No', 'Any', 25),
(12, 'Bit Player', '', 'False', 'Guess', 'No', 'Any', 50),
(13, 'Fan Favorite', '', 'False', 'Guess', 'No', 'Any', 100),
(14, 'Best Supporting Role', '', 'False', 'Guess', 'No', 'Any', 150),
(15, 'Best Actor/Actress', '', 'False', 'Guess', 'No', 'Any', 200),
(16, 'Where s My Ark?', '', 'False', 'Guess', 'No', 'Animals', 10),
(17, 'Groupie', '', 'False', 'Guess', 'No', 'Characters', 10),
(18, 'Where s My Popcorn?', '', 'False', 'Guess', 'No', 'Movies', 10),
(19, 'Sports Buff', '', 'False', 'Guess', 'No', 'Sports', 10),
(20, 'Roadie', '', 'False', 'Guess', 'No', 'Music', 10),
(21, 'Best in Show', '', 'False', 'Guess', 'No', 'Animals', 25),
(22, 'Celebrity Stalker', '', 'False', 'Guess', 'No', 'Characters', 25),
(23, 'TV Star', '', 'False', 'Guess', 'No', 'Movies', 25),
(24, 'Sports Analyst', '', 'False', 'Guess', 'No', 'Sports', 25),
(25, 'Tour Manager', '', 'False', 'Guess', 'No', 'Music', 25),
(26, 'King of the Jungle', '', 'False', 'Guess', 'No', 'Animals', 50),
(27, 'Paparazzi', '', 'False', 'Guess', 'No', 'Characters', 50),
(28, 'Movie Star', '', 'False', 'Guess', 'No', 'Movies', 50),
(29, 'Most Valuable Player', '', 'False', 'Guess', 'No', 'Sports', 50),
(30, 'Music Executive', '', 'False', 'Guess', 'No', 'Music', 50),
(31, 'Party Animal', '', 'False', 'Act', 'No', 'Animals', 5),
(32, 'Casting Director', '', 'False', 'Act', 'No', 'Characters', 5),
(33, 'Talent Agent', '', 'False', 'Act', 'No', 'Movies', 5),
(34, 'Team Player', '', 'False', 'Act', 'No', 'Sports', 5),
(35, 'Conductor', '', 'False', 'Act', 'No', 'Music', 5);

-- --------------------------------------------------------

--
-- Table structure for table `game_details`
--

CREATE TABLE IF NOT EXISTS `game_details` (
  `game_id` int(11) NOT NULL AUTO_INCREMENT,
  `userone_id` int(11) NOT NULL,
  `usertwo_id` int(11) NOT NULL,
  `game_points` int(11) NOT NULL,
  `game_video_url` varchar(255) NOT NULL,
  `game_status` enum('Waiting','Acting','Submitted_Act','Guessing','Submitted_Guess','Finished') NOT NULL,
  `game_round_one` int(11) NOT NULL,
  `game_round_two` int(11) NOT NULL,
  `game_time` datetime NOT NULL,
  `game_word` varchar(255) NOT NULL,
  `game_hint` varchar(255) NOT NULL,
  `game_category` varchar(255) NOT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `game_details`
--

INSERT INTO `game_details` (`game_id`, `userone_id`, `usertwo_id`, `game_points`, `game_video_url`, `game_status`, `game_round_one`, `game_round_two`, `game_time`, `game_word`, `game_hint`, `game_category`) VALUES
(1, 1, 2, 1, 'http://projects.itekk.us/actingout/videos/game10.ma', 'Acting', 7, 5, '2012-09-10 01:41:49', 'drunk', 'What you feel when you drink too much', 'Feeling'),
(4, 4, 3, 1, 'http://projects.itekk.us/actingout/videos/game4.mov', 'Acting', 2, 2, '2012-09-08 01:38:48', 'pig', 'Oinks', 'Animals'),
(5, 16, 13, 3, 'http://projects.itekk.us/actingout/videos/game5.mov', 'Acting', 3, 2, '2012-09-03 11:21:49', 'dresser', 'A chest of drawers', 'Thing'),
(6, 7, 6, 1, 'http://projects.itekk.us/actingout/videos/game6.mov', 'Submitted_Guess', 3, 3, '2012-09-05 02:13:58', 'tap', 'Clickety Feet', 'Sports'),
(9, 19, 6, 0, '', 'Waiting', 0, 0, '2012-09-05 01:52:57', '', '', ''),
(10, 7, 19, 1, 'http://projects.itekk.us/actingout/videos/game10.mov', 'Acting', 3, 1, '2012-09-05 21:13:49', 'drunk', 'What you feel when you drink too much', 'Feeling'),
(11, 7, 20, 1, 'http://projects.itekk.us/actingout/videos/game10.ma', 'Acting', 1, 1, '2012-09-07 10:59:22', 'tap', '', '11'),
(12, 7, 21, 0, '', 'Waiting', 0, 0, '2012-09-05 02:09:13', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `game_que`
--

CREATE TABLE IF NOT EXISTS `game_que` (
  `que_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `que_status` enum('Idle','Game') NOT NULL,
  `que_time` datetime NOT NULL,
  `game_count` int(11) NOT NULL,
  PRIMARY KEY (`que_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `game_que`
--

INSERT INTO `game_que` (`que_id`, `user_id`, `que_status`, `que_time`, `game_count`) VALUES
(121, 0, 'Idle', '2012-09-07 01:50:44', 0),
(30, 1, 'Idle', '2012-09-07 01:48:13', 0),
(78, 2, 'Idle', '2012-09-07 01:49:12', 0),
(44, 4, 'Idle', '2012-09-02 10:26:38', 0),
(31, 5, 'Idle', '2012-08-31 11:44:51', 0),
(110, 6, 'Idle', '2012-09-05 02:54:54', 0),
(124, 7, 'Idle', '2012-09-05 21:11:44', 0),
(55, 8, 'Idle', '2012-09-03 10:38:31', 0),
(56, 9, 'Idle', '2012-09-03 10:44:16', 0),
(57, 10, 'Idle', '2012-09-03 10:54:38', 0),
(59, 11, 'Idle', '2012-09-03 11:02:00', 0),
(72, 12, 'Idle', '2012-09-03 13:29:20', 0),
(61, 13, 'Idle', '2012-09-03 11:03:29', 0),
(62, 14, 'Idle', '2012-09-03 11:07:22', 0),
(63, 15, 'Idle', '2012-09-03 11:10:44', 0),
(64, 16, 'Idle', '2012-09-03 11:11:31', 0),
(122, 17, 'Idle', '2012-09-05 03:10:20', 0),
(79, 18, 'Idle', '2012-09-04 18:26:22', 0),
(123, 19, 'Idle', '2012-09-05 21:10:49', 0),
(100, 20, 'Idle', '2012-09-05 02:07:41', 0),
(101, 21, 'Idle', '2012-09-05 02:07:57', 0),
(102, 22, 'Idle', '2012-09-05 02:08:13', 0),
(126, 150, 'Idle', '2012-09-08 01:44:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_achievements`
--

CREATE TABLE IF NOT EXISTS `user_achievements` (
  `user_achievement_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `player_id` text NOT NULL,
  `in_a_row` int(11) NOT NULL,
  `guess` int(11) NOT NULL,
  `categories_act` text NOT NULL,
  `categories_guess` text NOT NULL,
  `achievements` text NOT NULL,
  PRIMARY KEY (`user_achievement_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `user_achievements`
--

INSERT INTO `user_achievements` (`user_achievement_id`, `user_id`, `player_id`, `in_a_row`, `guess`, `categories_act`, `categories_guess`, `achievements`) VALUES
(1, 1, 'a:1:{i:0;s:1:"1";}', 2, 41, 'a:0:{}', 'a:2:{s:7:"Feeling";i:1;i:1;i:1;}', 'a:7:{i:0;i:8;i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"9";i:5;s:2:"10";i:6;s:2:"11";}'),
(2, 2, 'a:1:{i:0;s:1:"1";}', 2, 2, 'a:0:{}', 'a:2:{s:6:"Action";s:1:"1";i:1;i:1;}', 'a:1:{i:0;i:8;}'),
(3, 4, 'a:1:{i:0;s:1:"1";}', 4, 7, 'a:0:{}', 'a:8:{s:9:"Character";s:1:"1";s:7:"Animals";i:1;s:7:"Feeling";i:1;s:6:"Sports";i:1;s:9:"Condition";i:1;s:6:"Movies";i:1;s:5:"Event";i:1;i:1;i:1;}', 'a:2:{i:0;i:8;i:1;s:1:"9";}'),
(4, 3, 'a:1:{i:0;s:1:"4";}', 0, 5, 'a:0:{}', 'a:6:{s:7:"Feeling";s:1:"1";s:6:"Movies";i:1;s:5:"Event";i:1;s:7:"Company";i:1;s:5:"Thing";i:1;s:6:"Sports";i:1;}', 'a:3:{i:0;i:8;i:1;s:1:"1";i:2;s:1:"9";}'),
(5, 6, 'a:1:{i:0;s:1:"7";}', 3, 4, 'a:1:{s:9:"Character";s:1:"1";}', 'a:4:{s:6:"Sports";i:2;s:7:"Feeling";i:1;s:9:"Condition";i:2;s:9:"Character";i:1;}', 'a:1:{i:0;s:1:"8";}'),
(6, 7, 'a:1:{i:0;s:2:"19";}', 5, 7, 'a:1:{s:6:"Sports";i:1;}', 'a:4:{s:9:"Character";i:2;s:7:"Animals";i:1;s:11:"no category";i:3;s:7:"Feeling";i:2;}', 'a:3:{i:0;i:8;i:1;s:1:"9";i:2;s:1:"1";}'),
(7, 16, 'a:1:{i:0;s:2:"13";}', 2, 2, 'a:0:{}', 'a:2:{s:7:"Animals";s:1:"1";s:5:"Thing";i:1;}', 'a:1:{i:0;i:8;}'),
(8, 13, 'a:1:{i:0;s:1:"1";}', 4, 4, 'a:0:{}', 'a:2:{s:5:"Music";s:1:"1";i:1;i:1;}', 'a:1:{i:0;i:8;}'),
(9, 19, 'a:1:{i:0;s:1:"7";}', 0, 1, 'a:0:{}', 'a:2:{s:7:"Animals";s:1:"1";s:5:"Place";i:1;}', 'a:1:{i:0;i:8;}'),
(15, 130, 'a:1:{i:0;s:1:"1";}', 1, 1, 'a:0:{}', 'a:1:{i:1;s:1:"1";}', 'a:1:{i:0;i:8;}'),
(16, 131, 'a:1:{i:0;s:1:"1";}', 1, 1, '', 'a:1:{i:1;s:1:"1";}', 'a:1:{i:0;i:8;}'),
(17, 132, 'a:1:{i:0;s:1:"1";}', 1, 1, '', 'a:1:{i:1;s:1:"1";}', 'a:1:{i:0;i:8;}'),
(18, 133, '', 0, 0, 'a:1:{i:1;s:1:"1";}', '', ''),
(19, 134, 'a:0:{}', 0, 0, 'a:1:{i:1;s:1:"1";}', 'a:0:{}', 'a:0:{}'),
(20, 135, 'a:1:{i:0;s:1:"1";}', 1, 1, 'a:1:{i:1;s:1:"1";}', 'a:1:{i:1;i:1;}', 'a:1:{i:0;s:1:"8";}'),
(10, 33, 'a:1:{i:0;s:2:"22";}', 0, 0, 'a:0:{}', 'a:1:{s:5:"Sport";i:1;}', ''),
(26, 138, 'a:1:{i:0;s:1:"1";}', 2, 2, '', 'a:1:{i:1;i:2;}', 'a:1:{i:0;i:8;}'),
(25, 136, 'a:1:{i:0;s:1:"1";}', 2, 2, 'a:0:{}', 'a:1:{i:1;i:2;}', 'a:1:{i:0;i:8;}'),
(11, 105, 'a:0:{}', 0, 0, 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(12, 110, 'a:0:{}', 0, 0, 'a:0:{}', 'a:0:{}', ''),
(13, 112, 'a:1:{i:0;s:1:"1";}', 2, 2, '', 'a:1:{i:1;i:1;}', 'a:3:{i:0;a:1:{i:0;i:8;}i:1;a:0:{}i:2;s:1:"8";}'),
(14, 113, 'a:1:{i:0;s:1:"1";}', 1, 1, '', 'a:1:{i:1;s:1:"1";}', 'a:1:{i:0;i:8;}'),
(27, 139, 'a:1:{i:0;s:1:"1";}', 1, 1, 'a:0:{}', 'a:1:{i:1;s:1:"1";}', 'a:1:{i:0;i:8;}'),
(28, 141, 'a:1:{i:0;s:1:"1";}', 1, 1, '', 'a:1:{i:1;s:1:"1";}', 'a:1:{i:0;i:8;}'),
(29, 200, 'a:1:{i:0;s:1:"1";}', 1, 1, '', 'a:1:{i:1;s:1:"1";}', 'a:1:{i:0;i:8;}');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_alternate_id` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_points` varchar(255) NOT NULL,
  `dynamite_number` int(11) NOT NULL,
  `game_type` enum('free','paid') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_alternate_id`, `user_email`, `user_password`, `user_name`, `user_points`, `dynamite_number`, `game_type`) VALUES
(1, 'USER1', 'm.varg@yahoo.com', 'test123', 'matekk', '3', 2, 'free'),
(2, 'USER2', 'inbox92118@gmail.com', 'act123', 'Rainier', '5', 9, 'free'),
(3, 'USER3', 'hari@hari.hari', '123', 'hari', '29', 8, 'free'),
(4, 'USER4', 'vaava@vaava.vaa', 'vaava', 'Vaava', '29', 2, 'free'),
(5, 'USER5', 'heyrainier@gmail.com', 'act123', 'Christopher', '0', 10, 'free'),
(6, 'USER6', 'ren@vprex.com', 'renuka', 'renuka', '15', 6, 'free'),
(7, 'USER7', 'renuka@vprex.com', 'ren', 'ren', '15', 5, 'free'),
(8, 'USER8', 'jibinpgeorge@gmail.com', 'test', 'jibin', '0', 10, 'free'),
(9, 'USER9', 'a@email.com', 'test', 'test1', '0', 10, 'free'),
(10, 'USER10', 'b@email.com', 'a', 'a', '0', 10, 'free'),
(11, 'USER11', 'c@email.com', 'c', 'c', '0', 10, 'free'),
(12, 'USER12', 'd@email.com', 'd', 'd', '0', 10, 'free'),
(13, 'USER13', 'sam@sam.sam', 'sam', 'sam', '7', 10, 'free'),
(14, 'USER14', 'e@wmail.com', 'e', 'e', '0', 10, 'free'),
(15, 'USER15', 'f@email.com', 'f', 'f', '0', 10, 'free'),
(16, 'USER16', 'g@email.com', 'g', 'g', '7', 9, 'free'),
(17, 'USER17', 'andrey_boariu@yahoo.com', '123456789', 'Andrei9011', '0', 10, 'free'),
(18, 'USER18', 'gia@brians.com', 'qqqqqq', 'Gia', '0', 10, 'free'),
(19, 'USER19', 'ren1@vprex.com', 'ren', 'ren1', '17', 6, 'free'),
(20, 'USER20', 'ren2@vprex.com', 'ren', 'ren2', '0', 10, 'free'),
(21, 'USER21', 'ren3@vprex.com', 'ren', 'ren3', '0', 10, 'free'),
(22, 'USER22', 'ren4@vprex.com', 'ren', 'ren4', '0', 10, 'free'),
(23, 'USER23', 'vlad.avdeyev1988@gmail.com', '', 'ren5', '0', 10, 'free'),
(32, 'USER32', 'test@test.com', 'test123', 'test1', '2', 5, 'free');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
