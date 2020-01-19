create table update_records
(
    id           int(255) auto_increment comment 'The unique ID of the update record (For Database Indexing)',
    public_id    varchar(255) null comment 'The Public ID (Unique ID) of the update record',
    request_time int(255)     null comment 'The Unix Timestamp of when this record was created',
    data         mediumtext   null comment 'The data of the update record represented in CSV',
    constraint update_records_id_uindex unique (id)
) comment 'Contains a history of Update Records';
alter table update_records add primary key (id);