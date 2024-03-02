<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;
use function Hexlet\Code\Differ\genDiff;

// класс DifferTest наследует класс TestCase
// имя класса совпадает с именем файла
class DifferTest extends TestCase
{
    // Метод, функция определенная внутри класса
    // Должна начинаться со слова test
    // public – чтобы PHPUnit мог вызвать этот тест снаружи
    public function testGenDiff(): void
    {
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        $path1 = "file1.json" ;
        $path2 = "file2.json" ;
        $this->assertEquals(
'{
  -  follow: false
     host: hexlet.io
  -  proxy: 123.234.53.22
  +  timeout: 20
  -  timeout: 50
  +  verbose: true
}
', genDiff($path1, $path2));
    }
}