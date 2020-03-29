create table if not exists openblu.vpns
(
    id                       int auto_increment comment 'The unique ID of the VPN (Database Indexing)',
    public_id                varchar(255) null comment 'The Public ID of the VPN',
    host_name                varchar(255) null comment 'The name of the host server',
    ip_address               varchar(255) null comment 'The IP address of the OpenVPN Server',
    score                    int          null comment 'The score (quality) of the connection',
    ping                     int          null comment 'The speed of the ping',
    country                  varchar(255) null comment 'The name of the country that this VPN is located in',
    country_short            varchar(255) null comment 'Two letters representing the name of the country',
    sessions                 int          null comment 'The amount of sessions connected in this VPN Connection',
    total_sessions           int          null comment 'The total amount of sessions that this VPN Server had',
    configuration_parameters text         null comment 'Configuration parameters for this VPN',
    certificate_authority    mediumtext   null comment 'The certificate authority for this VPN',
    certificate              mediumtext   null comment 'The certificate data',
    `key`                    mediumtext   null comment 'RSA Private Key',
    last_updated             int          null comment 'The Unix Timestamp that this VPN Was last updated',
    created                  int          null comment 'The Unix Timestamp that this VPN was created in the Database',
    constraint vpns_host_name_ip_address_uindex
        unique (host_name, ip_address),
    constraint vpns_id_uindex
        unique (id),
    constraint vpns_ip_address_uindex
        unique (ip_address),
    constraint vpns_public_id_uindex
        unique (public_id)
)
    comment 'All available VPNs' charset = latin1;

alter table openblu.vpns
    add primary key (id);

