<?php

function highlightWords(string $text, array $words): string {
    $escapedWords = array_map(function($word) {
        return preg_quote($word, '/');
    }, $words);

    $pattern = '/\b(' . implode('|', $escapedWords) . ')\b/u';

    $replacedWords = [];

    return preg_replace_callback($pattern, function($match) use (&$replacedWords) {
        $word = $match[1];
        if (!in_array($word, $replacedWords)) {
            $replacedWords[] = $word;
            return "[{$word}]";
        }
        return $word;
    }, $text);
}

$text = "Мама мыла раму ама test";
$words = ["test", "ама", "раму"];
echo highlightWords($text, $words);
