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

    $replacedWords = [];

    return preg_replace_callback($pattern, function($match) use (&$replacedWords) {
        $word = $match[1];
        if (!in_array($word, $replacedWords)) {
            $replacedWords[] = $word;
            return "[{$word}]";
        }
        return $word;
    }, $lowercaseText);
}

// тест
$text = "Мама мыла раму ама test";
$words = ["test", "ама", "раму"];
echo highlightWords($text, $words);
