<?php
declare(strict_types=1);
namespace factoryDB;
use PHPUnit\Framework\TestCase;
/**
 * @covers DBconnector
 */
final class DBconnectorTest extends TestCase
{
    public function testHostCannotBeCreatedFromInvalidIPAddress(): void
    {
        $expected = new DBconnector;
        $this->expectException(InvalidArgumentException::class);

        $expected->getDnsfromString('host','justtext');
    }

    public function testgetDnsfromStringParameterIsCreated(): void
    {
        $expected = new DBconnector;
    
        $expected->getDnsfromString('dbname','testdb');
        //$this->assertObjectHasAttribute('foo', new stdClass);
        $this->assertEquals($expected->dbname, "testdb");
    }
    
     public function testgetDnsfromStringParameterIsNotFound(): void
    {
        $expected = new DBconnector;
        $expected->getDnsfromString('anystring','Parameter is not found!');
        $this->assertEquals($expected->messerror, "Parameter is not found!");
    }
}




?>