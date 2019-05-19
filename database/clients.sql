create table clients
(
    id INT(255) comment 'The Client ID',
    public_id VARCHAR(255) null comment 'Public Client ID',
    account_id INT(255) null comment 'The ID of the account that this client is associated with',
    auth_expires INT(255) null comment 'Indicates when the current auth session expires',
    client_name VARCHAR(255) null comment 'The name of the Client',
    client_version VARCHAR(255) null comment 'The version of the client that''s currently established',
    client_uid VARCHAR(255) null comment 'The unique ID given by the client',
    os_name VARCHAR(255) null comment 'The name of the operating system that is running this client',
    os_version VARCHAR(255) null comment 'The version of the operating system',
    ip_address VARCHAR(255) null comment 'The IP Address that the machineis using with this client',
    last_connected_timestamp INT(255) null comment 'The Unix Timestamp of when this client has last connected',
    registered_timestamp INT(255) null comment 'The Unix Timestamp that this Client has been registered into the database'
) comment 'Table of established OpenBlu clients that are using the OpenBlu Web Application';


ALTER TABLE `clients`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `clients_id_uindex` (`id`);

ALTER TABLE `clients`
    MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'The unique ID of the VPN (Database Indexing)';
COMMIT;