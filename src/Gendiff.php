<?php

namespace Hexlet\Code\Gendiff;

require('/../vendor/docopt/docopt/src/docopt.php');

function runDiffer($doc)
{   
    $result = Docopt::handle($doc);
    print_r($result);
}
