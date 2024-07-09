<?php

function highlightWords(string $text, array $words): string {
    $escapedWords = array_map(function($word) {
        return preg_quote($word, '/');
    }, $words);

    $pattern = '/\b(' . implode('|', $escapedWords) . ')\b/u';

    $replacedWords = [];

    return preg_replace_callback($pattern, function($match) use (&$replacedWords) {
        $word = $match[0];
        if (!isset($replacedWords[$word])) {
            $replacedWords[$word] = true;
            return "[{$word}]";
        }
        return $word;
    }, $text);
}

$text = "Мама мыла рАму раму Ама ама аМа tEst test";
$words = ["tEst", "ама", "раму"];
echo highlightWords($text, $words);
