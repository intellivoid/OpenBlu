<?php
    set_time_limit(0);
    include_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'OpenBlu' . DIRECTORY_SEPARATOR . 'OpenBlu.php');

    $OpenBlu = new \OpenBlu\OpenBlu();
    $OpenBlu->getRecordManager()->sync("http://www.vpngate.net/api/iphone", true);