create table vpns
(
    id                       int(255) auto_increment comment 'The unique ID of the VPN (Database Indexing)',
    public_id                varchar(255) null comment 'The Public ID of the VPN',
    host_name                varchar(255) null comment 'The name of the host server',
    ip_address               varchar(255) null comment 'The IP address of the OpenVPN Server',
    score                    int(255)     null comment 'The score (quality) of the connection',
    ping                     int(255)     null comment 'The speed of the ping',
    country                  varchar(255) null comment 'The name of the country that this VPN is located in',
    country_short            varchar(255) null comment 'Two letters representing the name of the country',
    sessions                 int(255)     null comment 'The amount of sessions connected in this VPN Connection',
    total_sessions           int(255)     null comment 'The total amount of sessions that this VPN Server had',
    configuration_parameters text         null comment 'Configuration parameters for this VPN',
    certificate_authority    mediumtext   null comment 'The certificate authority for this VPN',
    certificate              mediumtext   null comment 'The certificate data',
    `key`                    mediumtext   null comment 'RSA Private Key',
    last_updated             int(255)     null comment 'The Unix Timestamp that this VPN Was last updated',
    created                  int(255)     null comment 'The Unix Timestamp that this VPN was created in the Database',
    constraint vpns_id_uindex unique (id)
) comment 'All available VPNs';
alter table vpns add primary key (id);

