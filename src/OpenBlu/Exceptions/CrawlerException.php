<?php


    namespace OpenBlu\Exceptions;


    use Exception;
    use Throwable;

    /**
     * Class CrawlerException
     * @package OpenBlu\Exceptions
     */
    class CrawlerException extends Exception
    {
        /**
         * CrawlerException constructor.
         * @param string $message
         * @param int $code
         * @param Throwable|null $previous
         * @noinspection PhpPureAttributeCanBeAddedInspection
         */
        public function __construct($message = "", $code = 0, Throwable $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }
    }