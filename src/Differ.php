<?php

namespace Hexlet\Code\Differ;

use function Hexlet\Code\Parsers\convert;

function getCorrectPath($path)
{
    $parts = [__DIR__, '../tests/fixtures', $path];
    return realpath(implode('/', $parts));
}
//проверяем существование файлов, парсим их, преобразуем в массив php
function getContent($file)
{
    if (file_exists($file)) {
        $fileGetContent =  file_get_contents($file);
        $fileData = convert($fileGetContent);
    } else {
        throw new \Exception("Unable to open file: '{$original}'!");
    }
    //работаем с булевыми значениями массива
    foreach ($fileData as $key => $value) {
        if (is_bool($value) === true) {
            $fileData[$key] = ($value === true) ? 'true' : 'false';
        }
    }
    return $fileData;
}
//форматируем для корректного представления в виде строки, текста..
function formatToString($result)
{
    $resStr = "{\n";
    foreach ($result as $key => $val) {
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
function genDiff($filePath1, $filePath2)
{
    //корректируем путь до файлов-фикстур
    $original = getCorrectPath($filePath1);
    $new = getCorrectPath($filePath2);
    $originalData = getContent($original);
    $newData = getContent($new);

    //сравниваем старый массив с новым
    $oldKey = [];
    foreach ($originalData as $k1 => $v1) {
        if (array_key_exists($k1, $newData)) {
            foreach ($newData as $k2 => $v2) {
                if ($k1 === $k2 && $v1 == $v2) {
                    $oldKey[] = "{$k1}: {$v1}";
                } elseif ($k1 === $k2 && $v1 != $v2) {
                    $oldKey[] = "{$k1}: {$v1}-";
                }
            }
        } else {
            $oldKey[] = "{$k1}: {$v1}-";
        }
    }
    sort($oldKey);
    $newKey = [];
    foreach ($newData as $k2 => $v2) {
        if (!array_key_exists($k2, $originalData)) {
            $newKey[] = "{$k2}: {$v2}+";
        } else {
            foreach ($originalData as $k1 => $v1) {
                if ($k1 == $k2 && $v1 != $v2) {
                    $newKey[] = "{$k1}: {$v2}+";
                }
            }
        }
    }
    sort($newKey);
    $result = array_merge($oldKey, $newKey);
    return formatToString($result);
}
