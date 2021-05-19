# CMRF CiviCRM

Use CiviMRF to call the api in another CiviCRM instance. This usefull to synchronize or compare contact information.

## Installation

This extension is dependend on some libraries that are not included. Install them by running

`composer install`

in the extension directory.

## Example of a remote call

You can use a remote call in the code as follows. First add

````php
$core = new  \Civi\Cmrf\Core();
$call = $core->createCall('default', 'Contact', 'get', ['id' => 1]);
$core->executeCall($call);
````

`defaults` stands for the connection. Four connections are available.

* `test` means to use the remote test system.
* `prod` is for the remote production system.
* `local` translates to a local API call
* `default` is configurable in the settings screen and can be switched between `local`, `test`, and `remote`.

This gives you the option to use `default` in your code and start with the `local` option. If everything works you can set it to a remote instance.

## Configuration

Configure the remote connections at `http(s)://<server>://civicrm/admin/setting/cmrf`. You can also access this
form from _Administration Console_. Search in the _System Settings_ for _Civi McRestFace_

## Known issues
- cleanup batches are not programmed yet
