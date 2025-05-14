<?php
namespace Tests\Banking\Validators;

use Hkm3r\TestsIban\Banking\Validators\IBANValidator;

use PHPUnit\Framework\TestCase;

class IBANValidatorTest extends TestCase
{
    public function testValidIBAN()
    {
        $this->assertTrue(IBANValidator::validate('ES7620770024003102575766'));
        $this->assertTrue(IBANValidator::validate('ES76 2077 0024 0031 0257 5766'));
        $this->assertFalse(IBANValidator::validate('es7620770024003102575766'));
    }
    
    public function testInvalidIBAN()
    {
        $this->assertFalse(IBANValidator::validate('ES7720770024003102575766'));
        $this->assertFalse(IBANValidator::validate('ES762077002400310257576'));
        $this->assertFalse(IBANValidator::validate('PT7620770024003102575766'));
    }
}