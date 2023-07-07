<?php

$updaterBase = 'https://projects.bluewindlab.net/wpplugin/zipped/plugins/';
$pluginRemoteUpdater = $updaterBase . 'bkbm/notifier_bkbm_kafvc.php';
new WpAutoUpdater(BKB_VC_ADDON_CURRENT_VERSION, $pluginRemoteUpdater, BKB_VC_ADDON_UPDATER_SLUG);
