<?php

declare(strict_types=1);

class Format
{
    public string $name;
    public const L = 'letter';
    public const P = 'punctuation';
    public const S = 'symbol';

    public function __construct(string $flag)
    {
        $this->name = $this->getName($flag);
    }

    public function getName(string $flag)
    {
        var_dump($flag);die;
    }
}