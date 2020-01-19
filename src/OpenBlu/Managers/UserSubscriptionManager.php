<?php


    namespace OpenBlu\Managers;


    use OpenBlu\Abstracts\UserSubscriptionStatus;
    use OpenBlu\Objects\UserSubscription;
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

        public function registerUserSubscription(int $account_id, int $subscription_id, int $access_record_id): UserSubscription
        {
            $account_id = (int)$account_id;
            $subscription_id = (int)$subscription_id;
            $access_record_id = (int)$access_record_id;
            $status = (int)UserSubscriptionStatus::Active;

        }
    }