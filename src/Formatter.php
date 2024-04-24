<?php

namespace Hexlet\Code\Formatter;

use function Hexlet\Code\Parsers\convert;

function format($tree) {
    $resStr = buildStr($tree);
    return "{\n{$resStr}\n";
}

function stringify($value) {
    switch (gettype($value)) {
        case "boolean":
            return $value ? 'true' : 'false';
        case "NULL":
            return $value = "null";
        case "integer":
            return (string) $value;
        case "string":
            return $value;
        default:
            throw new \Exception("Unknown value type: {$value}");
    }
}

function buildStr($diff) {
    $result = array_map(function ($item) {
        $key = $item['key'];
        switch ($item['type']) {
            case "added":
                $stringedVal = stringify($item['value']);
                return " + {$key}: {$stringedVal}";
            case "deleted":
                $stringedVal = stringify($item['value']);
                return " - {$key}: {$stringedVal}";
            case "nested":
                $stringedVal = buildStr($item['children']);
                return "{$key}: {\n{$stringedVal}\n}";
            case "changed":
                $stringedOldVal = stringify($item['oldValue']);
                $stringedVal = stringify($item['value']);
                return " - {$key}: {$stringedOldVal}\n + {$key}: {$stringedVal}";
            case "unchanged":
                return "{$key}: {$item['value']}";
            default:
                throw new \Exception("Unknown item type: {$item['type']}");
        }
    }, $diff);
    return implode("\n", $result);
}