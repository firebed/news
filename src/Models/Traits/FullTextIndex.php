<?php


namespace Firebed\News\Models\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait FullTextIndex
{
    public static string $REGEX           = "/[^\p{L}|\p{N}]+/u";
    public static string $REPLACE         = ' ';
    public static int    $MIN_WORD_LENGTH = 3;

    public static function prepareSearchTerm(string $term): ?string
    {
        $striped = explode(' ', preg_replace(self::$REGEX, self::$REPLACE, $term));
        $striped = array_filter($striped, 'filled');
        $striped = array_filter($striped, static fn($v) => Str::length($v) >= self::$MIN_WORD_LENGTH);
        if (empty($striped)) {
            return NULL;
        }
        $striped = preg_filter('/$/', '*', preg_filter('/^/', '+', $striped));
        return implode(' ', $striped);
    }

    public function scopeMatchAgainst(Builder $builder, $search): void
    {
        $against = self::prepareSearchTerm($search);
        if ($against !== NULL) {
            $match = implode(', ', $this->match);
            $builder->whereRaw("MATCH($match) AGAINST (? IN BOOLEAN MODE)", $against);
        }
    }
}
