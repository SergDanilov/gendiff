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
            'stylishJsonToJson' => [getFixturePath("stylish.txt"), "nested1.json", "nested2.json", "stylish"],
            'stylishYamlToYaml' => [getFixturePath("stylish.txt"), "nested1.yaml", "nested2.yaml", "stylish"],
            'stylishYmlToYml' => [getFixturePath("stylish.txt"), "nested1.yml", "nested2.yml", "stylish"],
            'plainJsonToJson' => [getFixturePath("plain.txt"), "nested1.json", "nested2.json", "plain"],
            'plainYamlToYaml' => [getFixturePath("plain.txt"), "nested1.yaml", "nested2.yaml", "plain"],
            'plainYmlToYml' => [getFixturePath("plain.txt"), "nested1.yml", "nested2.yml", "plain"],
        ];
    }
}
