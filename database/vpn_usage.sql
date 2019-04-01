CREATE TABLE vpn_usage
(
    id INT(255) PRIMARY KEY COMMENT 'The ID of the tracker' AUTO_INCREMENT,
    vpn_id INT(255) COMMENT 'The ID of the VPN Server that''s hosted in the database',
    total_downloads INT(255) COMMENT 'The total amount of downloads',
    downloads_this_month BLOB COMMENT 'The download dad for this month',
    downloads_last_month BLOB COMMENT 'The download data for last month',
    sessions_this_month BLOB COMMENT 'The sessions data for this month',
    sessions_last_month BLOB COMMENT 'The sessions data for last month',
    score_this_month BLOB COMMENT 'The score data for this month',
    score_last_month BLOB COMMENT 'The score data for last month'
);
CREATE UNIQUE INDEX vpn_usage_id_uindex ON vpn_usage (id);
ALTER TABLE vpn_usage COMMENT = 'Table for tracking usage for each individual VPN Server';