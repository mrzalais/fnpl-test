<?php

declare(strict_types=1);


use App\Models\Text;
use App\Models\Validation;

require_once 'Models/Validation.php';
require_once 'Models/Text.php';

$before = microtime(true);

$input = getopt("i:f:");
$file = $input['i'] ?? null;
$format = $input['f'] ?? null;
$firstCondition = $argv[5] ?? null;
$secondCondition = $argv[6] ?? null;
$thirdCondition = $argv[7] ?? null;
$conditions = [$firstCondition, $secondCondition, $thirdCondition];

if (!Validation::validateFileExists($file)) {
    exit('Program exited with error code: 1');
}

$text = new Text(file_get_contents($input['i']));
if (!Validation::validateText($text->string)) {
        exit('Program exited with error code: 2');
}
if (!Validation::validateFormat($format)) {
        exit('Program exited with error code: 3');
}
if (!Validation::validateConditionArrayIsNotEmpty($conditions)) {
        exit('Program exited with error code: 4');
}
foreach ($conditions as $condition) {
    if (!Validation::validateCondition($condition)) {
            exit('Program exited with error code: 4');
    }
}

$text->prepareArrays($text->string, $conditions);
switch ($format) {
    case 'non-repeating':
        $text->findFirstNonRepeatingChar();
        break;
    case 'least-repeating':
        $text->findFirstLeastRepeatingChar();
        break;
    case 'most-repeating':
        $text->findFirstMostRepeatingChar();
        break;
}

echo 'File: ' . pathinfo($input['i'])['basename'] . PHP_EOL;
if (in_array('-L', $conditions, true)) {
    echo "First {$format} letter: " . $text->letter . PHP_EOL;
}
if (in_array('-P', $conditions, true)) {
    echo "First {$format} punctuation: " . $text->punctuation . PHP_EOL;
}
if (in_array('-S', $conditions, true)) {
    echo "First {$format} symbol: " . $text->symbol . PHP_EOL;
}

$after = microtime(true);
echo ($after - $before) . PHP_EOL;
