<?php

    require("ppm");
    ppm_import("net.intellivoid.openblu");

    use OpenBlu\Utilities\OpenVPNConfiguration;

    // Sample data for parsing
    $sample = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "example.ovpn");

    $Configuration = OpenVPNConfiguration::parseConfiguration($sample);
    var_dump($Configuration);