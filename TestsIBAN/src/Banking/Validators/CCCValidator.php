<?php
namespace Hkm3r\TestsIban\Banking\Validators;
class CCCValidator
{
    private const WEIGHTS = [1, 2, 4, 8, 5, 10, 9, 7, 3, 6];
    
    public static function validate(string $ccc): bool
{
    $cleanCCC = self::sanitize($ccc);

    if (strlen($cleanCCC) !== 20) {
        return false;
    }

    $bankBranch = substr($cleanCCC, 0, 8);            
    $dc1 = substr($cleanCCC, 8, 1);                   
    $dc2 = substr($cleanCCC, 9, 1);                   
    $accountNumber = substr($cleanCCC, 10, 10);       

    $expectedDC1 = self::calculateDC('00' . $bankBranch);
    $expectedDC2 = self::calculateDC($accountNumber);

    return $dc1 === $expectedDC1 && $dc2 === $expectedDC2;
}

    
    private static function validateControlDigits(string $number, string $providedDC): bool
    {
        return self::calculateDC($number) === $providedDC;
    }
    
    private static function calculateDC(string $number): string
    {
        $sum = 0;
        for ($i = 0; $i < strlen($number); $i++) {
            $sum += ((int)$number[$i]) * self::WEIGHTS[$i];
        }
        
        $dc = 11 - ($sum % 11);
        
        return match($dc) {
            10 => '1',
            11 => '0',
            default => (string)$dc
        };
    }
    
    private static function sanitize(string $ccc): string
    {
        return preg_replace('/[^0-9]/', '', $ccc);
    }
}