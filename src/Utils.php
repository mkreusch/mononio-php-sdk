<?php
namespace Montonio;

class Utils
{
    const SUPPORTED_LOCALES = [
        'lt',
        'lv',
        'ru',
        'et',
        'fi',
        'pl',
        'de'
    ];

    public static function getNormalizedLocale(string $locale): string
    {
        if(preg_match('/^[a-z]{2}/i', $locale, $match)){
            $localeCandidate = strtolower($match[0]);
            if(in_array($localeCandidate, self::SUPPORTED_LOCALES)){
                return $localeCandidate;
            }
        }
        return 'en';
    }
}