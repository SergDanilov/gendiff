<?php

namespace Differ\Formatters\Json;

function json(mixed $value)
{
    return json_encode($value);
}
