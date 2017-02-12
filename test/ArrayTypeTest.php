<?php
namespace ScriptFUSIONTest\Unit\Type;

use ScriptFUSION\Type\ArrayType;

final class ArrayTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array $array
     * @param mixed $allowEmpty
     * @param bool $expected
     *
     * @dataProvider provideLists
     */
    public function testIsList(array $array, $allowEmpty, $expected)
    {
        self::assertSame($expected, ArrayType::isList($array, $allowEmpty));
    }

    public function provideLists()
    {
        return [
            // Empty lists.
            [[], null, false],
            [[], false, false],
            [[], true, true],

            // Valid lists.
            'Single implicit list' => [[1], null, true],
            'Double implicit list' => [[1, 2], null, true],
            'Single explicit list' => [[0 => null], null, true],
            'Double explicit list' => [[0 => null, 1 => null], null, true],
            'Single string key' => [['0' => null], null, true],
            'Double string keys' => [['0' => null, '1' => null], null, true],
            'Large range' => [range(1, 0xFFFF), null, true],

            // Non-lists.
            'Non-zero-based list' => [[1 => null], null, false],
            'List with hole' => [[0 => null, 2 => null], null, false],
            'Text key' => [['foo' => null], null, false],
        ];
    }

    /**
     * @param array $array
     * @param $allowEmpty
     * @param $expected
     *
     * @dataProvider provideMaps
     */
    public function testIsMap(array $array, $allowEmpty, $expected)
    {
        self::assertSame($expected, ArrayType::isMap($array, $allowEmpty));
    }

    public function provideMaps()
    {
        return [
            // Empty maps.
            [[], null, false],
            [[], false, false],
            [[], true, true],

            // Valid maps.
            'Single key' => [['foo' => null], null, true],
            'Double key' => [['foo' => null, 'bar' => null], null, true],
            'Non-zero-based list' => [[1 => null], null, true],
            'List with hole' => [[0 => null, 2 => null], null, true],

            // Non-maps.
            'Numeric key' => [[0 => null], null, false],
            'Numeric string key' => [['0' => null], null, false],
        ];
    }
}
