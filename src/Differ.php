<?php

namespace Hexlet\Code\Differ;

function getCorrectPath($path)
{
    $parts = [__DIR__, '../tests/fixtures', $path];
    return realpath(implode('/', $parts));
}
function genDiff($filePath1, $filePath2)
{
    $currentArr = getCorrectPath($filePath1);
    $newArr = getCorrectPath($filePath2);
    if (file_exists($currentArr)) {
        $currentArrGetContent =  file_get_contents($currentArr);
        $currentData = json_decode($currentArrGetContent, true);
        foreach ($currentData as $key => $value) {
            if (is_bool($value) === true) {
                $currentData[$key] = ($value === true) ? 'true' : 'false';
            }
        }
    } else {
        throw new \Exception("Unable to open file: '{$currentArr}'!");
    }
    if (file_exists($newArr)) {
        $newArrGetContent =  file_get_contents($newArr);
        $newData = json_decode($newArrGetContent, true);
        foreach ($newData as $key => $value) {
            if (is_bool($value) === true) {
                $newData[$key] = ($value === true) ? 'true' : 'false';
            }
        }
    } else {
        throw new \Exception("Unable to open file: '{$newArr}'!");
    }
    // print_r($currentData);
    // print_r($newData);
    $oldKey = [];
    foreach ($currentData as $k1 => $v1) {
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
    // print_r($oldKey);
    $newKey = [];
    foreach ($newData as $k2 => $v2) {
        if (!array_key_exists($k2, $currentData)) {
            $newKey[] = "{$k2}: {$v2}+";
        } else {
            foreach ($currentData as $k1 => $v1) {
                if ($k1 == $k2 && $v1 == $v2) {
                    // $newKey[] = "{$k2}: {$v2}";
                } elseif ($k1 == $k2 && $v1 != $v2) {
                    $newKey[] = "{$k1}: {$v2}+";
                }
            }
        }
    }
    sort($newKey);
    // print_r($newKey);
    $result = array_merge($oldKey, $newKey);
    // print_r($result);
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
    // print_r($resStr);
    return $resStr;
}
