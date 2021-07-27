<?php


namespace Firebed\News\Livewire\Traits;


trait TrimStrings
{
    public function trim($string): ?string
    {
        $trimmed = trim($string);
        return empty($trimmed) ? NULL : $trimmed;
    }
}
