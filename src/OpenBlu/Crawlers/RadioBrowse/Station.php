<?php

    /** @noinspection PhpMissingFieldTypeInspection */

    namespace OpenBlu\Crawlers\RadioBrowse;

    /**
     * Class Station
     * @package OpenBlu\Crawlers\RadioBrowse
     */
    class Station
    {
        /**
         * A globally unique identifier for the change of the station information
         *
         * @var string|null
         */
        public $ChangeUUID;

        /**
         * A globally unique identifier for the station
         *
         * @var string|null
         */
        public $StationUUID;

        /**
         * The name of the station
         *
         * @var string|null
         */
        public $Name;

        /**
         * The stream URL provided by the user
         *
         * @var string|null
         */
        public $Url;

        /**
         * An automatically "resolved" stream URL. Things resolved are playlists (M3U/PLS/ASX...),
         * HTTP redirects (Code 301/302). This link is especially usefull if you use this API from a platform
         * that is not able to do a resolve on its own (e.g. JavaScript in browser) or you just don't want to invest
         * the time in decoding playlists yourself.
         *
         * @var string|null
         */
        public $UrlResolved;

        /**
         * URL to the homepage of the stream, so you can direct the user to a page with more information
         * about the stream.
         *
         * @var string|null
         */
        public $Homepage;

        /**
         * URL to an icon or picture that represents the stream. (PNG, JPG)
         *
         * @var string|null
         */
        public $Favicon;

        /**
         * Tags of the stream with more information about it
         *
         * @var string[]
         */
        public $Tags;

        /**
         * The country that this stream is from
         *
         * @var string|null
         * @deprecated use countrycode instead, full name of the country
         */
        public $Country;

        /**
         * Official country codes as in ISO 3166-1 alpha-2
         *
         * @var string|null
         */
        public $CountryCode;

        /**
         * Full name of the entity where the station is located inside the country
         *
         * @var string|null
         */
        public $State;

        /**
         * Languages that are spoken in this stream.
         *
         * @var string[]
         */
        public $Language;

        /**
         * Number of votes for this station. This number is by server and only ever increases.
         * It will never be reset to 0.
         *
         * @var int|null
         */
        public $Votes;

        /**
         * Last time when the stream information was changed in the database
         *
         * @var null|string YYYY-MM-DD HH:mm:ss
         */
        public $LastChangeTime;

        /**
         * The codec of this stream recorded at the last check.
         *
         * @var string|null
         */
        public $Codec;

        /**
         * The bitrate of this stream recorded at the last check.
         *
         * @var int|null
         */
        public $Bitrate;

        /**
         * Mark if this stream is using HLS distribution or non-HLS.
         *
         * @var bool|null
         */
        public $HLS;

        /**
         * The current online/offline state of this stream. This is a value calculated from multiple
         * measure points in the internet. The test servers are located in different countries.
         * It is a majority vote.
         *
         * @var bool|null
         */
        public $LastCheckOK;

        /**
         * The last time when any radio-browser server checked the online state of this stream
         *
         * @var null|string YYYY-MM-DD HH:mm:ss
         */
        public $LastCheckTime;

        /**
         * The last time when the stream was checked for the online status with a positive result
         *
         * @var null|string YYYY-MM-DD HH:mm:ss
         */
        public $LastCheckOkTime;

        /**
         * The last time when this server checked the online state and the metadata of this stream
         *
         * @var null|string YYYY-MM-DD HH:mm:ss
         */
        public $LastLocalCheckTime;

        /**
         * The time of the last click recorded for this stream
         *
         * @var null|string YYYY-MM-DD HH:mm:ss
         */
        public $ClickTimestamp;

        /**
         * Clicks within the last 24 hours
         *
         * @var int|null
         */
        public $ClickCount;

        /**
         * The difference of the click counts within the last 2 days. Positive values mean an increase,
         * negative a decrease of clicks.
         *
         * @var int|null
         */
        public $ClickTrend;

        /**
         * Returns the original array structure of this object
         *
         * @return array
         * @noinspection SpellCheckingInspection
         */
        public function toArray(): array
        {
            return array(
                "changeuuid" => $this->ChangeUUID,
                "stationuuid" => $this->StationUUID,
                "name" => $this->Name,
                "url" => $this->Url,
                "url_resolved" => $this->UrlResolved,
                "homepage" => $this->Homepage,
                "favicon" => $this->Favicon,
                "tags" => implode(",", $this->Tags),
                "country" => $this->Country,
                "countrycode" => $this->CountryCode,
                "state" => $this->State,
                "language" => implode(",", $this->Language),
                "votes" => $this->Votes,
                "lastchangetime" => $this->LastChangeTime,
                "codec" => $this->Codec,
                "bitrate" => $this->Bitrate,
                "hls" => (bool)$this->HLS,
                "lastcheckok" => (bool)$this->LastCheckOK,
                "lastchecktime" => $this->LastCheckTime,
                "lastcheckoktime" => $this->LastCheckOkTime,
                "lastlocalchecktime" => $this->LastLocalCheckTime,
                "clicktimestamp" => $this->ClickTimestamp,
                "clickcount" => $this->ClickCount,
                "clicktrend" => $this->ClickTrend
            );
        }

        /**
         * Constructs object from array
         *
         * @param $data
         * @return Station
         * @noinspection SpellCheckingInspection
         */
        public static function fromArray($data): Station
        {
            $StationObject = new Station();

            if(isset($data["changeuuid"]))
            {
                $StationObject->ChangeUUID = $data["changeuuid"];
            }

            if(isset($data["stationuuid"]))
            {
                $StationObject->StationUUID = $data["stationuuid"];
            }

            if(isset($data["name"]))
            {
                $StationObject->Name = $data["name"];
            }

            if(isset($data["url"]))
            {
                $StationObject->Url = $data["url"];
            }

            if(isset($data["url_resolved"]))
            {
                $StationObject->UrlResolved = $data["url_resolved"];
            }

            if(isset($data["homepage"]))
            {
                $StationObject->Homepage = $data["homepage"];
            }

            if(isset($data["favicon"]))
            {
                $StationObject->Favicon = $data["favicon"];
            }

            if(isset($data["tags"]))
            {
                $StationObject->Tags = explode(",", $data["tags"]);
            }

            if(isset($data["country"]))
            {
                $StationObject->Country = $data["country"];
            }

            if(isset($data["country_code"]))
            {
                $StationObject->CountryCode = $data["country_code"];
            }

            if(isset($data["state"]))
            {
                $StationObject->State = $data["state"];
            }

            if(isset($data["language"]))
            {
                $StationObject->Language = explode(",", $data["language"]);
            }

            if(isset($data["votes"]))
            {
                $StationObject->Votes = $data["votes"];
            }

            if(isset($data["lastchangetime"]))
            {
                $StationObject->LastChangeTime = $data["lastchangetime"];
            }

            if(isset($data["codec"]))
            {
                $StationObject->Codec = $data["codec"];
            }

            if(isset($data["bitrate"]))
            {
                $StationObject->Bitrate = $data["bitrate"];
            }

            if(isset($data["hls"]))
            {
                $StationObject->HLS = (bool)$data["hls"];
            }

            if(isset($data["lastcheckok"]))
            {
                $StationObject->LastCheckOK = (bool)$data["lastcheckok"];
            }

            if(isset($data["lastchecktime"]))
            {
                $StationObject->LastCheckTime = $data["lastchecktime"];
            }

            if(isset($data["lastcheckoktime"]))
            {
                $StationObject->LastCheckOkTime = $data["lastcheckoktime"];
            }

            if(isset($data["lastlocalchecktime"]))
            {
                $StationObject->LastLocalCheckTime = $data["lastlocalchecktime"];
            }

            if(isset($data["clicktimestamp"]))
            {
                $StationObject->ClickTimestamp = $data["clicktimestamp"];
            }

            if(isset($data["clickcount"]))
            {
                $StationObject->ClickCount = $data["clickcount"];
            }

            if(isset($data["clicktrend"]))
            {
                $StationObject->ClickTrend = $data["clicktrend"];
            }

            return $StationObject;
        }
    }