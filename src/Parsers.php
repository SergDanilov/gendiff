<?php

namespace Hexlet\Code\Parsers;

use Symfony\Component\Yaml\Yaml;

function convert($currentArr)
{
    if (pathinfo($currentArr, PATHINFO_EXTENSION) === 'json') {
        $currentData = json_decode($currentArr, true);
    } else {
        $currentData = Yaml::parse($currentArr);
    }
    return $currentData;
}
