<?php

namespace Hkm3r\TestsIban\Banking\Validators;

class IBANValidator
{
    public static function validate(string $iban): bool
{
    $cleanIBAN = self::sanitize($iban);
    
    // Debugging para comprobar el valor
    var_dump($cleanIBAN);
    
    if (strlen($cleanIBAN) !== 24 || substr($cleanIBAN, 0, 2) !== 'ES') {
        return false;
    }
    
    $reordered = substr($cleanIBAN, 4) . substr($cleanIBAN, 0, 4);
    $numeric = self::convertToNumeric($reordered);
    
    return self::modulo97($numeric) === 1;
}


    
    private static function convertToNumeric(string $iban): string
    {
        $result = '';
        foreach (str_split($iban) as $char) {
            $result .= ctype_alpha($char) ? (string)(ord($char) - ord('A') + 10) : $char;
        }
        return $result;
    }
    
    private static function modulo97(string $number): int
    {
        $remainder = 0;
        foreach (str_split($number) as $digit) {
            $remainder = ($remainder * 10 + (int)$digit) % 97;
        }
        return $remainder;
    }
    
    private static function sanitize(string $iban): string
    {
        return strtoupper(preg_replace('/[^A-Z0-9]/', '', $iban));
    }
}