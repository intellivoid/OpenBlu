CREATE TABLE vpn_analytics
(
    id INT(255) PRIMARY KEY COMMENT 'The ID of the Analytical Record' AUTO_INCREMENT,
    public_id VARCHAR(255) COMMENT 'The public ID of this record',
    name VARCHAR(255) COMMENT 'The unique name for this analytical record',
    this_month BLOB COMMENT 'The usage data for each day of the month',
    last_month BLOB COMMENT 'The usage data for each day of the last month',
    today BLOB COMMENT 'The usage data from the last 24 hours',
    yesterday BLOB COMMENT 'The usage data for the last 24 hours from yesterday',
    creation_timestamp INT(255) COMMENT 'The Unix Timestamp that this record was created',
    last_updated INT(255) COMMENT 'The Unix Timestamp this this record was last updated'
);
CREATE UNIQUE INDEX vpn_analytics_id_uindex ON vpn_analytics (id);
ALTER TABLE vpn_analytics COMMENT = 'Table for tracking analytical data';