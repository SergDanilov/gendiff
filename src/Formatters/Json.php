<?php

namespace Differ\Formatters\Json;

function render(mixed $value)
{
    return json_encode($value);
}
