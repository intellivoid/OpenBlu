<?php

    namespace OpenBlu\Utilities;

    /**
     * Class OpenVPNConfiguration
     * @package OpenBlu\Utilities
     */
    class OpenVPNConfiguration
    {
        /**
         * Parses the configuration and retrieves all important values regarding the configuration
         *
         * @param string $data
         * @return array
         */
        public static function parseConfiguration(string $data): array
        {
            $data = self::stripConfiguration($data);
            $results = array(
                "parameters" => array()
            );

            preg_match_all("#<(?'tag'\s*?\b[^>]*)>(?'tagdata'.*?)<\/\b[^>]*>|^(?'param'[^\r\n]*)#ms", $data, $matches, PREG_SET_ORDER);

            foreach($matches as $index => $match)
            {
                if (isset($match['tag']) && $match['tag'] !== '')
                {
                    $results[trim($match['tag'])] = trim($match['tagdata']);
                }

                if (isset($match['param']) && $match['param'] !== '')
                {
                    $results['parameters'][] = trim($match['param']);
                }
            }

            return $results;
        }

        /**
         * Strips the configuration from empty line breaks and comments
         *
         * @param string $data
         * @return string
         */
        public static function stripConfiguration(string $data): string
        {
            // Remove comments first
            $output = preg_replace("/[#;][^\r\n]*/ms", "", $data);
            // Strip empty lines
            $output = preg_replace("/[\r\n]{2,}/ms", "\n", $output);
            return $output;
        }
    }