<?php


    namespace OpenBlu\Crawlers\RadioBrowse;

    /**
     * Class SearchOrder
     * @package OpenBlu\Crawlers\RadioBrowse
     */
    abstract class SearchOrder
    {
        const byName = "name";

        const byUrl = "url";

        const byHomepage = "homepage";

        const byFavicon = "favicon";

        const byTags = "tags";

        const byCountry = "country";

        const byState = "state";

        const byLanguage = "language";

        const byVotes = "votes";

        const byCodec = "codec";

        const byBitrate = "bitrate";

        const byLastCheckOK = "lastcheckok";

        const byLastCheckTime = "lastchecktime";

        const byClickTimestamp = "clicktimestamp";

        const byClickCount = "clickcount";

        const byClickTrend = "clicktrend";

        const random = "random";
    }