<?php

namespace Hexlet\Code\Formatters\Plain;

function stringify($value)
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    if (is_null($value)) {
        return 'null';
    }

    if (is_int($value)) {
        return (string) $value;
    }

    if (is_string($value)) {
        return $value;
    }
    
    $result = "[complex value]";
    return $result;
}

function buildPlainText($diff)
{
        
        $result = array_map(function ($item) {
            $key = $item['key'];
            switch ($item['type']) {
                case "added":
                    $stringedVal = stringify($item['value']);
                    return "Property '{$key}' was added with value: '{$stringedVal}'";
                case "deleted":
                    $stringedVal = stringify($item['value']);
                    return "Property '{$key}' was removed";
                case "nested":
                    $stringedVal = buildPlainText($item['children']);
                    return "Property '{$key}' was added with value: {$stringedVal}";
                case "changed":
                    $stringedOldVal = stringify($item['oldValue']);
                    $stringedVal = stringify($item['value']);
                    return "Property '{$key}' was updated. From '{$stringedOldVal}' to '{$stringedVal}'";
                case "unchanged":
                    return "{$key}: {$item['value']}";
                default:
                    throw new \Exception("Unknown item type: {$item['type']}");
            }
        }, $diff);
        return implode("\n", $result); 
}