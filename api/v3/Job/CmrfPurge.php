<?php
use CRM_CmrfCivicrm_ExtensionUtil as E;
use Civi\Cmrf\Core;
/**
 * Job.CmrfPurge API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_job_cmrf_purge_spec(&$spec) {
}

/**
 * Job.CmrfPurge API
 *
 * @param array $params
 *
 * @return array
 *   API result descriptor
 *
 * @see civicrm_api3_create_success
 *
 * @throws API_Exception
 */
function civicrm_api3_job_cmrf_purge($params) {
 try{
   $core = new Core();
   $core->getFactory()->purgeCachedCalls();
   $returnValues = [];
   return civicrm_api3_create_success($returnValues, $params, 'Job', 'CmrfPurge');
 } catch (\Exception $ex) {
   throw new API_Exception($ex->getMessage(), 'cmrf_pirge');
 }
}
