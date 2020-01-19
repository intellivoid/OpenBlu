<?php


    namespace OpenBlu\Managers;


    use OpenBlu\OpenBlu;

    /**
     * Class UserSubscriptionManager
     * @package OpenBlu\Managers
     */
    class UserSubscriptionManager
    {
        /**
         * @var OpenBlu
         */
        private $openBlu;

        /**
         * UserSubscriptionManager constructor.
         * @param OpenBlu $openBlu
         */
        public function __construct(OpenBlu $openBlu)
        {
            $this->openBlu = $openBlu;
        }
    }