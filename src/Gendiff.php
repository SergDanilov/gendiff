<?php

namespace Hexlet\Code\Gendiff;

$filePath1 = __DIR__ . '/../tests/file1.json';
$filePath2 = __DIR__ . '/../tests/file2.json';

function comparison (array $fileOne, array $fileTwo)
{
    $result = [];
    foreach ($fileOne as $key1 => $value1) {
        foreach ($fileTwo as $key2 => $value2) {
            if ($key1 == $key2) {
                if ($value1 == $value2) {
                    $result[$key1] = $value1;
                } else {
                    $result[$key1] = $value1;
                    $result[$key2] = $value2;
                }
            } else {
                $result[$key1] = $value1;
            }
        }
    }
    
    print_r($result);
    return $result;
}

function runDiffer($filePath1, $filePath2)
{
    if (file_exists($filePath1)) {
        $file1GetContent =  file_get_contents($filePath1);
        $arr1 = json_decode($file1GetContent, true);
        // print_r($arr1);
    } else {
        echo "Error";
    }
    if (file_exists($filePath2)) {
        $file2GetContent =  file_get_contents($filePath2);
        $arr2 = json_decode($file2GetContent, true);
        // print_r($arr2);
    } else {
        echo "Error";
    }
    comparison ($arr1, $arr2);
}
runDiffer($filePath1, $filePath2);