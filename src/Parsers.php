<?php

namespace Hexlet\Code\Parsers;

use Symfony\Component\Yaml\Yaml;

function convert($currentData, $format)
{
    switch ($format) {
        case "json":
            return json_decode($currentData);
        case "yml":
            return Yaml::parse($currentData, Yaml::PARSE_OBJECT_FOR_MAP);
        case "yaml":
            return Yaml::parse($currentData, Yaml::PARSE_OBJECT_FOR_MAP);
        default:
            throw new \Exception("Wrong file extension: {$format}");
    }
}
