<?php

namespace Differ\Formatters\Stylish;

function stringify($value, int $depth)
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
    $closingIndent = str_repeat(" ", $depth * 4);
    $strings = array_map(function ($key) use ($value, $depth) {
        $indent = str_repeat(" ", ($depth + 1) * 4);
        $stringedVal = stringify($value->$key, $depth + 1);
        return "{$indent}{$key}: {$stringedVal}";
    }, array_keys(get_object_vars($value)));

    $result = implode("\n", $strings);
    return "{\n{$result}\n{$closingIndent}}";
}

function builder($diff, int $depth = 1)
{
    $indent = str_repeat(" ", $depth * 4);
    $indentInner = str_repeat(" ", $depth * 4 - 2);
    $result = array_map(function ($item) use ($indent, $indentInner, $depth) {
        $key = $item['key'];
        switch ($item['type']) {
            case "added":
                $stringedVal = stringify($item['value'], $depth);
                return "{$indentInner}+ {$key}: {$stringedVal}";
            case "deleted":
                $stringedVal = stringify($item['value'], $depth);
                return "{$indentInner}- {$key}: {$stringedVal}";
            case "nested":
                $stringedVal = builder($item['children'], $depth + 1);
                return "{$indent}{$key}: {\n{$stringedVal}\n{$indent}}";
            case "changed":
                $stringedOldVal = stringify($item['oldValue'], $depth);
                $stringedVal = stringify($item['value'], $depth);
                return "{$indentInner}- {$key}: {$stringedOldVal}\n{$indentInner}+ {$key}: {$stringedVal}";
            case "unchanged":
                return "{$indent}{$key}: {$item['value']}";
            default:
                throw new \Exception("Unknown item type: {$item['type']}");
        }
    }, $diff);
    return implode("\n", $result);
}
function buildStr($diff): string
{
    $result = builder($diff);
    return "{\n$result\n}";
}
