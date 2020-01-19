<?php


    namespace OpenBlu\Managers;


    use msqg\QueryBuilder;
    use OpenBlu\Abstracts\UserSubscriptionStatus;
    use OpenBlu\Exceptions\DatabaseException;
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

        /**
         * Registers a User Subscription into the database
         *
         * @param int $account_id
         * @param int $subscription_id
         * @param int $access_record_id
         * @return UserSubscription
         * @throws DatabaseException
         */
        public function registerUserSubscription(int $account_id, int $subscription_id, int $access_record_id): UserSubscription
        {
            $account_id = (int)$account_id;
            $subscription_id = (int)$subscription_id;
            $access_record_id = (int)$access_record_id;
            $status = (int)UserSubscriptionStatus::Active;
            $created_timestamp = (int)time();

            $Query = QueryBuilder::insert_into('user_subscriptions', array(
                'account_id' => $account_id,
                'subscription_id' => $subscription_id,
                'access_record_id' => $access_record_id,
                'status' => $status,
                'created_timestamp' => $created_timestamp
            ));
            $QueryResults = $this->openBlu->database->query($Query);

            if($QueryResults == true)
            {
                // TODO:: Return the user subscription object
                return null;
            }
            else
            {
                throw new DatabaseException($this->openBlu->database->error, $Query);
            }
        }

    }