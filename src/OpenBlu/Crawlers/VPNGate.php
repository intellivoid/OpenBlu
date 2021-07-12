<?php


    namespace OpenBlu\Crawlers;


    use Exception;
    use Objects\CrawlError;
    use OpenBlu\Abstracts\SearchMethods\UpdateRecord;
    use OpenBlu\Abstracts\Types\ResultObjectType;
    use OpenBlu\Exceptions\CrawlerException;
    use OpenBlu\Exceptions\DatabaseException;
    use OpenBlu\Exceptions\InvalidSearchMethodException;
    use OpenBlu\Exceptions\SyncException;
    use OpenBlu\Exceptions\UpdateRecordNotFoundException;
    use OpenBlu\Interfaces\CrawlerInterface;
    use OpenBlu\Objects\CrawlResults;
    use OpenBlu\Objects\VPN;
    use OpenBlu\OpenBlu;
    use OpenBlu\Utilities\Converter;
    use OpenBlu\Utilities\Corrector;
    use OpenBlu\Utilities\Hashing;
    use OpenBlu\Utilities\OpenVPNConfiguration;
    use VerboseAdventure\Abstracts\EventType;

    /**
     * Class VPNGate
     *
     * This class is designed to scrape from VPNGate, parse the CSV Table and convert the OpenVPN Configuration files to
     * object-orientated resources that can be manipulated, organized and converted.
     *
     * @package OpenBlu\Crawlers
     */
    class VPNGate implements CrawlerInterface
    {
        /**
         * @var string
         */
        private string $SourceName = "VPNGate";

        /**
         * @var string
         */
        private string $SourceURL = "http://www.vpngate.net/api/iphone";

        /**
         * Syncs the database with updated information
         *
         * @param OpenBlu $openBlu
         * @return CrawlResults
         * @throws DatabaseException
         * @throws InvalidSearchMethodException
         * @throws SyncException
         * @throws UpdateRecordNotFoundException
         */
        public function crawl(OpenBlu $openBlu): CrawlResults
        {
            $CrawlResults = new CrawlResults();
            $CrawlResults->SourceName = $this->SourceName;
            $CrawlResults->TimestampBegin = time();

            $openBlu->getLog()->log(EventType::INFO, "Crawling VPNGate started", $this->SourceName);

            // Get cURL resource
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_URL, $this->SourceURL);
            curl_setopt($curl, CURLOPT_USERAGENT, 'OpenBlu/2.0 (Crawler)');
            curl_setopt($curl, CURLOPT_FAILONERROR, true);

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $this->SourceURL,
                CURLOPT_USERAGENT => 'OpenBlu/2.0 (Crawler)'
            ));

            $openBlu->getLog()->log(EventType::INFO, "Making HTTP Request to Gateway", $this->SourceName);
            $Response = curl_exec($curl);
            $Error = curl_error($curl);
            curl_close($curl);
            $openBlu->getLog()->log(EventType::INFO, "HTTP Connection Closed", $this->SourceName);

            if($Error)
            {
                $crawlerException = new CrawlerException($Error);
                $openBlu->getLog()->log(EventType::ERROR, "HTTP Error: " . $Error, $this->SourceName);
                $openBlu->getLog()->logException($crawlerException, $this->SourceName);

                throw $crawlerException;
            }

            $PublicID = Hashing::calculateUpdateRecordPublicID($Response);
            $RecordFile = $this->writeRecordFile($openBlu->getRecordDirectoryConfiguration()['TemporaryDirectory'], $PublicID, $Response);

            $openBlu->getLog()->log(EventType::VERBOSE, "Record Hash: $PublicID", $this->SourceName);
            $openBlu->getLog()->log(EventType::VERBOSE, "Record File: $RecordFile", $this->SourceName);

            try
            {
                $openBlu->getRecordManager()->getRecord(UpdateRecord::byPublicID, $PublicID);
                //return;
            }
            catch(UpdateRecordNotFoundException)
            {
                $openBlu->getRecordManager()->createRecord($Response);
            }

            $openBlu->getLog()->log(EventType::INFO, "Importing CSV to Database", $this->SourceName);

            $CrawlResults = $this->importCSV($openBlu, $CrawlResults, $RecordFile);
            $CrawlResults->TimestampEnd = time();
            $CrawlResults->updateValues();

            $openBlu->getLog()->log(EventType::INFO, "Crawling VPNGate ended", $this->SourceName);

            return $CrawlResults;
        }

        /**
         * Writes the record file to disk
         *
         * @param string $location
         * @param string $publicId
         * @param string $data
         * @return string
         */
        private function writeRecordFile(string $location, string $publicId, string $data): string
        {
            $RecordFile = $location . DIRECTORY_SEPARATOR . $publicId . '.csv';

            if(file_exists($RecordFile) == false)
                file_put_contents($RecordFile, $data);

            return $RecordFile;
        }

        /**
         * Imports contents of a CSV file to the database
         *
         * @param OpenBlu $openBlu
         * @param CrawlResults $crawlResults
         * @param string $recordFile
         * @return CrawlResults
         */
        private function importCSV(OpenBlu $openBlu, CrawlResults $crawlResults, string $recordFile): CrawlResults
        {
            if(($handle = fopen($recordFile, 'r')) !== false)
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

                            $openBlu->getLog()->log(EventType::VERBOSE, "Processing server " . $VPNObject->IP . " (" . $VPNObject->HostName . ")", $this->SourceName);

                            try
                            {
                                $openBlu->getVPNManager()->syncVPN($VPNObject);
                                $crawlResults->Results[] = $VPNObject->toArray();
                            }
                            catch(Exception $e)
                            {
                                $CrawlError = new CrawlError();
                                $CrawlError->Message = "There was an error while trying to import the object into the database";
                                $CrawlError->ExceptionRepresentation = Converter::exceptionToArray($e);
                                $CrawlError->Details = $e->getMessage();
                                $openBlu->getLog()->log(EventType::WARNING, "There was an error while trying to process " . $VPNObject->IP, $this->SourceName);

                                $crawlResults->Errors[] = $CrawlError->toArray();
                            }
                        }
                    }

                    unset($data);
                    $LineCounter += 1;
                }

                fclose($handle);
                $openBlu->getLog()->log(EventType::INFO, "File imported successfully", $this->SourceName);

                $openBlu->getLog()->log(EventType::INFO, "Deleting '$recordFile'", $this->SourceName);
                unlink($recordFile);
            }

            $crawlResults->ResultObjectType = ResultObjectType::OpenVpnRecord;
            return $crawlResults;
        }

        /**
         * @return string
         */
        public function getSourceName(): string
        {
            return $this->SourceName;
        }

        /**
         * @return string
         */
        public function getSourceURL(): string
        {
            return $this->SourceURL;
        }
    }