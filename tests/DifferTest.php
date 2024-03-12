<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Hexlet\Code\Differ\genDiff;

// функция для формирования путей до тестируемых файлов
function getFixturePath($path)
{
    $parts = [__DIR__, 'fixtures', $path];
    return implode('/', $parts);
}
// класс DifferTest наследует класс TestCase
// имя класса совпадает с именем файла
class DifferTest extends TestCase
{
    // Метод, функция определенная внутри класса
    // Должна начинаться со слова test
    // public – чтобы PHPUnit мог вызвать этот тест снаружи
    /**
     * @dataProvider provider
     */
    public function testGenDiff($expected, $filePath1, $filePath2): void
    {
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        // $path1 = "file1.json";
        // $path2 = "file2.json";
        $this->assertStringEqualsFile($expected, genDiff($filePath1, $filePath2));
    }
    public function provider() 
    {
        return [
            'jsonTojson' => [getFixturePath("sampleString.txt"), "file1.json", "file1.json"]
            // [$path1 => "file1.yml", $path2 => "file2.yml"],
        ];
    }
}
