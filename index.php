<?php

function highlightWords(string $text, array $words): string {
    $escapedWords = array_map(function($word) {
        return preg_quote($word, '/');
    }, $words);

    $pattern = '/\b(' . implode('|', $escapedWords) . ')\b/ui';

    $replacedWords = [];

    return preg_replace_callback($pattern, function($match) use (&$replacedWords) {
        $word = $match[0];
        $lowerWord = mb_strtolower($word);
        if (!isset($replacedWords[$lowerWord])) {
            $replacedWords[$lowerWord] = true;
            return "[{$word}]";
        }
        return $word;
    }, $text);
}

$text = "Мама мыла раму Ама аМа test tEst teSt";
$words = ["tEst", "аМа", "раму"];
echo highlightWords($text, $words);
