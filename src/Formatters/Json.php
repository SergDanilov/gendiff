<?php

namespace Differ\Formatters\Json;

function toJson(mixed $value)
{
    return json_encode($value);
}
