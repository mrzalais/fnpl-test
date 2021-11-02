<?php

declare(strict_types=1);

require_once 'Validation.php';
require_once 'Text.php';

$before = microtime(true);

$input = getopt("i:f:");
$file = $input['i'];
$format = $input['f'];
$firstCondition = isset($argv[5]) ? $argv[5] : null;
$secondCondition = isscet($argv[6]) ? $argv[6] : null;
$thirdCondition = isset($argv[7]) ? $argv[7] : null;
$conditions = [$firstCondition, $secondCondition, $thirdCondition];

Validation::validateFile($file);

$text = New Text(file_get_contents($input['i']));
$validation->validateText($text->string);
$validation->validateFormat($format);
$validation->validateConditions($conditions);
$counts = $text->getCounts();


switch ($format) {
    case 'non-repeating':
        $text->findFirstMostRepeatingChar($counts);
        break;
    case 'least-repeating':
        $text->findFirstLeastRepeatingChar($counts);
        break;
    case 'most-repeating':
        $text->findFirstMostRepeatingChar($counts);
        break;
}

echo 'File: ' . pathinfo($input['i'])['basename'] . PHP_EOL;
echo "First {$format} {$firstCondition}: " . $text->letter . PHP_EOL;
echo "First {$format} {$secondCondition}: " . $text->punctuation . PHP_EOL;
echo "First {$format} {$thirdCondition}: " . $text->symbol . PHP_EOL;

$after = microtime(true);
echo ($after-$before) . PHP_EOL;