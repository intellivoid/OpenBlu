<?php

    require("ppm");
    ppm_import("net.intellivoid.openblu");

    $OpenBlu = new \OpenBlu\OpenBlu();
    print(json_encode($OpenBlu->getVPNManager()->filterGetServers(
        \OpenBlu\Abstracts\FilterType::None,
        'None',
        \OpenBlu\Abstracts\OrderBy::byCurrentSessions,
        \OpenBlu\Abstracts\OrderDirection::Ascending
    ), JSON_PRETTY_PRINT));
