<?php

namespace Hexlet\Code\Differ;

use function Hexlet\Code\Parsers\convert;
use function Hexlet\Code\Formatter\format;
use function Funct\Collection\union;

function getCorrectPath($path)
{
    $parts = [__DIR__, '../tests/fixtures', $path];
    return realpath(implode('/', $parts));
}
//проверяем существование файлов, парсим их, преобразуем в массив php
function getContent($filePath)
{
    $pathParts = pathinfo($filePath);

    $fileContent = file_get_contents($filePath);
    $parsedData = convert($fileContent, $pathParts['extension']);
    return $parsedData;
}
//построение дерева
function bildDiff($originalData, $newData)
{
    $old = get_object_vars($originalData);
    $new = get_object_vars($newData);
    $allKeys = union(array_keys($old), array_keys($new));
    sort($allKeys);
    $tree = array_map(function($key) use ($old, $new) {
        if (is_object($new[$key]) && is_object($old[$key])) {
            return [
                "key"  => $key,
                "type" => "nested",
                "children" => bildDiff($old[$key], $new[$key]),
            ];
        } elseif (!array_key_exists($key, $new)) {
            return [
                "key"  => $key,
                "type" => "deleted",
                "value" => $old[$key],
            ];
        } elseif (!array_key_exists($key, $old)) {
            return [
                "key"  => $key,
                "type" => "added",
                "value" => $new[$key],
            ];
        } elseif ($new[$key] !== $old[$key]) {
            return [
                "key"  => $key,
                "type" => "changed",
                "value" => $new[$key],
                "oldValue" => $old[$key],
            ];
        }
        return [
            "key"  => $key,
            "type" => "unchanged",
            "value" => $old[$key],
        ];
    }, $allKeys);
    
    print_r($tree);
    return $tree;
}
function genDiff($filePath1, $filePath2)
{
    //корректируем путь до файлов-фикстур
    $original = getCorrectPath($filePath1);
    $new = getCorrectPath($filePath2);
    //получаем данные
    $originalData = getContent($original);
    $newData = getContent($new);
    $result = bildDiff($originalData, $newData);
    return format($result);
}
