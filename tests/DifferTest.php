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
    /**
     * @dataProvider provider
     */
    public function testGenDiff($expected, $filePath1, $filePath2): void
    {
        $this->assertStringEqualsFile($expected, genDiff($filePath1, $filePath2));
    }
    public function provider()
    {
        return [
            // 'jsonTojson' => [getFixturePath("sampleString.txt"), "file1.json", "file2.json"],
            // 'ymlToyml' => [getFixturePath("sampleString.txt"), "file1.yml", "file2.yml"],
            'nestedJsonTojson' => [getFixturePath("nestedString.txt"), "nested1.json", "nested2.json"],
            'nestedymlToyml' => [getFixturePath("nestedString.txt"), "nested1.yml", "nested2.yml"]
        ];
    }
}
