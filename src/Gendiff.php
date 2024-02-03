<?php

namespace Hexlet\Code\Gendiff;

function runDiffer($filePath1, $filePath2, $result)
{
    if (file_exists($filePath1)) {
        $file1 = require_once $filePath1;
    } else {
        echo "Error";
    }
    if (file_exists($filePath2)) {
        $file2 = require_once $filePath2;
    } else {
        echo "Error";
    }
    var_dump($file1);
    print_r($result);
}
