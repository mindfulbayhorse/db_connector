<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @covers FactoryDBConnecter
 */
final class FactoryDBConnecterTest extends TestCase
{
    public function testParCanBeCreatedFromValidString(): void
    {
        $this->assertInstanceOf(
            FactoryDBConnecter::class,
            FactoryDBConnecter::fromString('mysql')
        );
    }


    public function testparCanBeUsedAsString(): void
    {
        $this->assertEquals('postgresql',
            FactoryDBConnecter::fromString('postgresql')
        );
    }
}


?>