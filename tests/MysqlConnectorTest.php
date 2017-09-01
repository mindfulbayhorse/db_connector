<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
/**
 * @covers mysqlConnector
 */
final class MysqlconnectorTest extends TestCase
{
    public function testHostCannotBeCreatedFromInvalidIPAddress(): void
    {
        $expected = new Mysqlconnector;
        $this->expectException(InvalidArgumentException::class);

        $expected->getDnsfromString('host','justtext');
    }

    public function testgetDnsfromStringParameterIsCreated(): void
    {
        $expected = new Mysqlconnector;
    
        $expected->getDnsfromString('dbname','testdb');
        //$this->assertObjectHasAttribute('foo', new stdClass);
        $this->assertEquals($expected->dbname, "testdb");
    }
    
     public function testgetDnsfromStringParameterIsNotFound(): void
    {
        $expected = new Mysqlconnector;
        $expected->getDnsfromString('anystring','Parameter is not found!');
        $this->assertEquals($expected->messerror, "Parameter is not found!");
    }
}




?>