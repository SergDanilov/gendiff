<?php

namespace Hexlet\Code\Gendiff;

function runDiffer($doc)
{   
    $result = Docopt::handle($doc);
    print_r($result);
}
