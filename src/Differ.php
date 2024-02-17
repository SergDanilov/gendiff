<?php

namespace Hexlet\Code\Differ;

function comparison (array $fileOne, array $fileTwo)
{
    $result = "{\n";
    $resultEquals = array_intersect($fileOne, $fileTwo);
    $arrNew = [];
    foreach ($resultEquals as $key => $item) {
        $arrNew["{$key}: {$item}"] = "   ";
    }
    $result1 = array_diff($fileOne, $fileTwo);
    foreach ($result1 as $key => $item) {
        $arrNew["{$key}: {$item}"] = " - ";
    }
    $result2 = array_diff($fileTwo, $fileOne);
    foreach ($result2 as $key => $item) {
        $arrNew["{$key}: {$item}"] = " + ";
    }
    ksort($arrNew);
    foreach ($arrNew as $key => $value) {
        $result = $result . " {$value} {$key}\n";
    }

    $result = $result . "}\n";
    print_r($result);
    return $result;
}

function genDiff($filePath1, $filePath2)
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
