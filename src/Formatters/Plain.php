<?php

namespace Differ\Formatters\Plain;

function stringify(mixed $value)
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
    $result = array_map(function ($item) use ($ancestor) {
        $key = $item['key'];
        $property = ($ancestor === "") ?  $key : "{$ancestor}.{$key}";
        switch ($item['type']) {
            case "added":
                $stringedVal = stringify($item['value']);
                return "Property '{$property}' was added with value: {$stringedVal}";
            case "deleted":
                return "Property '{$property}' was removed";
            case "nested":
                return buildPlainText($item['children'], $property);
            case "changed":
                $stringedOldVal = stringify($item['oldValue']);
                $stringedVal = stringify($item['value']);
                return "Property '{$property}' was updated. From {$stringedOldVal} to {$stringedVal}";
            case "unchanged":
                break;
            default:
                throw new \Exception("Unknown item type: {$item['type']}");
        }
    }, $diff);
    $result = array_filter($result, fn($str) => !is_null($str));
    return implode("\n", $result);
}
