
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
