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
    public function testGenDiff($expected, $filePath1, $filePath2, $format): void
    {
        $this->assertStringEqualsFile($expected, genDiff($filePath1, $filePath2, $format));
    }
    public function provider()
    {
        return [
            'nestedJsonTojson' => [getFixturePath("nestedString.txt"), "nested1.json", "nested2.json", "stylish"],
            'nestedymlToyaml' => [getFixturePath("nestedString.txt"), "nested1.yaml", "nested2.yaml", "stylish"],
            'nestedymlToyml' => [getFixturePath("nestedString.txt"), "nested1.yml", "nested2.yml", "stylish"]
        ];
    }
}
