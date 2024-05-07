<?php

namespace Differ\Differ;

use Exception;

use function Differ\Parsers\convert;
use function Differ\Formatters\format;

//построение дерева
function bildDiff(object $originalData, object $newData)
{
    $old = get_object_vars($originalData);
    $new = get_object_vars($newData);
    $allKeys = array_unique(array_merge(array_keys($old), array_keys($new)));
    sort($allKeys);
    $tree = array_map(function ($key) use ($old, $new) {
        $oldKeyExist = isset($old[$key]) && is_object($old[$key]);
        $newKeyExist = isset($new[$key]) && is_object($new[$key]);
        if ($newKeyExist && $oldKeyExist) {
            return [
                "key"  => $key,
                "type" => "nested",
                "children" => bildDiff($old[$key], $new[$key])
            ];
        }
        if (!array_key_exists($key, $new)) {
            return [
                "key"  => $key,
                "type" => "deleted",
                "value" => $old[$key]
            ];
        }
        if (!array_key_exists($key, $old)) {
            return [
                "key"  => $key,
                "type" => "added",
                "value" => $new[$key]
            ];
        }
        if ($new[$key] !== $old[$key]) {
            return [
                "key"  => $key,
                "type" => "changed",
                "value" => $new[$key],
                "oldValue" => $old[$key]
            ];
        }
        return [
            "key"  => $key,
            "type" => "unchanged",
            "value" => $new[$key]
        ];
    }, $allKeys);
    return $tree;
}
//проверяем существование файлов, парсим их, преобразуем в массив
function getContent(string $filePath)
{
    if (!file_exists($filePath)) {
        throw new Exception("File $filePath is not found.");
    }
    $pathParts = pathinfo($filePath);

    $fileContent = file_get_contents($filePath);
    if (gettype($fileContent) === "string") {
        $parsedData = convert($fileContent, $pathParts["extension"]);
    } else {
        throw new Exception("File $filePath is not readable.");
    }
    return $parsedData;
}
function genDiff(string $filePath1, string $filePath2, string $formatName = "stylish")
{
    $originalData = getContent($filePath1);
    $newData = getContent($filePath2);
    $result = bildDiff($originalData, $newData);
    return format($result, $formatName);
}
