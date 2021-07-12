<?php /** @noinspection PhpUnused */

/** @noinspection PhpMissingFieldTypeInspection */

    namespace OpenBlu;

    use acm\acm;
    use acm\Objects\Schema;
    use DeepAnalytics\DeepAnalytics;
    use Exception;
    use mysqli;
    use OpenBlu\Managers\RecordManager;
    use OpenBlu\Managers\UserSubscriptionManager;
    use OpenBlu\Managers\VPNManager;
    use VerboseAdventure\VerboseAdventure;

    //include_once(__DIR__ . DIRECTORY_SEPARATOR . "AutoConfig.php");

    /**
     * Class OpenBlu
     * @package OpenBlu
     */
    class OpenBlu
    {

        /**
         * @var mysqli
         */
        public $Database;

        /**
         * @var RecordManager
         */
        private $RecordManager;

        /**
         * @var VPNManager
         */
        private $VPNManager;

        /**
         * @var acm
         */
        private $acm;

        /**
         * @var mixed
         */
        private $DatabaseConfiguration;

        /**
         * @var mixed
         */
        private $CrawlerConfiguration;

        /**
         * @var UserSubscriptionManager
         */
        private $UserSubscriptionManager;

        /**
         * @var DeepAnalytics
         */
        private $DeepAnalytics;

        /**
         * @var VerboseAdventure
         */
        private VerboseAdventure $Log;

        /**
         * OpenBlu constructor.
         * @throws Exception
         */
        public function __construct()
        {
            $this->acm = new acm(__DIR__, "OpenBlu");

            $DatabaseSchema = new Schema();
            $DatabaseSchema->setDefinition("Host", "localhost");
            $DatabaseSchema->setDefinition("Port", "3306");
            $DatabaseSchema->setDefinition("Username", "root");
            $DatabaseSchema->setDefinition("Password", "");
            $DatabaseSchema->setDefinition("Name", "openblu");

            $CrawlerSchema = new Schema();
            $CrawlerSchema->setDefinition("UserAgent", "OpenBlu/2.0 Intellivoid Technologies (WebCrawler)");
            $CrawlerSchema->setDefinition("TemporaryDirectory", "/tmp");

            $this->acm->defineSchema("Database", $DatabaseSchema);
            $this->acm->defineSchema("Crawler", $CrawlerSchema);

            $this->DatabaseConfiguration = $this->acm->getConfiguration("Database");
            $this->CrawlerConfiguration = $this->acm->getConfiguration("Crawler");

            $this->Database = new mysqli(
                $this->DatabaseConfiguration["Host"],
                $this->DatabaseConfiguration["Username"],
                $this->DatabaseConfiguration["Password"],
                $this->DatabaseConfiguration["Name"],
                $this->DatabaseConfiguration["Port"]
            );

            $this->RecordManager = new RecordManager($this);
            $this->UserSubscriptionManager = new UserSubscriptionManager($this);
            $this->VPNManager = new VPNManager($this);
            $this->DeepAnalytics = new DeepAnalytics();
            $this->Log = new VerboseAdventure("OpenBlu");
        }

        /**
         * @return RecordManager
         */
        public function getRecordManager(): RecordManager
        {
            return $this->RecordManager;
        }

        /**
         * @return VPNManager
         */
        public function getVPNManager(): VPNManager
        {
            return $this->VPNManager;
        }

        /**
         * @param string $file
         * @return string
         */
        public static function getResource(string $file): string
        {
            return(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "Resources" . DIRECTORY_SEPARATOR . $file));
        }

        /**
         * @return mixed
         * @noinspection PhpMissingReturnTypeInspection
         */
        public function getDatabaseConfiguration()
        {
            return $this->DatabaseConfiguration;
        }

        /**
         * @return acm
         */
        public function getAcm(): acm
        {
            return $this->acm;
        }

        /**
         * @return UserSubscriptionManager
         */
        public function getUserSubscriptionManager(): UserSubscriptionManager
        {
            return $this->UserSubscriptionManager;
        }

        /**
         * @return DeepAnalytics
         */
        public function getDeepAnalytics(): DeepAnalytics
        {
            return $this->DeepAnalytics;
        }

        /**
         * @return mysqli
         */
        public function getDatabase(): mysqli
        {
            return $this->Database;
        }

        /**
         * @return VerboseAdventure
         */
        public function getLog(): VerboseAdventure
        {
            return $this->Log;
        }

        /**
         * @return mixed
         */
        public function getCrawlerConfiguration(): mixed
        {
            return $this->CrawlerConfiguration;
        }
    }
