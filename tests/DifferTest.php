<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

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
    public function testGenDiff($expected, $filePath1, $filePath2, $formatName = "stylish"): void
    {
        $this->assertStringEqualsFile($expected, genDiff($filePath1, $filePath2, $formatName));
    }
    public function provider()
    {
        return [
            'simpleJsonToJson' => [getFixturePath("stylish.txt"), "file1.json", "file2.json"],
            'defaultJsonToJson' => [getFixturePath("stylish.txt"), "file1.json", "file2.json"],
            'stylishJsonToJson' => [getFixturePath("stylish.txt"), "file1.json", "file2.json", "stylish"],
            'stylishYmlToYml' => [getFixturePath("stylish.txt"), "nested1.yml", "nested2.yml", "stylish"],
            'plainJsonToJson' => [getFixturePath("plain.txt"), "file1.json", "file2.json", "plain"],
            'plainYmlToYml' => [getFixturePath("plain.txt"), "nested1.yml", "nested2.yml", "plain"],
            'jsonJsonToJson' => [getFixturePath("json.txt"), "file1.json", "file2.json", "json"],
            'jsonYmlToYml' => [getFixturePath("json.txt"), "nested1.yml", "nested2.yml", "json"],
        ];
    }
}
