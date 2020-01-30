-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2020 at 06:21 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `openblu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `id` int(11) NOT NULL COMMENT 'Cookie ID',
  `date_creation` int(11) DEFAULT NULL COMMENT 'The unix timestamp of when the cookie was created',
  `disposed` tinyint(1) DEFAULT NULL COMMENT 'Flag for if the cookie was disposed',
  `name` varchar(255) DEFAULT NULL COMMENT 'The name of the Cookie (Public)',
  `token` varchar(255) DEFAULT NULL COMMENT 'The public token of the cookie which uniquely identifies it',
  `expires` int(11) DEFAULT NULL COMMENT 'The Unix Timestamp of when the cookie should expire',
  `ip_tied` tinyint(1) DEFAULT NULL COMMENT 'If the cookie should be strictly tied to the client''s IP Address',
  `client_ip` varchar(255) DEFAULT NULL COMMENT 'The client''s IP Address of the cookie is tied to the IP',
  `data` blob DEFAULT NULL COMMENT 'ZiProto Encoded Data associated with the cookie'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='The main database for Secured Web Sessions library';

-- --------------------------------------------------------

--
-- Table structure for table `update_records`
--

CREATE TABLE `update_records` (
  `id` int(255) NOT NULL COMMENT 'The unique ID of the update record (For Database Indexing)',
  `public_id` varchar(255) DEFAULT NULL COMMENT 'The Public ID (Unique ID) of the update record',
  `request_time` int(255) DEFAULT NULL COMMENT 'The Unix Timestamp of when this record was created',
  `data` mediumtext DEFAULT NULL COMMENT 'The data of the update record represented in CSV'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Contains a history of Update Records';

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` int(255) NOT NULL COMMENT 'Primary unique internal Database ID for this record',
  `account_id` int(255) DEFAULT NULL COMMENT 'The ID of the user''s Intellivoid Account',
  `subscription_id` int(255) DEFAULT NULL COMMENT 'The ID of the subscription that this user is associated to',
  `access_record_id` int(255) DEFAULT NULL COMMENT 'The ID of the access record ID used for the API',
  `status` int(255) DEFAULT NULL COMMENT 'The status of this user subscription',
  `created_timestamp` int(255) DEFAULT NULL COMMENT 'The Unix Timestamp of when this record was created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table of user subscriptions to keep track of the components of the IVA System';

-- --------------------------------------------------------

--
-- Table structure for table `vpns`
--

CREATE TABLE `vpns` (
  `id` int(255) NOT NULL COMMENT 'The unique ID of the VPN (Database Indexing)',
  `public_id` varchar(255) DEFAULT NULL COMMENT 'The Public ID of the VPN',
  `host_name` varchar(255) DEFAULT NULL COMMENT 'The name of the host server',
  `ip_address` varchar(255) DEFAULT NULL COMMENT 'The IP address of the OpenVPN Server',
  `score` int(255) DEFAULT NULL COMMENT 'The score (quality) of the connection',
  `ping` int(255) DEFAULT NULL COMMENT 'The speed of the ping',
  `country` varchar(255) DEFAULT NULL COMMENT 'The name of the country that this VPN is located in',
  `country_short` varchar(255) DEFAULT NULL COMMENT 'Two letters representing the name of the country',
  `sessions` int(255) DEFAULT NULL COMMENT 'The amount of sessions connected in this VPN Connection',
  `total_sessions` int(255) DEFAULT NULL COMMENT 'The total amount of sessions that this VPN Server had',
  `configuration_parameters` text DEFAULT NULL COMMENT 'Configuration parameters for this VPN',
  `certificate_authority` mediumtext DEFAULT NULL COMMENT 'The certificate authority for this VPN',
  `certificate` mediumtext DEFAULT NULL COMMENT 'The certificate data',
  `key` mediumtext DEFAULT NULL COMMENT 'RSA Private Key',
  `last_updated` int(255) DEFAULT NULL COMMENT 'The Unix Timestamp that this VPN Was last updated',
  `created` int(255) DEFAULT NULL COMMENT 'The Unix Timestamp that this VPN was created in the Database'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='All available VPNs';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sws_id_uindex` (`id`);

--
-- Indexes for table `update_records`
--
ALTER TABLE `update_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `update_records_id_uindex` (`id`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_subscriptions_id_uindex` (`id`);

--
-- Indexes for table `vpns`
--
ALTER TABLE `vpns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vpns_id_uindex` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Cookie ID';

--
-- AUTO_INCREMENT for table `update_records`
--
ALTER TABLE `update_records`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'The unique ID of the update record (For Database Indexing)';

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Primary unique internal Database ID for this record';

--
-- AUTO_INCREMENT for table `vpns`
--
ALTER TABLE `vpns`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'The unique ID of the VPN (Database Indexing)';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
