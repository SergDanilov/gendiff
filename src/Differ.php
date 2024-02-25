<?php

namespace Hexlet\Code\Differ;

function genDiff($filePath1, $filePath2)
{
    if (file_exists($filePath1)) {
        $file1GetContent =  file_get_contents($filePath1);
        $fileOne = json_decode($file1GetContent, true);
        foreach($fileOne as $key => $value) {
            if (is_bool($value) === true) {
                $fileOne[$key] = ($value === true) ? 'true' : 'false';
            }
        }
    } else {
        throw new \Exception("Unable to open file: '{$filePath1}'!");
    }
    if (file_exists($filePath2)) {
        $file2GetContent =  file_get_contents($filePath2);
        $fileTwo = json_decode($file2GetContent, true);
        foreach($fileTwo as $key => $value) {
            if (is_bool($value) === true) {
                $fileTwo[$key] = ($value === true) ? 'true' : 'false';
            }
        }
    } else {
        throw new \Exception("Unable to open file: '{$filePath2}'!");
    }
    // print_r($fileOne);
    // print_r($fileTwo);
    $result = "{\n";
    $resultEquals = array_intersect($fileOne, $fileTwo);
    $difference = [];
    foreach ($resultEquals as $key => $value) {
        $difference["{$key}: {$value}"] = "   ";
    }
    $result1 = array_diff($fileOne, $fileTwo);
    foreach ($result1 as $key => $value) {
        $difference["{$key}: {$value}"] = " - ";
    }
    $result2 = array_diff($fileTwo, $fileOne);
    foreach ($result2 as $key => $value) {
        $difference["{$key}: {$value}"] = " + ";
    }
    ksort($difference);
    foreach ($difference as $key => $value) {
        $result = $result . " {$value} {$key}\n";
    }

    $result = $result . "}\n";
    print_r($result);
    return $result;
}
