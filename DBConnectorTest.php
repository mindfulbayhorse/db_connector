<?php

/**
 * Tests for any DB connection abstract basic class
 * @author Olga Zhilkova
 * @copyright 2017
 */


declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @covers DBConnector
 */
final class DBconnectorTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $this->assertInstanceOf(
            Email::class,
            Email::fromString('user@example.com')
        );
    }

    public function testCannotBeCreatedFromInvalidEmailAddress(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Email::fromString('invalid');
    }

    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com',
            Email::fromString('user@example.com')
        );
    }
}


?>