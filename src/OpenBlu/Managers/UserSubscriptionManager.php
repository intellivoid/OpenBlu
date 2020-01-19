<?php


    namespace OpenBlu\Managers;


    use msqg\QueryBuilder;
    use OpenBlu\Abstracts\SearchMethods\UserSubscriptionSearchMethod;
    use OpenBlu\Abstracts\UserSubscriptionStatus;
    use OpenBlu\Exceptions\DatabaseException;
    use OpenBlu\Exceptions\InvalidSearchMethodException;
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

        public function getUserSubscription(string $search_method, int $value): UserSubscription
        {
            switch($search_method)
            {
                case UserSubscriptionSearchMethod::bySubscriptionID:
                case UserSubscriptionSearchMethod::byAccessRecordID:
                case UserSubscriptionSearchMethod::byAccountID:
                    $search_method = $this->openBlu->database->real_escape_string($search_method)
                    $value = (int)$value;
                    break;

                default:
                    throw new InvalidSearchMethodException();
            }

            $Query = QueryBuilder::select('user_subscriptions', [
                'id', 'account_id', 'subscription_id', 'access_record_id', 'status', 'created_timestamp'
            ], $search_method, $value);
            $QueryResults = $this->openBlu->database->query($Query);

            if($QueryResults == false)
            {
                throw new DatabaseException($this->openBlu->database->error, $Query);
            }
            else
            {
                if($QueryResults->num_rows !== 1)
                {
                    throw new VPNNotFoundException();
                }

                $Row = $QueryResults->fetch_array(MYSQLI_ASSOC);
                $Row['configuration_parameters'] = json_decode($Row['configuration_parameters'], true);
                return UserSubscription::fromArray($Row);
            }
        }
    }