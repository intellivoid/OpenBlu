create table if not exists cookies
(
    id            int auto_increment comment 'Cookie ID',
    date_creation int          null comment 'The unix timestamp of when the cookie was created',
    disposed      tinyint(1)   null comment 'Flag for if the cookie was disposed',
    name          varchar(255) null comment 'The name of the Cookie (Public)',
    token         varchar(255) null comment 'The public token of the cookie which uniquely identifies it',
    expires       int          null comment 'The Unix Timestamp of when the cookie should expire',
    ip_tied       tinyint(1)   null comment 'If the cookie should be strictly tied to the client''s IP Address',
    client_ip     varchar(255) null comment 'The client''s IP Address of the cookie is tied to the IP',
    data          blob         null comment 'ZiProto Encoded Data associated with the cookie',
    constraint cookies_token_uindex
        unique (token),
    constraint sws_id_uindex
        unique (id)
)
    comment 'The main database for Secured Web Sessions library' charset = latin1;

alter table cookies
    add primary key (id);

create table if not exists update_records
(
    id           int auto_increment comment 'The unique ID of the update record (For Database Indexing)',
    public_id    varchar(255) null comment 'The Public ID (Unique ID) of the update record',
    request_time int          null comment 'The Unix Timestamp of when this record was created',
    data         mediumtext   null comment 'The data of the update record represented in CSV',
    constraint update_records_id_uindex
        unique (id),
    constraint update_records_public_id_uindex
        unique (public_id)
)
    comment 'Contains a history of Update Records' charset = latin1;

alter table update_records
    add primary key (id);

create table if not exists user_subscriptions
(
    id                int auto_increment comment 'Primary unique internal Database ID for this record',
    account_id        int null comment 'The ID of the user''s Intellivoid Account',
    subscription_id   int null comment 'The ID of the subscription that this user is associated to',
    access_record_id  int null comment 'The ID of the access record ID used for the API',
    status            int null comment 'The status of this user subscription',
    created_timestamp int null comment 'The Unix Timestamp of when this record was created',
    constraint user_subscriptions_access_record_id_uindex
        unique (access_record_id),
    constraint user_subscriptions_account_id_uindex
        unique (account_id),
    constraint user_subscriptions_id_uindex
        unique (id)
)
    comment 'Table of user subscriptions to keep track of the components of the IVA System'
    collate = utf8mb4_general_ci;

alter table user_subscriptions
    add primary key (id);

create table if not exists vpns
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

alter table vpns
    add primary key (id);

