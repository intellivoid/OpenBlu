<?php

    namespace OpenBlu\Managers;

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
         * Analytics constructor.
         * @param OpenBlu $openBlu
         */
        public function __construct(OpenBlu $openBlu)
        {
            $this->openBlu = $openBlu;
        }
    }