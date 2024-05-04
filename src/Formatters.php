<?php

namespace Differ\Formatters;

use function Differ\Formatters\Stylish\buildStr;
use function Differ\Formatters\Plain\buildPlainText;
use function Differ\Formatters\Json\toJson;

function format($tree, $formatName)
{
    switch ($formatName) {
        case "stylish":
            return buildStr($tree);
        case "plain":
            return  buildPlainText($tree);
        case "json":
            return  toJson($tree);
        default:
            throw new \Exception("Unknown format type: {$formatName}");
    }
}
