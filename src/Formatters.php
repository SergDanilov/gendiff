<?php

namespace Differ\Formatters;

use function Differ\Formatters\Plain\plain;
use function Differ\Formatters\Json\json;
use function Differ\Formatters\Stylish\stylish;

function format(mixed $tree, string $formatName)
{
    switch ($formatName) {
        case "stylish":
            return stylish($tree);
        case "plain":
            return  plain($tree);
        case "json":
            return  json($tree);
        default:
            throw new \Exception("Unknown format type: {$formatName}");
    }
}
