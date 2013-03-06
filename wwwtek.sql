-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2013 at 01:16 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cumb_photo`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('a3740c9fb51b24218a44cc0e4d28e95d', '::1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.97 Safari/537.22', 1362402570, '');

-- --------------------------------------------------------

--
-- Table structure for table `tek_blog`
--

CREATE TABLE IF NOT EXISTS `tek_blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `title` varchar(150) NOT NULL,
  `article` text NOT NULL,
  `article_short` text NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `allow_comments` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`),
  KEY `complete` (`featured`,`allow_comments`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `tek_blog_gallery`
--

CREATE TABLE IF NOT EXISTS `tek_blog_gallery` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `src` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `sort_key` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`image_id`),
  KEY `gallery_cat_id` (`blog_id`,`sort_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `tek_carousel`
--

CREATE TABLE IF NOT EXISTS `tek_carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `sort_key` int(11) NOT NULL,
  `href` varchar(255) NOT NULL,
  `href_text` varchar(15) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `sort_key` (`sort_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tek_carousel`
--

INSERT INTO `tek_carousel` (`id`, `src`, `alt`, `sort_key`, `href`, `href_text`, `active`) VALUES
(4, 'images/carousel/slide_1.jpg', '', 10, '', '', 1),
(5, 'images/carousel/slide_2.jpg', '', 20, '', '', 1),
(6, 'images/carousel/slide_3.jpg', '', 30, '', '', 1),
(7, 'images/carousel/slide_4.jpg', '', 40, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tek_content`
--

