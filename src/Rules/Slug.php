<?php


namespace Firebed\News\Rules;


use Illuminate\Contracts\Validation\Rule;

class Slug implements Rule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/^([a-z0-9]+-)*[a-z0-9]+$/i', $value);
    }

    public function message(): string
    {
        return trans('validation.regex');
    }
}