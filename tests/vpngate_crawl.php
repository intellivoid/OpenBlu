<?php

    require("ppm");
    ppm_import("net.intellivoid.openblu");

    $OpenBlu = new \OpenBlu\OpenBlu();
    $VPNGate = new \OpenBlu\Crawlers\VPNGate();
    $results = $VPNGate->crawl($OpenBlu);

    print("Success Count: " . $results->SuccessCount . PHP_EOL);
    print("Error Count: " . $results->ErrorCount . PHP_EOL);
    print("Timestamp Begin: " . $results->TimestampBegin . PHP_EOL);
    print("Timestamp End: " . $results->TimestampEnd . PHP_EOL);
    print("Timestamp Elapsed: " . $results->TimestampElapse . PHP_EOL);
