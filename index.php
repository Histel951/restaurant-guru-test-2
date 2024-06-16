<?php

function highlightWords(string $text, array $words): string {
    $lowercaseText = mb_strtolower($text, 'UTF-8');
    $lowercaseWords = array_map(function($word) {
        return mb_strtolower($word, 'UTF-8');
    }, $words);
    $escapedWords = array_map(function($word) {
        return preg_quote($word, '/');
    }, $lowercaseWords);
    $pattern = '/\b(' . implode('|', $escapedWords) . ')\b/iu';

    return preg_replace_callback($pattern, function($match) {
        return "[{$match[1]}]";
    }, $lowercaseText);
}

// тест
$text = "Мама мыла раму ама test";
$words = ["test", "ама", "раму"];
echo highlightWords($text, $words);
