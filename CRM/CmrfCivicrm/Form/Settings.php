<?php

use Civi\Cmrf\Core;
use CRM_CmrfCivicrm_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_CmrfCivicrm_Form_Settings extends CRM_Core_Form {

  private $fields = [
    'cmrf_prod_sys_key',
    'cmrf_prod_api_key',
    'cmrf_prod_rest_url',
    'cmrf_test_sys_key',
    'cmrf_test_api_key',
    'cmrf_test_rest_url',
    'cmrf_default_connection',
  ];

  public function buildQuickForm() {

    $core = new Core();
    $call = $core->createCall('default', 'Contact', 'get', ['id' => 1]);
    $core->executeCall($call);

    $this->assign('call_status',$call->getStatus());
    if ($call->getStatus() == 'DONE') {
      $this->assign('display_name', print_r(reset($call->getReply()['values'])['display_name'], TRUE));
    } else {
      $this->assign('error_message',$call->getReply()['error_message']);
    }

    $this->addRadio('cmrf_default_connection','Default Connection',[
      'prod' => ts('Production'),
      'test' => ts('Test'),
      'local' => ts('Local')
    ]);

    $this->add('text','cmrf_prod_rest_url',E::ts('Rest URL'));
    $this->add('text','cmrf_prod_api_key',E::ts('Api Key'));
    $this->add('text','cmrf_prod_sys_key',E::ts('System Key'));

    $this->add('text','cmrf_test_rest_url',E::ts('Rest URL'));
    $this->add('text','cmrf_test_api_key',E::ts('Api Key'));
    $this->add('text','cmrf_test_sys_key',E::ts('System Key'));

    $this->addButtons([
      [
        'type' => 'submit',
        'name' => E::ts('Submit'),
        'isDefault' => TRUE,
      ]],
    );
    // export form elements
    parent::buildQuickForm();
  }

  public function postProcess() {
    $values = $this->exportValues();
    foreach($this->fields as $key) {
      Civi::settings()->set($key,$values[$key] ?? null);
    }
    parent::postProcess();
  }

  /**
   * @return array|mixed|NULL
   */
  function setDefaultValues() {
    parent::setDefaultValues();
    foreach($this->fields as $key) {
      $values[$key] = Civi::settings()->get($key);
    }
    $values['cmrf_default_connection'] = Civi::settings()->get('cmrf_default_connection') ?? 'local';
    return $values;
  }

}
