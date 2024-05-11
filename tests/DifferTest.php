<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

function getFixturePath($path)
{
    $parts = [__DIR__, 'fixtures', $path];
    return implode('/', $parts);
}

class DifferTest extends TestCase
{
    /**
     * @dataProvider filesProvider
     */
    public function testGenDiff($expected, $filePath1, $filePath2, $formatName = "stylish"): void
    {
        $actual = genDiff($filePath1, $filePath2, $formatName);
        $this->assertStringEqualsFile($expected, $actual);
    }

    public function filesProvider()
    {
        return [
            'simpleJsonToJson' => [ getFixturePath("stylish.txt"),
                                    getFixturePath("file1.json"),
                                    getFixturePath("file2.json")],
            'defaultJsonToJson' => [getFixturePath("stylish.txt"),
                                    getFixturePath("file1.json"),
                                    getFixturePath("file2.json")],
            'stylishJsonToJson' => [getFixturePath("stylish.txt"),
                                    getFixturePath("file1.json"),
                                    getFixturePath("file2.json"), "stylish"],
            'stylishYmlToYml'   => [getFixturePath("stylish.txt"),
                                    getFixturePath("file1.yml"),
                                    getFixturePath("file2.yml"), "stylish"],
            'stylishMixed'      =>  [getFixturePath("stylish.txt"),
                                    getFixturePath("file1.json"),
                                    getFixturePath("file2.yml"), "stylish"],
            'plainJsonToJson'   => [getFixturePath("plain.txt"),
                                    getFixturePath("file1.json"),
                                    getFixturePath("file2.json"), "plain"],
            'plainYmlToYml'     => [getFixturePath("plain.txt"),
                                    getFixturePath("file1.yml"),
                                    getFixturePath("file2.yml"), "plain"],
            'plainMixed'        =>  [getFixturePath("plain.txt"),
                                    getFixturePath("file1.json"),
                                    getFixturePath("file2.yml"), "plain"],
            'jsonJsonToJson'    => [getFixturePath("json.txt"),
                                    getFixturePath("file1.json"),
                                    getFixturePath("file2.json"), "json"],
            'jsonYmlToYml'      => [getFixturePath("json.txt"),
                                    getFixturePath("file1.yml"),
                                    getFixturePath("file2.yml"), "json"],
            'jsonMixed'         => [getFixturePath("json.txt"),
                                    getFixturePath("file1.json"),
                                    getFixturePath("file2.yml"), "json"],
        ];
    }
}
