<?php
/*
 *   @author Klaas Eikelboom  <klaas.eikelboom@civicoop.org>
 *   @date 29-Apr-2021
 *   @license  AGPL-3.0
 */

namespace Civi\Cmrf;

use CMRF\Connection\Curl as AbstractConnection;
use CMRF\Core\Call;

class Connection extends AbstractConnection {

  public function queueCall(Call $call) {
    // We don't have to do anything here.
    // Except for saving the call.
    $this->core->getFactory()->update($call);
  }

}
