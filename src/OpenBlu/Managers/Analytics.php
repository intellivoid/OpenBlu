<?php

    namespace OpenBlu\Managers;

    use OpenBlu\Managers\Analytics\VpnUsage;
    use OpenBlu\OpenBlu;

    /**
     * Class Analytics
     * @package OpenBlu\Managers
     */
    class Analytics
    {
        /**
         * @var OpenBlu
         */
        private $openBlu;

        /**
         * @var VpnUsage
         */
        private $vpnUsage;

        /**
         * Analytics constructor.
         * @param OpenBlu $openBlu
         */
        public function __construct(OpenBlu $openBlu)
        {
            $this->openBlu = $openBlu;
            $this->vpnUsage = new VpnUsage($openBlu);
        }
    }