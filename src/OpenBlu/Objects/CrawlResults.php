<?php


    namespace OpenBlu\Objects;

    use Objects\CrawlError;

    /**
     * Class CrawlResults
     * @package OpenBlu\Objects
     */
    class CrawlResults
    {
        /**
         * The Unix Timestamp when the crawling began
         *
         * @var int
         */
        public int $TimestampBegin;

        /**
         * The Unix Timestamp when the crawling ended
         *
         * @var int
         */
        public int $TimestampEnd;

        /**
         * The amount of seconds elapsed for the crawling process
         *
         * @var int
         */
        public int $TimestampElapse;

        /**
         * The name of the source
         *
         * @var string
         */
        public string $SourceName;

        /**
         * The amount of successful objects that the crawler processed
         *
         * @var int
         */
        public int $SuccessCount;

        /**
         * The amount of errors raised by the crawler
         *
         * @var int
         */
        public int $ErrorCount;

        /**
         * The results object type that the array representation represents
         *
         * @var string
         */
        public string $ResultObjectType;

        /**
         * The array of results that was collected and processed into the database
         *
         * @var array
         */
        public array $Results;

        /**
         * The array of exceptions raised when processing one or more records by the crawler
         *
         * @var CrawlError[]
         */
        public array $Errors;

        /**
         * CrawlResults constructor.
         */
        public function __construct()
        {
            $this->Errors = [];
            $this->Results = [];
        }

        /**
         * Updates the value accordingly, recommended to invoke this function after altering the object or finalizing it
         */
        public function updateValues()
        {
            if(
                is_null($this->TimestampBegin) == false && $this->TimestampBegin > 0 &&
                is_null($this->TimestampEnd) == false && $this->TimestampEnd > 0
            )
            {
                $this->TimestampElapse = ($this->TimestampEnd - $this->TimestampBegin);
            }

            $this->ErrorCount = (is_array($this->Errors) ? count($this->Errors) : 0);
            $this->SuccessCount = (is_array($this->Results) ? count($this->Results) : 0);
        }

        /**
         * Returns an array representation of the results
         *
         * @return array
         */
        public function toArray(): array
        {
            $errors = [];

            foreach($this->Errors as $crawlError)
                $errors[] = $crawlError->toArray();

            return [
                "timestamp_begin" => $this->TimestampBegin,
                "timestamp_end" => $this->TimestampEnd,
                "timestamp_elapse" => $this->TimestampElapse,
                "source_name" => $this->SourceName,
                "success_count" => $this->SuccessCount,
                "error_count" => $this->ErrorCount,
                "result_object_Type" => $this->ResultObjectType,
                "results" => $this->Results,
                "errors" => $errors
            ];
        }

        /**
         * Constructs object from an array representation
         *
         * @param array $data
         * @return CrawlResults
         */
        public static function fromArray(array $data): CrawlResults
        {
            $CrawlResultsObject = new CrawlResults();

            if(isset($data["timestamp_begin"]))
                $CrawlResultsObject->TimestampBegin = $data["timestamp_begin"];

            if(isset($data["timestamp_end"]))
                $CrawlResultsObject->TimestampEnd = $data["timestamp_end"];

            if(isset($data["timestamp_elapse"]))
                $CrawlResultsObject->TimestampElapse = $data["timestamp_elapse"];

            if(isset($data["source_name"]))
                $CrawlResultsObject->SourceName = $data["source_name"];

            if(isset($data["success_count"]))
                $CrawlResultsObject->SuccessCount = $data["success_count"];

            if(isset($data["error_count"]))
                $CrawlResultsObject->ErrorCount = $data["error_count"];

            if(isset($data["results_object_type"]))
                $CrawlResultsObject->ResultObjectType = $data["results_object_type"];

            if(isset($data["results"]))
                $CrawlResultsObject->Results = $data["results"];

            if(isset($data["errors"]))
            {
                foreach($data["errors"] as $datum)
                    $CrawlResultsObject->Errors[] = CrawlError::fromArray($datum);
            }

            return $CrawlResultsObject;
        }
    }