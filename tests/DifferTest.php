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
        $filePath1 = __DIR__ . '/../tests/fixtures/file1.json';
        $filePath2 = __DIR__ . '/../tests/fixtures/file2.json';
        $this->assertEquals('{
            -  follow: false
               host: hexlet.io
            -  proxy: 123.234.53.22
            +  timeout: 20
            -  timeout: 50
            +  verbose: true
          }', comparison($filePath1, $filePath1));
    }
}