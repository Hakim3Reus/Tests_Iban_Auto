<?php
namespace Hkm3r\TestsIban\Banking\Validators;

class AccountRecovery
{
    public static function recoverHiddenDigits(string $partialCCC): array
{
    $cleanCCC = preg_replace('/[^0-9*]/', '', $partialCCC);

    if (strlen($cleanCCC) !== 20 || substr_count($cleanCCC, '*') !== 2) {
        return [];
    }

    // Posiciones exactas de los asteriscos
    $positions = [];
    for ($i = 0; $i < strlen($cleanCCC); $i++) {
        if ($cleanCCC[$i] === '*') {
            $positions[] = $i;
        }
    }

    // Solo aceptamos ocultos en posiciones 8-11 (los dígitos de control)
    if (!in_array($positions[0], [8, 9, 10, 11]) || !in_array($positions[1], [8, 9, 10, 11])) {
        return [];
    }

    $results = [];
    for ($i = 0; $i <= 9; $i++) {
        for ($j = 0; $j <= 9; $j++) {
            $tempCCC = $cleanCCC;
            $tempCCC[$positions[0]] = (string)$i;
            $tempCCC[$positions[1]] = (string)$j;

            if (CCCValidator::validate($tempCCC)) {
                $results[] = $tempCCC;
            }
        }
    }

    return $results;
}

}