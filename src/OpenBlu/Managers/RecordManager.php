<?php

    namespace OpenBlu\Managers;
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
            $PublicID = $this->openBlu->database->real_escape_string(Hashing::calculateUpdateRecordPublicID($data));
            $RequestTime = (int)time();

            $Query = "INSERT INTO `update_records` (public_id, request_time) VALUES ('$PublicID', $RequestTime)";
            $QueryResults = $this->openBlu->database->query($Query);

            if($QueryResults == true)
            {
                return $this->getRecord(\OpenBlu\Abstracts\SearchMethods\UpdateRecord::byPublicID, $PublicID);
            }
            else
            {
                throw new DatabaseException($this->openBlu->database->error, $Query);
            }
        }

        /**
         * Fetches an existing update record from the database
         *
         * @param string $searchMethod
         * @param string|\OpenBlu\Abstracts\SearchMethods\UpdateRecord $input
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
                    $searchMethod = $this->openBlu->database->real_escape_string($searchMethod);
                    $input = "\"" . $this->openBlu->database->real_escape_string($input) . "\"";
                    break;

                case \OpenBlu\Abstracts\SearchMethods\UpdateRecord::byID:
                    $searchMethod = $this->openBlu->database->real_escape_string($searchMethod);
                    $input = (int)$input;
                    break;

                default:
                    throw new InvalidSearchMethodException();
            }

            $Query = "SELECT id, public_id, request_time FROM `update_records` WHERE $searchMethod=$input";
            $QueryResults = $this->openBlu->database->query($Query);

            if($QueryResults == false)
            {
                throw new DatabaseException($this->openBlu->database->error, $Query);
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

        /**
         * Syncs the database with updated information
         *
         * @param string $endpoint
         * @throws DatabaseException
         * @throws InvalidIPAddressException
         * @throws InvalidSearchMethodException
         * @throws SyncException
         * @throws UpdateRecordNotFoundException
         * @throws VPNNotFoundException
         */
        public function sync(string $endpoint = "http://www.vpngate.net/api/iphone")
        {
            // Get cURL resource
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_URL, $endpoint);
            curl_setopt($curl, CURLOPT_USERAGENT, 'OpenBlu/1.0 (Library)');
            curl_setopt($curl, CURLOPT_FAILONERROR, true);

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $endpoint,
                CURLOPT_USERAGENT => 'OpenBlu/1.0 (Library)'
            ));

            $Response = curl_exec($curl);
            $Error = curl_error($curl);
            curl_close($curl);

            if($Error)
            {
                throw new SyncException($Error);
            }

            $PublicID = Hashing::calculateUpdateRecordPublicID($Response);
            $RecordFile = $this->writeRecordFile($PublicID, $Response);

            try
            {
                $this->getRecord(\OpenBlu\Abstracts\SearchMethods\UpdateRecord::byPublicID, $PublicID);
                //return;
            }
            catch(UpdateRecordNotFoundException $updateRecordNotFoundException)
            {
                $this->createRecord($Response);
            }

            $Response = null; // Free up Memory

            $this->importCSV($RecordFile);
        }

        /**
         * Writes the record file to disk
         *
         * @param string $publicID
         * @param string $data
         * @return string
         */
        private function writeRecordFile(string $publicID, string $data): string
        {
            $RecordFile = null;

            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
            {
                $RecordFile = $this->openBlu->getRecordDirectoryConfiguration()['WIN_RecordDirectory'] . DIRECTORY_SEPARATOR . $publicID . '.csv';
            }
            else
            {
                $RecordFile = $this->openBlu->getRecordDirectoryConfiguration()['UNIX_RecordDirectory'] . DIRECTORY_SEPARATOR . $publicID . '.csv';
            }

            if(file_exists($RecordFile) == false)
            {
                file_put_contents($RecordFile, $data);
            }

            return $RecordFile;
        }

        /**
         * Imports contents of a CSV file to the database
         *
         * @param string $RecordFile
         * @throws DatabaseException
         * @throws InvalidSearchMethodException
         * @throws InvalidIPAddressException
         * @throws VPNNotFoundException
         */
        private function importCSV(string $RecordFile)
        {
            if(($handle = fopen($RecordFile, 'r')) !== false)
            {
                $LineCounter = 0;

                // loop through the file line-by-line
                while(($data = fgetcsv($handle)) !== false)
                {
                    if($LineCounter > 1)
                    {
                        if(isset($data[0]) == false)
                        {
                            continue;
                        }
                        elseif(isset($data[1]) == false)
                        {
                            continue;
                        }
                        elseif(isset($data[2]) == false)
                        {
                            continue;
                        }
                        elseif(isset($data[3]) == false)
                        {
                            continue;
                        }
                        elseif(isset($data[5]) == false)
                        {
                            continue;
                        }
                        elseif(isset($data[6]) == false)
                        {
                            continue;
                        }
                        elseif(isset($data[7]) == false)
                        {
                            continue;
                        }
                        elseif(isset($data[9]) == false)
                        {
                            continue;
                        }
                        elseif(isset($data[14]) == false)
                        {
                            continue;
                        }
                        else
                        {
                            $VPNObject = new VPN();
                            $Configuration = OpenVPNConfiguration::parseConfiguration(base64_decode($data[14]));

                            $VPNObject->HostName = Corrector::string($data[0]);
                            $VPNObject->IP = Corrector::string($data[1]);
                            $VPNObject->Score = Corrector::int32($data[2]);
                            $VPNObject->Ping = Corrector::int32($data[3]);
                            $VPNObject->Country = Corrector::string($data[5]);
                            $VPNObject->CountryShort = Corrector::string($data[6]);
                            $VPNObject->Sessions = Corrector::int32($data[7]);
                            $VPNObject->TotalSessions = Corrector::int32($data[9]);
                            $VPNObject->PublicID = Hashing::calculateVPNPublicID($data[1]);
                            $VPNObject->ConfigurationParameters = $Configuration['parameters'];
                            $VPNObject->CertificateAuthority = $Configuration['ca'];
                            $VPNObject->Certificate = $Configuration['cert'];
                            $VPNObject->Key = $Configuration['key'];

                            if(strlen($VPNObject->Country) == 0)
                            {
                                $VPNObject->Country = 'Unknown';
                                $VPNObject->Country = 'N/A';
                            }

                            if(strlen($VPNObject->CountryShort) == 0)
                            {
                                $VPNObject->Country = 'Unknown';
                                $VPNObject->Country = 'N/A';
                            }

                            $this->openBlu->getVPNManager()->syncVPN($VPNObject);
                        }
                    }

                    unset($data);
                    $LineCounter += 1;
                }
                fclose($handle);
            }


        }
    }