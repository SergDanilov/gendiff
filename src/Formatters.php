<?php

namespace Hexlet\Code\Formatters;

use function Hexlet\Code\Formatters\Stylish\buildStr;
use function Hexlet\Code\Formatters\Plain\buildPlainText;

function format($tree, $formatName)
{
    switch ($formatName) {
        case "stylish":
            $resStr = buildStr($tree);
            return "{\n{$resStr}\n}\n";
        case "plain":
            $resStr = buildPlainText($tree);
            return  $resStr;
        default:
            throw new \Exception("Unknown format type: {$formatName}");
    }
}
