<?php

use CRM_CmrfCivicrm_ExtensionUtil as E;
use Civi\Cmrf\Call;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_CmrfCivicrm_Form_ApiCalls extends CRM_Core_Form {

  public function getRows(){
    $sql = 'select * from civicrm_cmrf_api_call ';
    $subs = $clause = [];
    if($this->getSubmitValue('status')){
      $clause[] = 'status=%1';
      $subs[1] = [$this->getSubmitValue('status'),'String'];
    }
    if($this->getSubmitValue('connector_id')){
      $clause[] = 'connector_id=%2';
      $subs[2] = [$this->getSubmitValue('connector_id'),'String'];
    }
    if(!empty($clause)){
      $sql .= 'where '.implode(' and ',$clause);
    }
    $dao = CRM_Core_DAO::executeQuery($sql,$subs);
    $rows = [];
    while($dao->fetch()){
      $rows[] = [
        'cid' => $dao->cid,
        'status' => $dao->status,
        'connector_id' => $dao->connector_id,
        'request' => substr($dao->request,0,50).' ... ',
        'reply' => substr($dao->reply,0,50) . ' ... ',
        'create_date' => $dao->create_date,
      ];
    }
    return $rows;
  }

  public function setDefaultValues() {
   return ['status' => 0];
  }

  public function buildQuickForm() {
    // add form elements
    $this->add('select', 'status','Status',
      [ 0 => ts('--Select --'),
       Call::STATUS_INIT => 'Init',
       Call::STATUS_WAITING => 'Waiting',
       Call::STATUS_SENDING => 'Sending',
       Call::STATUS_DONE => 'Done',
       Call::STATUS_RETRY => 'Retry',
       Call::STATUS_FAILED => 'Failed'],
      false ,
    );
    $this->add('select', 'connector_id', 'Connector ID',
      [ 0 => ts('--Select --'),
        'default' => 'Default',
        'local' => 'Local',
        'test' => 'Test',
        'prod' => 'Production'],
      false ,
    );
    $this->addButtons([
      [
        'type' => 'submit',
        'name' => E::ts('Filter'),
        'isDefault' => TRUE,
      ],[
        'type' => 'next',
        'name' => E::ts('Clear'),
      ],
    ]);

    // export form elements
    $this->assign('rows',$this->getRows());
    parent::buildQuickForm();
  }

  public function preProcess() {
    if($this->getSubmitValue('_qf_ApiCalls_next')){
      CRM_Core_Session::singleton() ->pushUserContext(CRM_Utils_System::url('civicrm/cmrf/apicalls', 'reset=1'));
    }
  }

  public function postProcess() {
    if($this->getSubmitValue('_qf_ApiCalls_next')){
      CRM_Core_DAO::executeQuery('delete from civicrm_cmrf_api_call');
    }
    parent::postProcess();
  }

}
