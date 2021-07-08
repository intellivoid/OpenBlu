<?php

    namespace OpenBlu\Managers;
    use msqg\QueryBuilder;
    use OpenBlu\Exceptions\DatabaseException;
    use OpenBlu\Exceptions\InvalidIPAddressException;
    use OpenBlu\Exceptions\InvalidSearchMethodException;
    use OpenBlu\Exceptions\SyncException;
    use OpenBlu\Exceptions\UpdateRecordNotFoundException;
    use OpenBlu\Exceptions\VPNNotFoundException;
    use OpenBlu\Objects\UpdateRecord;
    use OpenBlu\Objects\VPN;
    use OpenBlu\OpenBlu;
    use OpenBlu\Utilities\Corrector;
    use OpenBlu\Utilities\Hashing;
    use OpenBlu\Utilities\OpenVPNConfiguration;

    /**
     * Class RecordManager
     * @package OpenBlu\Managers
     */
    class RecordManager
    {
        /**
         * @var OpenBlu
         */
        private $openBlu;

        /**
         * RecordManager constructor.
         * @param OpenBlu $openBlu
         */
        public function __construct(OpenBlu $openBlu)
        {
            $this->openBlu = $openBlu;
        }

        /**
         * Creates a new record
         *
         * @param string $data
         * @return UpdateRecord
         * @throws DatabaseException
         * @throws InvalidSearchMethodException
         * @throws UpdateRecordNotFoundException
         */
        public function createRecord(string $data): UpdateRecord
        {
            $PublicID = $this->openBlu->Database->real_escape_string(Hashing::calculateUpdateRecordPublicID($data));
            $RequestTime = (int)time();

            $Query = QueryBuilder::insert_into('update_records', array(
                'public_id' => $PublicID,
                'request_time' => $RequestTime
            ));
            $QueryResults = $this->openBlu->Database->query($Query);

            if($QueryResults == true)
            {
                return $this->getRecord(\OpenBlu\Abstracts\SearchMethods\UpdateRecord::byPublicID, $PublicID);
            }
            else
            {
                throw new DatabaseException($this->openBlu->Database->error, $Query);
            }
        }

        /**
         * Fetches an existing update record from the database
         *
         * @param string $searchMethod
         * @param string $input
         * @return UpdateRecord
         * @throws DatabaseException
         * @throws InvalidSearchMethodException
         * @throws UpdateRecordNotFoundException
         */
        public function getRecord(string $searchMethod, string $input): UpdateRecord
        {
            switch($searchMethod)
            {
                case \OpenBlu\Abstracts\SearchMethods\UpdateRecord::byPublicID:
                    $searchMethod = $this->openBlu->Database->real_escape_string($searchMethod);
                    $input = $this->openBlu->Database->real_escape_string($input);
                    break;

                case \OpenBlu\Abstracts\SearchMethods\UpdateRecord::byID:
                    $searchMethod = $this->openBlu->Database->real_escape_string($searchMethod);
                    $input = (int)$input;
                    break;

                default:
                    throw new InvalidSearchMethodException();
            }

            $Query = QueryBuilder::select('update_records', [
                'id',
                'public_id',
                'request_time'
            ], $searchMethod, $input);
            $QueryResults = $this->openBlu->Database->query($Query);

            if($QueryResults == false)
            {
                throw new DatabaseException($this->openBlu->Database->error, $Query);
            }
            else
            {
                if($QueryResults->num_rows !== 1)
                {
                    throw new UpdateRecordNotFoundException();
                }

                return UpdateRecord::fromArray($QueryResults->fetch_array(MYSQLI_ASSOC));
            }
        }


    }