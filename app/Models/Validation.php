<?php

declare(strict_types=1);

namespace App\Models;


class Validation
{
    public static function validateFileExists($file): bool
    {
        if ($file === null) {
            return false;
        }
        if (file_exists($file) === false) {
            return false;
        }
        return true;
    }

    public static function validateText(string $string): bool
    {
        return !(preg_match('/[ \t]+/', $string) ||
            preg_match('~[\r\n]+~', $string) ||
            preg_match('/[^[:print:]]/', $string));
    }

    public static function validateFormat(?string $format): bool
    {
        $formats = ['non-repeating', 'least-repeating', 'most-repeating'];
        if (!in_array($format, $formats) || $format === null) {
            return false;
        }
        return true;
    }

    public static function validateConditionArrayIsNotEmpty(array $conditions): bool
    {
        return !($conditions[0] === null && $conditions[1] === null && $conditions[2] === null);
    }

    public static function validateCondition(?string $condition): bool
    {
        $conditions = ['-L', '-P', '-S'];
        return !($condition !== null && !in_array($condition, $conditions, true));
    }
}
