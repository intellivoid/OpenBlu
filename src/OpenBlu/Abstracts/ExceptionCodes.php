<?php

    namespace OpenBlu\Abstracts;

    /**
     * Class ExceptionCodes
     * @package OpenBlu\Abstracts
     */
    abstract class ExceptionCodes
    {
        const ConfigurationNotFoundException = 100;
        const DatabaseException = 101;
        const InvalidSearchMethodException = 102;
        const UpdateRecordNotFoundException = 103;
        const SyncException = 104;
        const InvalidIPAddressException = 105;
        const VPNNotFoundException = 106;
    }