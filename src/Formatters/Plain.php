<?php

namespace Hexlet\Code\Formatters\Plain;

use function Docopt\array_filter;

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
        return "'{$value}'";
    }
    $result = "[complex value]";
    return $result;
}

function buildPlainText($diff, $ancestor = "")
{
    $filteredChildren = \array_filter($diff, fn($child) => is_array($child));
    $result = array_map(function ($item) use ($ancestor) {
        $key = $item['key'];
        switch ($item['type']) {
            case "added":
                $stringedVal = stringify($item['value']);
                if ($ancestor !== "") {
                    return "Property '{$ancestor}.{$key}' was added with value: {$stringedVal}";
                } else {
                    return "Property '{$key}' was added with value: {$stringedVal}";
                }
            case "deleted":
                if ($ancestor !== "") {
                    return "Property '{$ancestor}.{$key}' was removed";
                } else {
                    return "Property '{$key}' was removed";
                }
            case "nested":
                if ($ancestor != "") {
                    $ancestor = "{$ancestor}.{$key}";
                } else {
                    $ancestor = "{$key}";
                }
                return buildPlainText($item['children'], $ancestor);
            case "changed":
                $stringedOldVal = stringify($item['oldValue']);
                $stringedVal = stringify($item['value']);
                if (isset($ancestor)) {
                    return "Property '{$ancestor}.{$key}' was updated. From {$stringedOldVal} to {$stringedVal}";
                } else {
                    return "Property '{$key}' was updated. From {$stringedOldVal} to {$stringedVal}";
                }
            case "unchanged":
                break;
            default:
                throw new \Exception("Unknown item type: {$item['type']}");
        }
    }, $filteredChildren);
    $result = \array_filter($result, fn($str) => !is_null($str));
    return implode("\n", $result);
}
