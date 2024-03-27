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
    foreach ($currentData as $key => $value) {
        if (is_bool($value) === true) {
            $currentData[$key] = ($value === true) ? 'true' : 'false';
        }
    }
    return $currentData;
}
