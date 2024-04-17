<?php

namespace Hexlet\Code\Formatter;

use function Hexlet\Code\Parsers\convert;

function format($tree) {
    $resStr = "{\n";
        foreach ($tree as $key => $val) {
            $str = substr($val, 0, -1);
            if ($val[-1] === '-') {
                $resStr = $resStr . " - {$str}\n";
            } elseif ($val[-1] === '+') {
                $resStr = $resStr . " + {$str}\n";
            } else {
                $resStr = $resStr . "   {$val}\n";
            }
        }
        $resStr = $resStr . "}\n";
        return $resStr;
}