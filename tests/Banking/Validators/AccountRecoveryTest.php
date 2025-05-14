<?php
namespace Tests\Banking\Validators;

use Hkm3r\TestsIban\Banking\Validators\AccountRecovery;


use PHPUnit\Framework\TestCase;

class AccountRecoveryTest extends TestCase
{
    public function testRecoverHiddenDigits()
    {
        $result = AccountRecovery::recoverHiddenDigits('20770024**003102575766');
        $this->assertCount(1, $result);
    }
    
    public function testInvalidRecovery()
    {
        $this->assertEmpty(AccountRecovery::recoverHiddenDigits('2077002400**3102575766'));
        $this->assertEmpty(AccountRecovery::recoverHiddenDigits('20770024***03102575766'));
    }
}