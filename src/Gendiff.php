<?php

namespace Hexlet\Code\Gendiff;

$filePath1 = __DIR__ . '/../tests/file1.json';
$filePath2 = __DIR__ . '/../tests/file2.json';

function comparison (array $fileOne, array $fileTwo)
{
    $result = "";
    $resultEquals = array_intersect($fileOne, $fileTwo);
    foreach ($resultEquals as $key => $value) {
        $result = $result . "  {$key}: {$value}";
    }
    $result1 = array_diff($fileOne, $fileTwo);
    foreach ($result1 as $key => $value) {
        $result = $result . "- {$key}: {$value}";
    }
    $result2 = array_diff($fileTwo, $fileOne);
    foreach ($result2 as $key => $value) {
        $result = $result . "+ {$key}: {$value}";
    }
    $result = $result . "";
    
    // print_r($resultEquals);
    // print_r($result1);
    // print_r($result2);
    // print_r($result);
    $arrString = explode(",", $result);
    natsort($arrString);
    print_r($arrString);
    return $result;
}

function runDiffer($filePath1, $filePath2)
{
    if (file_exists($filePath1)) {
        $file1GetContent =  file_get_contents($filePath1);
        $arr1 = json_decode($file1GetContent, true);
        
    } else {
        echo "Error";
    }
    if (file_exists($filePath2)) {
        $file2GetContent =  file_get_contents($filePath2);
        $arr2 = json_decode($file2GetContent, true);

    } else {
        echo "Error";
    }
    comparison ($arr1, $arr2);
}
runDiffer($filePath1, $filePath2);