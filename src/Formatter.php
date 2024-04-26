<?php

namespace Hexlet\Code\Formatter;

use function Hexlet\Code\Stylish\buildStr;

function format($tree, $format)
{
    $resStr = "";
    switch ($format) {
        case "stylish":
            $resStr = buildStr($tree);
            return "{\n{$resStr}\n}\n";
    }
    return $resStr;
}
