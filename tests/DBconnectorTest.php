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
        $classDB = new DBconnector;
        $this->expectException(InvalidArgumentException::class);

        $classDB->getParamFromString('host','justtext');
    }

    public function testgetfromStringParameterIsCreated(): void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('dbname','testdb');
        //$this->assertObjectHasAttribute('foo', new stdClass);
        $this->assertEquals($classDB->params['dbname'], "testdb");
    }
    
    public function testgetDnsfromStringParameterIsNotFound(): void
    {
        $classDB = new DBconnector;
        $this->assertFalse($classDB->getParamFromString('anystring','anyvalue'));
    }
    
    public function testgetParamFromStringEmpty(): void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('dbname','');
        $this->assertEquals($classDB->params['dbname'], "");
    }
    
    /*public function testgetParamisNotFound(): string
    {
      $classDB= new DBconnector;
      $classDB->getParam('anystring','enyvalue');
      $this->assertFalse($classDB->messerror, "Parameter is not found!");
    }*/
}




?>