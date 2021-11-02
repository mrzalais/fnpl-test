<?php

use PHPUnit\Framework\TestCase;


class TextTest extends TestCase
{
    //Condition: non-repeating
    public function testFindFirstNonRepeatingLetter(): void
    {
        $string = 'aabbc';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-L']);
        $text->findFirstNonRepeatingChar();
        $this->assertEquals('c', $text->letter);
    }

    public function testFindFirstNonRepeatingSymbol(): void
    {
        $string = '^^^~~||||$```';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-S']);
        $text->findFirstNonRepeatingChar();
        $this->assertEquals('$', $text->symbol);
    }

    public function testFindFirstNonRepeatingPunctuation(): void
    {
        $string = '###???;;:::!****';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-P']);
        $text->findFirstNonRepeatingChar();
        $this->assertEquals('!', $text->punctuation);
    }

    public function testFindFirstNonRepeatingChars(): void
    {
        $string = 'aabbc^^^~~||||$```###???;;:::!****';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-L', '-P', '-S']);
        $text->findFirstNonRepeatingChar();
        $this->assertEquals('c', $text->letter);
        $this->assertEquals('$', $text->symbol);
        $this->assertEquals('!', $text->punctuation);
    }


    //Condition: least-repeating
    public function testFindFirstLeastRepeatingLetter(): void
    {
        $string = 'aabbbbbbcddddfff';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-L']);
        $text->findFirstLeastRepeatingChar();
        $this->assertEquals('a', $text->letter);
    }

    public function testFindFirstLeastRepeatingSymbol(): void
    {
        $string = '^^^~~||||$```';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-S']);
        $text->findFirstLeastRepeatingChar();
        $this->assertEquals('~', $text->symbol);
    }

    public function testFindFirstLeastRepeatingPunctuation(): void
    {
        $string = '###???;;:::!****';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-P']);
        $text->findFirstLeastRepeatingChar();
        $this->assertEquals(';', $text->punctuation);
    }

    public function testFindFirstLeastRepeatingChars(): void
    {
        $string = 'aabbc^^^~~||||$```###???;;:::!****';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-L', '-P', '-S']);
        $text->findFirstLeastRepeatingChar();
        $this->assertEquals('a', $text->letter);
        $this->assertEquals('~', $text->symbol);
        $this->assertEquals(';', $text->punctuation);
    }


    //Condition: most-repeating
    public function testFindFirstMostRepeatingLetter(): void
    {
        $string = 'aabbbbbbcddddffffff';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-L']);
        $text->findFirstMostRepeatingChar();
        $this->assertEquals('b', $text->letter);
    }

    public function testFindFirstMostRepeatingSymbol(): void
    {
        $string = '^^^~~||||$````';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-S']);
        $text->findFirstMostRepeatingChar();
        $this->assertEquals('|', $text->symbol);
    }

    public function testFindFirstMostRepeatingPunctuation(): void
    {
        $string = '###???;;:::!****';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-P']);
        $text->findFirstMostRepeatingChar();
        $this->assertEquals('*', $text->punctuation);
    }

    public function testFindFirstMostRepeatingChars(): void
    {
        $string = 'aabbbbbbcffffff^^^~~||||$>>>```###???;;:::!****>>>>^^^^';
        $text = new \App\Models\Text($string);
        $text->prepareArrays($text->string, ['-L', '-P', '-S']);
        $text->findFirstMostRepeatingChar();
        $this->assertEquals('b', $text->letter);
        $this->assertEquals('^', $text->symbol);
        $this->assertEquals('*', $text->punctuation);
    }
}
