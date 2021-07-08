<?php

    /** @noinspection PhpUnused */

    namespace Objects;

    /**
     * Class CrawlError
     * @package Objects
     */
    class CrawlError
    {
        /**
         * The message of the error
         *
         * @var string
         */
        public string $Message;

        /**
         * Extra details of the error, used for troubleshooting
         *
         * @var string|null
         */
        public ?string $Details;

        /**
         * The array representation of the exception if any was raised.
         *
         * @var array|null
         */
        public ?array $ExceptionRepresentation;

        /**
         * Returns an array representation of the object.
         *
         * @return array
         * @noinspection PhpArrayShapeAttributeCanBeAddedInspection
         */
        public function toArray(): array
        {
            return [
                "message" => $this->Message,
                "details" => $this->Details,
                "exception_representation" => $this->ExceptionRepresentation
            ];
        }

        /**
         * Constructs object from an array representation
         *
         * @param array $data
         * @return CrawlError
         * @noinspection PhpPureAttributeCanBeAddedInspection
         */
        public static function fromArray(array $data): CrawlError
        {
            $CrawlErrorObject = new CrawlError();

            if(isset($data["message"]))
                $CrawlErrorObject->Message = $data["message"];

            if(isset($data["details"]))
                $CrawlErrorObject->Details = $data["details"];

            if(isset($data["exception_representation"]))
                $CrawlErrorObject->ExceptionRepresentation = $data["exception_representation"];

            return $CrawlErrorObject;
        }
    }