<?php

    namespace OpenBlu\Managers\Analytics;

    use OpenBlu\OpenBlu;

    /**
     * Class VpnUsage
     * @package OpenBlu\Managers\Analytics
     */
    class VpnUsage
    {
        /**
         * @var OpenBlu
         */
        private $openBlu;

        /**
         * VpnUsage constructor.
         * @param OpenBlu $openBlu
         */
        public function __construct(OpenBlu $openBlu)
        {
            $this->openBlu = $openBlu;
        }
    }