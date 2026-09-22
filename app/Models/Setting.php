<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public const MEDIA_FOLDER = 'assets/uploads/site';

    protected $fillable = ['key', 'value'];

    private static ?array $store = null;

    /** All settings as key => decoded value (one query per request). */
    private static function store(): array
    {
        if (self::$store === null) {
            self::$store = [];
            foreach (self::query()->get(['key', 'value']) as $row) {
                self::$store[$row->key] = json_decode($row->value, true);
            }
        }

        return self::$store;
    }

    /** Value as saved: a string, or a [locale => text] array. */
    public static function raw(string $key, $default = null)
    {
        return self::store()[$key] ?? $default;
    }

    /** Value in the current locale, falling back to the fallback locale. */
    public static function get(string $key, $default = null)
    {
        $value = self::raw($key);

        if (is_array($value)) {
            $value = $value[app()->getLocale()] ?? $value[config('app.fallback_locale')] ?? null;
        }

        return ($value === null || $value === '') ? $default : $value;
    }

    /** Save a string or a [locale => text] array. */
    public static function put(string $key, $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => json_encode($value, JSON_UNESCAPED_UNICODE)]);
        self::$store = null;
    }
}
