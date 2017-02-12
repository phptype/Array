<?php
namespace ScriptFUSION\Type;

use ScriptFUSION\StaticClass;

/**
 * Provides common array extension methods.
 */
final class ArrayType
{
    use StaticClass;

    /**
     * Gets a value indicating whether the specified array is a list. A list is defined as an array whose keys are
     * a consecutive sequence of integers starting at zero.
     *
     * An empty array is ambiguous so the caller may declare whether to allow an empty array or not. By default empty
     * arrays are not considered a list.
     *
     * @param array $array Array.
     * @param bool $allowEmpty Optional. True to regard an empty array as a list, otherwise false.
     *
     * @return bool True if the array is a list, otherwise false.
     */
    public static function isList(array $array, $allowEmpty = false)
    {
        if (!$array) {
            return (bool)$allowEmpty;
        }

        return array_values($array) === $array;
    }

    /**
     * Gets a value indicating whether the specified array is a map. A map is defined as an array whose keys are not
     * a consecutive sequence of integers starting at zero.
     *
     * An empty array is ambiguous so the caller may declare whether to allow an empty array or not. By default empty
     * arrays are not considered a map.
     *
     * @param array $array Array.
     * @param bool $allowEmpty Optional. True to regard an empty array as a map, otherwise false.
     *
     * @return bool True if the array is a map, otherwise false.
     */
    public static function isMap(array $array, $allowEmpty = false)
    {
        if (!$array) {
            return (bool)$allowEmpty;
        }

        return array_values($array) !== $array;
    }
}
