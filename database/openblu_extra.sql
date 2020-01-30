
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
