<?php


    namespace OpenBlu\Interfaces;


    use OpenBlu\Objects\CrawlResults;
    use OpenBlu\OpenBlu;

    /**
     * Interface CrawlerInterface
     * @package OpenBlu\Interfaces
     */
    interface CrawlerInterface
    {
        /**
         * Begins to crawl data from the source, this process may take a while depending on the source
         *
         * @param OpenBlu $openBlu
         */
        public function crawl(OpenBlu $openBlu): CrawlResults;

        /**
         * Returns the name of the source that the data is being collected from
         *
         * @return string
         */
        public function getSourceName(): string;

        /**
         * Returns the starting endpoint that the data is getting collected from
         *
         * @return string
         */
        public function getSourceURL(): string;
    }