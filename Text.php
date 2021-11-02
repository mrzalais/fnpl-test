<?php

declare(strict_types=1);

class Text
{
    public string $string;
    public string $letter;
    public string $punctuation;
    public string $symbol;

    public function __construct(string $text)
    {
        $this->string = $text;
        $this->letter = 'None';
        $this->punctuation = 'None';
        $this->symbol = 'None';
    }

    public function getCounts(): array
    {
        return array_count_values(str_split($this->string));
    }

    public function findFirstNonRepeatingChar(array $counts): void
    {
        foreach($counts as $value => $count) {
            if ($count === 1 && ctype_alpha($value) && $this->letter === 'None') {
                $this->letter = $value;
            }
            if ($count === 1 && preg_match("#[[:punct:]]#", $value) && $this->punctuation === 'None') {
                $this->punctuation = $value;
            }
            if ($count === 1 && preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value) && $this->symbol === 'None') {
                $this->symbol = $value;
            }
        }
    }
    
    public function findFirstLeastRepeatingChar(array $counts): void
    {
        foreach($counts as $value => $count) {
            if ($count !== 1 && $count < $max && preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value) && $this->symbol === 'None') {
                $this->symbol = $value;
            }
            if ($count !== 1 && $count < $max && preg_match("#[[:punct:]]#", $value) && $this->punctuation === 'None') {
                $this->punctuation = $value;
            }
            if ($count !== 1 && $count < $max && ctype_alpha($value) && $this->letter === 'None') {
                $this->letter = $value;
            }
        }
    }
    
    public function findFirstMostRepeatingChar(array $counts): void
    {
        $max = max($counts);
        foreach($counts as $value => $count) {
            if ($count === $max && preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value) && $this->symbol === 'None') {
                $this->symbol = $value;
            }
            if ($count === $max && preg_match("#[[:punct:]]#", $value) && $this->punctuation === 'None') {
                $this->punctuation = $value;
            }
            if ($count === $max && ctype_alpha($value) && $this->letter === 'None') {
                $this->letter = $value;
            }
        }
    }
}