<?php

namespace Hexlet\Code\Gendiff;

function runDiffer($filePath1, $filePath2, $result)
{   
    if (file_exists($filePath1)) {
        require_once $filePath1;
    } else {
        echo "Error";
    }
    if (file_exists($filePath2)) {
        require_once $filePath2;
    } else {
        echo "Error";
    }
    print_r($result);
}
