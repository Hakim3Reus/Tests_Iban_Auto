<?php
namespace App\Banking\Models;

use App\Banking\Validators\CCCValidator;
use App\Banking\Validators\IBANValidator;

class BankAccount
{
    private string $ccc;
    private string $iban;
    
    public function __construct(string $accountNumber)
    {
        if (CCCValidator::validate($accountNumber)) {
            $this->ccc = $accountNumber;
            $this->iban = $this->generateIBAN();
        } elseif (IBANValidator::validate($accountNumber)) {
            $this->iban = $accountNumber;
            $this->ccc = $this->extractCCC();
        } else {
            throw new \InvalidArgumentException('Invalid account number');
        }
    }
    
    private function generateIBAN(): string
    {
        // Implementación para generar IBAN desde CCC
    }
    
    private function extractCCC(): string
    {
        // Implementación para extraer CCC desde IBAN
    }
    
    public function getCCC(): string
    {
        return $this->ccc;
    }
    
    public function getIBAN(): string
    {
        return $this->iban;
    }
}