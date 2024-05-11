<?php

namespace Differ\Differ;

use Exception;

use function Differ\Parsers\convert;
use function Differ\Formatters\format;
use function Functional\sort;

function buildDiff(object $firstData, object $secondData)
{
    $first = get_object_vars($firstData);
    $second = get_object_vars($secondData);
    $allKeys = array_unique(array_merge(array_keys($first), array_keys($second)));
    $keysSorted = sort($allKeys, fn ($left, $right) => strcmp($left, $right));
    $tree = array_map(function ($key) use ($first, $second) {
        $firstKeyExist = isset($first[$key]) && is_object($first[$key]);
        $secondKeyExist = isset($second[$key]) && is_object($second[$key]);
        if ($secondKeyExist && $firstKeyExist) {
            return [
                "key"  => $key,
                "type" => "nested",
                "children" => buildDiff($first[$key], $second[$key])
            ];
        }
        if (!array_key_exists($key, $second)) {
            return [
                "key"  => $key,
                "type" => "deleted",
                "value" => $first[$key]
            ];
        }
        if (!array_key_exists($key, $first)) {
            return [
                "key"  => $key,
                "type" => "added",
                "value" => $second[$key]
            ];
        }
        if ($second[$key] !== $first[$key]) {
            return [
                "key"  => $key,
                "type" => "changed",
                "value" => $second[$key],
                "oldValue" => $first[$key]
            ];
        }
        return [
            "key"  => $key,
            "type" => "unchanged",
            "value" => $second[$key]
        ];
    }, $keysSorted);
    return $tree;
}

function getContent(string $filePath)
{
    if (!file_exists($filePath)) {
        throw new Exception("File $filePath is not found.");
    }
    $fileContent = file_get_contents($filePath);
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);

    if ($fileContent !== false) {
        $parsedData = convert($fileContent, $extension);
    } else {
        throw new Exception("File $filePath is not readable.");
    }
    return $parsedData;
}

function genDiff(string $filePath1, string $filePath2, string $formatName = "stylish")
{
    $firstData = getContent($filePath1);
    $secondData = getContent($filePath2);
    $result = buildDiff($firstData, $secondData);
    return format($result, $formatName);
}
