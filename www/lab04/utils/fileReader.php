<?php

namespace utils;

class fileReader
{
    static string $dir="text";

    static public function ReadFile(string $filename): string{
        $path = self::$dir . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($path)) return file_get_contents($path);
        return "File was not found";
    }
    static public function UpdateFile(string $filename, string $content): bool{
        $path = self::$dir . DIRECTORY_SEPARATOR . $filename;
        return file_put_contents($path, $content, FILE_APPEND);
    }
    static public function DeleteFile(string $filename): bool{
        $path = self::$dir . DIRECTORY_SEPARATOR . $filename;
        return file_put_contents($path, " ");
    }
}