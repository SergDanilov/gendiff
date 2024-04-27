<?php

namespace Hexlet\Code\Formatters;

use function Hexlet\Code\Formatters\Stylish\buildStr;
use function Hexlet\Code\Formatters\Plain\buildPlainText;

function format($tree, $formatName)
{
    switch ($formatName) {
        case "stylish":
            $result = buildStr($tree);
            return "{\n{$result}\n}\n";
        case "plain":
            return  buildPlainText($tree);
        default:
            throw new \Exception("Unknown format type: {$formatName}");
    }
}
