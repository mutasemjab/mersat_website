<?php

namespace App\Support;

/**
 * Country shapes and names for the "Worldwide presence" map (resources/data/world-map.php).
 */
class WorldMap
{
    public static function data(): array
    {
        static $data = null;

        return $data ??= require resource_path('data/world-map.php');
    }

    /** ISO alpha-2 code => country name in the given (or current) locale, sorted by name. */
    public static function countryNames(?string $locale = null): array
    {
        $locale = $locale ?? app()->getLocale();
        $names = array_map(fn ($c) => $c[$locale] ?? $c['en'], self::data()['countries']);
        asort($names, SORT_LOCALE_STRING);

        return $names;
    }

    public static function has(?string $code): bool
    {
        return $code !== null && isset(self::data()['countries'][$code]);
    }
}
