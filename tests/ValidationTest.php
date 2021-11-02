<?php

use App\Models\Validation;
use PHPUnit\Framework\TestCase;


class ValidationTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testFileExists(): void
    {
        $path = 'test-files/input.txt';
        $this->assertTrue(Validation::validateFileExists($path));
    }

    public function testProvidedFileIsNull(): void
    {
        $path = null;
        $this->assertFalse(Validation::validateFileExists($path));
    }

    /**
     * @throws Exception
     */
    public function testProvidedStringIsValid(): void
    {
        $string = "1234567890qwertyuiopasdfghjklzxcvbnm[];',./{}:|<>?";
        $this->assertTrue(Validation::validateText($string));
    }

    public function testProvidedStringContainsSpaces(): void
    {
        $string = "1234567890 ēŗūīõāš ģķļžčņ[];',./{}:|<>?";
        $this->assertFalse(Validation::validateText($string));
    }

    public function testProvidedStringContainsNewLine(): void
    {
        $string = "1234567890 ēŗūīõāš" . PHP_EOL . "ģķļžčņ[];',./{}:|<>?";
        $this->assertFalse(Validation::validateText($string));
    }

    public function testProvidedStringContainsNonAsciiLetters(): void
    {
        $string = "1234567890ēŗūīõāšģķļžčņ[];',./{}:|<>?";
        $this->assertFalse(Validation::validateText($string));
    }

    public function testValidFormat(): void
    {
        $format = 'non-repeating';
        $this->assertTrue(Validation::validateFormat($format));
    }

    public function testInvalidFormat(): void
    {
        $format = 'invalid-format';
        $this->assertFalse(Validation::validateFormat($format));
    }

    public function testAtLeastOneConditionProvided(): void
    {
        $conditions = ['-S', null, null];
        $this->assertTrue(Validation::validateConditionArrayIsNotEmpty($conditions));
    }

    public function testNoConditionProvided(): void
    {
        $conditions = [null, null, null];
        $this->assertFalse(Validation::validateConditionArrayIsNotEmpty($conditions));
    }

    public function testValidCondition(): void
    {
        $condition = '-S';
        $this->assertTrue(Validation::validateCondition($condition));
    }

    public function testInvalidCondition(): void
    {
        $condition = '-D';
        $this->assertFalse(Validation::validateCondition($condition));
    }
}
