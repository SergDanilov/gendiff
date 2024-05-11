<?php

namespace Differ\Formatters;

use Differ\Formatters;

function format(mixed $tree, string $formatName)
{
    switch ($formatName) {
        case "stylish":
            return Stylish\render($tree);
        case "plain":
            return  Plain\render($tree);
        case "json":
            return  Json\render($tree);
        default:
            throw new \Exception("Unknown format type: {$formatName}");
    }
}
