<?php
/*
 *   @author Klaas Eikelboom  <klaas.eikelboom@civicoop.org>
 *   @date 29-Apr-2021
 *   @license  AGPL-3.0
 */
namespace Civi\Cmrf;

use Civi;
use CMRF\Connection\Curl;
use CMRF\Connection\Local;
use CMRF\Core\Core as AbstractCore;
use CMRF\PersistenceLayer\SQLPersistingCallFactory as CallFactory;

class Core extends AbstractCore{

  protected $connections = [];

  public function __construct() {
    $table_name = "civicrm_cmrf_api_call";
    $db = parse_url(CIVICRM_DSN);
    $conn       = new \mysqli($db['host'], $db['user'], $db['pass'], trim($db['path'],"/"), empty($db['port']) ? NULL : $db['port']);
    $factory    = new CallFactory($conn, $table_name, ['\Civi\Cmrf\Call', 'createNew'], ['\Civi\Cmrf\Call', 'createWithRecord']);
    parent::__construct($factory);
    $this->registerConnector('default');
  }

  protected function getConnection($connector_id) {
    if($connector_id=='default'){
      $connector_id=Civi::settings()->get('cmrf_default_connection') ?? 'local';
    }
    if($connector_id=='local') {
      return new Local($this,$connector_id);
    } else {
      return new Curl($this,$connector_id);
    }
  }

  public function getConnectionProfiles() {
    return [
      'prod' =>
        [  'profile' => 'prod',
           'url'      => Civi::settings()->get('cmrf_prod_rest_url'),
           'api_key'  => Civi::settings()->get('cmrf_prod_api_key'),
           'site_key' => Civi::settings()->get('cmrf_prod_sys_key'),
      ],
      'test' =>
        [  'profile' => 'test',
          'url'      => Civi::settings()->get('cmrf_test_rest_url'),
          'api_key'  => Civi::settings()->get('cmrf_test_api_key'),
          'site_key' => Civi::settings()->get('cmrf_test_sys_key'),
        ]];
  }

  public function getDefaultProfile() {
    return 'default';
  }

  public function registerConnector($connector_id, $profile = NULL) {
    // find a new ID for the connector
    $connectors   = $this->getRegisteredConnectors();
    $connectors[$connector_id] = array(
      'type'    => $connector_id,
      'profile' => $profile,
      'id'      => $connector_id
    );
    $this->storeRegisteredConnectors($connectors);

    return $connector_id;
  }

  protected function getRegisteredConnectors() {
    return ['default' => ['profile' => 'default'],
            'prod' => ['profile' => 'prod'],
            'local' => ['profile' => 'local'],
            'test'=> ['profile' =>'test']
          ];
  }

  protected function storeRegisteredConnectors($connectors) {
     $this->connections = $connectors;
  }

  protected function getSettings() {
    // TODO: Implement getSettings() method.
  }

  protected function storeSettings($settings) {
    // TODO: Implement storeSettings() method.
  }

}
