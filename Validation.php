<?php

declare(strict_types=1);

class Validation
{
    public static function validateFileExists()
    {
        $exists = file_exists($input['i']);
        if ($exists === false) {
            exit('1');
        }
    }

    public static function validateText(string $string)
    {
        if (preg_match('/[ \t]+/', $text->string) || preg_match('~[\r\n]+~', $text->string)) {
            exit('2');
        }
    }

    public static function validateFormat(string $format)
    {
        $formats = ['non-repeating', 'least-repeating', 'most-repeating'];
        if (!in_array($format, $formats)) {
            exit('3');
        }
    }

    public static function validateConditions(array $conditions)
    {
        if ($firstCondition === null && $secondCondition === null && $thirdCondition === null) {
            exit('4');
        }
    }
}