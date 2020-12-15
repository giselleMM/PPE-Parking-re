<?php


namespace App\Utils;


use App\Enums\AuthEnum;
use Illuminate\Support\Facades\Session;

class SessionManager
{
    private static function sessionEquals(string $key, $value): bool
    {
        return Session::has($key) && Session::get($key) === $value;
    }

    public static function isLogged(): bool
    {
        return Session::exists('type');
    }

    public static function isAdmin(): bool
    {
        return self::sessionEquals('type', AuthEnum::AUTH_ADMIN);
    }

    public static function isPersV(): bool
    {
        return self::sessionEquals('type', AuthEnum::AUTH_PERSV);
    }

    public static function isPersNV(): bool
    {
        return self::sessionEquals('type', AuthEnum::AUTH_PERSNV);
    }

    public static function getFullTypeName(): string
    {
        //if (!self::isLogged()) return '';
        if(self::isPersNV()) return 'Personnel';
        if (self::isPersV()) return 'Personnel';
        if (self::isAdmin()) return 'administrateur';
        return '';
    }
}
