/*
 *   @author Klaas Eikelboom  <klaas.eikelboom@civicoop.org>
 *   @date 29-Apr-2021
 *   @license  AGPL-3.0
 */
create table civicrm_cmrf_api_call
(
    cid int unsigned auto_increment comment 'Call ID' primary key,
    status varchar(8) default 'INIT' not null comment 'Status',
    connector_id varchar(255) default '' not null comment 'Connector ID',
    request longtext null comment 'The request data sent',
    reply longtext null comment 'The reply data received',
    metadata text null comment 'Custom metadata on the request',
    request_hash varchar(255) default '' not null comment 'SHA1 hash of the request, enables quick lookups for caches',
    create_date timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP comment 'Creation timestamp of this call',
    scheduled_date timestamp null comment 'Scheduted timestamp of this call',
    reply_date timestamp null comment 'Reply timestamp of this call',
    cached_until timestamp null comment 'Cache timeout of this call',
    retry_count tinyint default 0 not null comment 'Retry counter for multiple submissions'
) comment 'CMRF CiviCRM integration API calls';

create index cmrf_by_connector on civicrm_cmrf_api_call (connector_id, status);

create index cmrf_cache_index on civicrm_cmrf_api_call (connector_id, request_hash, cached_until);

