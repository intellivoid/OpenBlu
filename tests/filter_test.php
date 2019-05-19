<?php

    use OpenBlu\Abstracts\FilterType;
    use OpenBlu\Abstracts\OrderBy;
    use OpenBlu\Abstracts\OrderDirection;
    use OpenBlu\OpenBlu;

    include_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'OpenBlu' . DIRECTORY_SEPARATOR . 'OpenBlu.php');

    $OpenBlu = new OpenBlu();
    print(json_encode($OpenBlu->getVPNManager()->filterGetServers(
        FilterType::None,
        'None',
        OrderBy::byCurrentSessions,
        OrderDirection::Ascending,
        100,
        0
    ), JSON_PRETTY_PRINT));
