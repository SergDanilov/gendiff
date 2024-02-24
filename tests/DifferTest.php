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
        $array1 =  ['host' => 'hexlet.io', 'timeout' => 50, 'proxy' => '123.234.53.22', 'follow' => false];
        $array2 =  ['timeout' => 20, 'verbose' => true, 'host' => hexlet.io];
        $this->assertEquals('{
            -  follow: false
               host: hexlet.io
            -  proxy: 123.234.53.22
            +  timeout: 20
            -  timeout: 50
            +  verbose: true
          }', comparison($array1, $array2));
    }
}