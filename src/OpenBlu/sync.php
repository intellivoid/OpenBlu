<?php

    /** @noinspection PhpIncludeInspection */
    require("ppm");
    \ppm\ppm::import("net.intellivoid.openblu");

    print("Syncing OpenBlu VPN" . PHP_EOL);
    $OpenBlu = new \OpenBlu\OpenBlu();
    $OpenBlu->getRecordManager()->sync("http://www.vpngate.net/api/iphone", true);