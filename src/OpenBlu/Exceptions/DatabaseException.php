<?php

    namespace OpenBlu\Exceptions;

    use OpenBlu\Abstracts\ExceptionCodes;

    /**
     * Class DatabaseException
     * @package OpenBlu\Exceptions
     */
    class DatabaseException extends \Exception
    {
        /**
         * DatabaseException constructor.
         */
        public function __construct()
        {
            parent::__construct('There was a database error', ExceptionCodes::DatabaseException, null);
        }
    }