CREATE TABLE IF NOT EXISTS `tek_content` (
  `id` varchar(32) NOT NULL,
  `page` varchar(255) NOT NULL,
  `type` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `src` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `style` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` int(11) NOT NULL,
  KEY `id` (`id`,`editor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tek_content`
--

INSERT INTO `tek_content` (`id`, `page`, `type`, `content`, `src`, `alt`, `target`, `style`, `class`, `timestamp`, `editor`) VALUES
('promo1', 'home', 'image', '', 'images/user/camera-ico4.png', 'thisisalt', '', 'thisisstyle', 'thisisclass', '2013-03-03 15:21:30', 1),
('hero_unit', 'home', 'textarea', 'Cumberland Photography is proud to launch this website - however, it''s very much a work in progress. We are developing several areas of this site as a learning tool and it''s important to hear your feedback. If you run into any areas of the site that are confusing or seem to work incorrectly, please contact us so we can investigate! Thank you again for choosing Cumberland Photography.', '', '', '', '', '', '2013-03-04 04:42:23', 1),
('hero_link', 'home', 'link', 'Contact Us &raquo;', 'index.php/pages/contact', '', '', '', 'btn btn-primary btn-large', '2013-03-04 04:42:23', 1),
('promo_box_2', 'home', 'wysiwyg', '<h3>Best choice</h3>\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>', '', '', '', '', '', '2013-03-04 04:42:23', 1),
('promo_box_3', 'home', 'wysiwyg', '<h3>Fully Responsive</h3>\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>', '', '', '', '', '', '2013-03-04 04:42:23', 1),
('item_image_1', 'home', 'image', '', 'images/user/car.jpg', '', '', '', '', '2013-03-04 04:42:23', 1),
('item_image_2', 'home', 'image', '', 'images/user/web_app1.jpg', '', '', '', '', '2013-03-04 04:42:23', 1),
('item_image_3', 'home', 'image', '', 'images/user/mobile_app1.jpg', '', '', '', '', '2013-03-04 04:42:23', 1),
('item_link_1', 'home', 'link', 'Outdoor Photography', '#', '', '', '', '', '2013-03-04 04:42:23', 1),
('item_text_1', 'home', 'textarea', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '', '', '', '', '', '2013-03-04 04:42:23', 1),
('item_text_2', 'home', 'textarea', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '', '', '', '', '', '2013-03-04 04:42:23', 1),
('item_text_3', 'home', 'textarea', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '', '', '', '', '', '2013-03-04 04:42:23', 1),
('item_header', 'home', 'oneline', 'Latest Works', '', '', '', '', '', '2013-03-04 05:15:00', 1),
('item_link_2', 'home', 'link', 'Nature Photography', '#', '', '', '', '', '2013-03-04 05:15:00', 1),
('item_link_3', 'home', 'link', 'Product Photography', '#', '', '', '', '', '2013-03-04 05:15:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tek_events`
--

CREATE TABLE IF NOT EXISTS `tek_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `event_desc` varchar(100) NOT NULL,
  `src` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `tek_events_cat`
--

CREATE TABLE IF NOT EXISTS `tek_events_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `default` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `tek_gallery`
--

CREATE TABLE IF NOT EXISTS `tek_gallery` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_name` varchar(200) NOT NULL,
  `gallery_desc` text NOT NULL,
  `gallery_type` tinyint(4) NOT NULL,
  `gallery_key` varchar(10) NOT NULL,
  `public_key` varchar(10) NOT NULL,
  `valid_users` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `tek_gallery_img`
--

CREATE TABLE IF NOT EXISTS `tek_gallery_img` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL,
  `img_name` varchar(200) NOT NULL,
  `img_desc` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=328 ;

-- --------------------------------------------------------

--
-- Table structure for table `tek_navigator`
--

CREATE TABLE IF NOT EXISTS `tek_navigator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `href` varchar(254) NOT NULL,
  `sort_key` int(11) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '1',
  `is_sub` tinyint(1) NOT NULL DEFAULT '0',
  `sub_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `sort_key` (`sort_key`,`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `tek_navigator`
--

INSERT INTO `tek_navigator` (`id`, `name`, `href`, `sort_key`, `is_primary`, `is_sub`, `sub_id`, `type`, `active`) VALUES
(1, 'Home', 'index.php', 10, 1, 0, 0, 1, 1),
(2, 'About', 'pages/about', 30, 1, 0, 0, 1, 1),
(3, 'Services', '', 20, 1, 0, 0, 1, 1),
(4, 'Photography', '', 10, 0, 1, 3, 3, 1),
(5, 'Portrait', 'pages/portrait', 20, 0, 1, 3, 1, 1),
(6, 'Wedding', 'pages/wedding', 30, 0, 1, 3, 1, 1),
(7, '', '', 40, 0, 1, 3, 2, 1),
(8, 'Web Design', '', 50, 0, 1, 3, 3, 1),
(15, 'Portfolio', 'pages/portfolio', 40, 1, 0, 0, 1, 1),
(20, 'Gallery', 'gallery', 50, 1, 0, 0, 1, 1),
(25, 'Pricing', 'pages/pricing', 60, 1, 0, 0, 1, 1),
(30, 'Blog', 'blog', 70, 1, 0, 0, 1, 1),
(35, 'Contact', 'pages/contact', 80, 1, 0, 0, 1, 1),
(36, '<img style="height: 48px; margin-top: -10px;" src="resources/public/images/new_logo.png" />', 'index.php', 0, 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tek_products`
--

CREATE TABLE IF NOT EXISTS `tek_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `stock` tinyint(1) NOT NULL DEFAULT '1',
  `date_added` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `tek_products_cat`
--

CREATE TABLE IF NOT EXISTS `tek_products_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `sort_key` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `tek_users`
--

CREATE TABLE IF NOT EXISTS `tek_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `auth` tinyint(2) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tek_users`
--

INSERT INTO `tek_users` (`id`, `username`, `email`, `first_name`, `last_name`, `phone`, `address1`, `address2`, `city`, `state`, `zip`, `password`, `auth`) VALUES
(1, 'admin', 'kevin@ciphertek.com', 'Kevin', 'Crawley', '', '', '', '', '', '', '90fd2783a36f7d05f840e9f873c54b38', 99);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
