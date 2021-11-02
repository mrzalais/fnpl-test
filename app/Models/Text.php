<?php

declare(strict_types=1);

namespace App\Models;

class Text
{
    public string $string;
    public string $letter;
    public string $punctuation;
    public string $symbol;

    public array $letters;
    public array $punctuations;
    public array $symbols;

    public function __construct(string $text)
    {
        $this->string = $text;
        $this->letter = 'None';
        $this->punctuation = 'None';
        $this->symbol = 'None';
        $this->letters = [];
        $this->punctuations = [];
        $this->symbols = [];
    }

    public function prepareArrays(string $string, array $conditions): void
    {
        if (in_array('-L', $conditions, true)) {
            foreach (str_split($string) as $char) {
                if (ctype_alpha($char)) {
                    $this->letters [] = $char;
                }
            }
        }
        if (in_array('-P', $conditions, true)) {
            foreach (str_split($string) as $char) {
                if (in_array($char, ['/', '\\']) ||
                    (!preg_match('/[£$`^~><|=+¬]/u', $char) && preg_match("#[[:punct:]]#", $char))) {
                    $this->punctuations [] = $char;
                }
            }
        }
        if (in_array('-S', $conditions, true)) {
            foreach (str_split($string) as $char) {
                if (preg_match('/[£$`^~><|=+¬]/u', $char)) {
                    $this->symbols [] = $char;
                }
            }
        }
        $this->letters = array_count_values($this->letters);
        $this->punctuations = array_count_values($this->punctuations);
        $this->symbols = array_count_values($this->symbols);
    }

    public function findFirstNonRepeatingChar(): void
    {
        foreach ($this->letters as $value => $count) {
            if ($this->letter === 'None' && $count === 1) {
                $this->letter = $value;
            }
        }
        foreach ($this->symbols as $value => $count) {
            if ($this->symbol === 'None' && $count === 1) {
                $this->symbol = $value;
            }
        }
        foreach ($this->punctuations as $value => $count) {
            if ($this->punctuation === 'None' && $count === 1) {
                $this->punctuation = $value;
            }
        }
    }

    public function findFirstLeastRepeatingChar(): void
    {
        $groups = ['letters', 'symbols', 'punctuations'];
        foreach ($groups as $array) {
            foreach ($this->$array as $value => $count) {
                if ($count === 1) {
                    unset($this->{$array}[$value]);
                }
            }
        }
        foreach ($this->letters as $value => $count) {
            $min = min($this->letters);
            if ($this->letter === 'None' && $count === $min) {
                $this->letter = $value;
            }
        }
        foreach ($this->symbols as $value => $count) {
            $min = min($this->symbols);
            if ($this->symbol === 'None' && $count === $min) {
                $this->symbol = $value;
            }
        }
        foreach ($this->punctuations as $value => $count) {
            $min = min($this->punctuations);
            if ($this->punctuation === 'None' && $count === $min) {
                $this->punctuation = $value;
            }
        }
    }


    public function findFirstMostRepeatingChar(): void
    {
        foreach ($this->letters as $value => $count) {
            $max = max($this->letters);
            if ($this->letter === 'None' && $count === $max) {
                $this->letter = $value;
            }
        }
        foreach ($this->symbols as $value => $count) {
            $max = max($this->symbols);
            if ($this->symbol === 'None' && $count === $max) {
                $this->symbol = $value;
            }
        }
        foreach ($this->punctuations as $value => $count) {
            $max = max($this->punctuations);
            if ($this->punctuation === 'None' && $this->symbol !== $value && $count === $max) {
                $this->punctuation = $value;
            }
        }
    }
}
