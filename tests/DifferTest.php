<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;
use function Hexlet\Code\Differ\comparison;

// класс DifferTest наследует класс TestCase
// имя класса совпадает с именем файла
class DifferTest extends TestCase
{
    // Метод, функция определенная внутри класса
    // Должна начинаться со слова test
    // public – чтобы PHPUnit мог вызвать этот тест снаружи
    public function testComparison(): void
    {
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        $array1 =  ['host' => 'hexlet.io', 'timeout' => '50', 'proxy' => '123.234.53.22', 'follow' => 'false'];
        $array2 =  ['timeout' => 20, 'verbose' => 'true', 'host' => 'hexlet.io'];
        $this->assertEquals('{\n - follow: false\n   host: hexlet.io\n - proxy: 123.234.53.22\n + timeout: 20\n - timeout: 50\n + verbose: true\n}\n', comparison($array1, $array2));
    }
}