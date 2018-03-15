<?php
declare(strict_types=1);
namespace factoryDB;
use PHPUnit\Framework\TestCase;
/**
 * @covers DBconnector
 */
final class DBconnectorTest extends TestCase
{
    public function testEnsureHostIsValidFail(): void
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
        $this->assertEmpty($classDB->getParamFromString('anystring','anyvalue'));
    }
    
    public function testgetParamFromStringEmpty(): void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('dbname','');
        $this->assertEquals($classDB->params['dbname'], "");
    }
    
    public function testgetParamFromStringMessage():void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('host','incorrect');
        $this->assertNotEmpty($classDB->messerror['Error']['invalid_host']);
    }
    
    /*public function testgetParamisNotFound(): string
    {
      $classDB= new DBconnector;
      $classDB->getParam('anystring','enyvalue');
      $this->assertFalse($classDB->messerror, "Parameter is not found!");
    }*/
}




?>