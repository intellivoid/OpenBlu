
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
