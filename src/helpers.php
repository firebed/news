<?php

use Firebed\News\Services\SlugGenerator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('to_upper')) {
    function to_upper($str): string
    {
        return Str::upper(str_replace(['i', 'ı'], ['İ', 'I'], $str));
    }
}

if (!function_exists('slugify')) {
    function slugify($strings, $separator = '-'): string
    {
        return SlugGenerator::getSlug(implode($separator, is_array($strings) ? array_filter($strings) : [$strings]), $separator);
    }
}

if (!function_exists('dir_size')) {
    function dir_size($disk, $dir, $format = TRUE): string
    {
        $files = Storage::disk($disk)->files($dir);
        $size = 0;
        foreach ($files as $file) {
            $size += Storage::disk($disk)->size($file);
        }

        if ($format) {
            if ($size === 0) {
                return '0 bytes';
            }

            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(1024 ** ($base - floor($base)), 1) . $suffixes[floor($base)];
        }

        return $size;
    }
}
