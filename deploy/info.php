<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'backuppc';
$app['version'] = '1.0.1';
$app['release'] = '1';
$app['vendor'] = 'Tim Burgess';
$app['packager'] = 'Tim Burgess';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('backuppc_app_description');
$app['tooltip'] = lang('backuppc_app_tooltip');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('backuppc_app_name');
$app['category'] = lang('base_category_system');
$app['subcategory'] = lang('base_subcategory_backup');

/////////////////////////////////////////////////////////////////////////////
// Controllers
/////////////////////////////////////////////////////////////////////////////

$app['controllers']['backuppc']['title'] = lang('backuppc_app_name');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////


$app['core_requires'] = array(
    'BackupPC >= 3.2'
);

$app['core_file_manifest'] = array(
    'backuppc.php' => array('target' => '/var/clearos/base/daemon/backuppc.php'),
    'BackupPC.conf' => array(
        'target' => '/usr/clearos/sandbox/etc/httpd/conf.d/BackupPC.conf',
        'mode' => '0644',
        'config' => TRUE,
        'config_params' => 'noreplace',
    ),
);

