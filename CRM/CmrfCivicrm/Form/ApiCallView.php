<?php

use CRM_CmrfCivicrm_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_CmrfCivicrm_Form_ApiCallView extends CRM_Core_Form {
  public function buildQuickForm() {
    $cid=CRM_Utils_Request::retrieve('cid','Integer');
    $dao = CRM_Core_DAO::executeQuery('select * from civicrm_cmrf_api_call where cid=%1',[
      1 => [$cid,'Integer']
    ]);
    if($dao->fetch()){
      $this->assign('cid', $dao->cid);
      $this->assign('status', $dao->status);
      $this->assign('request',json_encode(json_decode($dao->request),JSON_PRETTY_PRINT));
      $this->assign('reply',json_encode(json_decode($dao->reply),JSON_PRETTY_PRINT));
    }
    $this->assign('cid', $cid);
    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => E::ts('Close'),
        'isDefault' => TRUE,
      ),
    ));

    // export form elements
    parent::buildQuickForm();
  }

  public function postProcess() {
    parent::postProcess();
  }

}
