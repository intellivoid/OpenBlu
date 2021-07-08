<?php


    namespace OpenBlu\Utilities;


    use Exception;

    /**
     * Class Converter
     * @package OpenBlu\Utilities
     */
    class Converter
    {
        /**
         * Converts the exception dump to an array
         *
         * @param Exception $exception
         * @return array
         * @noinspection PhpPureAttributeCanBeAddedInspection
         */
        public static function exceptionToArray(Exception $exception): array
        {
            $Exceptions = [];
            $current_exception = $exception;

            while(true)
            {
                $exception_array = [];

                $exception_array["file"] = $current_exception->getFile();
                $exception_array["line"] = $current_exception->getLine();
                $exception_array["code"] = $current_exception->getCode();
                $exception_array["message"] = $current_exception->getMessage();
                $exception_array["trace"] = $current_exception->getTrace();
                $exception_array["trace_string"] = $current_exception->getTraceAsString();
                $Exceptions[] = $exception_array;

                if($current_exception->getPrevious() == null)
                {
                    break;
                }

                $current_exception = $current_exception->getPrevious();
            }

            return $Exceptions;
        }

    }