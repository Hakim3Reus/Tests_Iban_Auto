<?php
namespace Tests\Banking\Validators;

use Hkm3r\TestsIban\Banking\Validators\CCCValidator;


use PHPUnit\Framework\TestCase;

class CCCValidatorTest extends TestCase
{
    public function testValidCCC()
    {
        $this->assertTrue(CCCValidator::validate('20770024003102575766'));
        $this->assertTrue(CCCValidator::validate('2077 0024 00 3102575766'));
        $this->assertTrue(CCCValidator::validate('1234-5678-06-1234567890'));
    }
    
    public function testInvalidCCC()
    {
        $this->assertFalse(CCCValidator::validate('20770024003102575767'));
        $this->assertFalse(CCCValidator::validate('2077002400310257576'));
        $this->assertFalse(CCCValidator::validate('A0770024003102575766'));
    }
}