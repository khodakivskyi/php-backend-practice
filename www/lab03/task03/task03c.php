<?php
$file = "file_with_words.txt";

$words = preg_split('/\s+/', file_get_contents($file));

if (count($words) > 1) {
    sort($words, SORT_STRING);
}

file_put_contents($file, implode(" ", $words));
