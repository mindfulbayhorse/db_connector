<?php
declare(strict_types=1);
namespace dbConnector;
use PHPUnit\Framework\TestCase;
/**
 * @covers DBconnector
 */
final class DBconnectorTest extends TestCase
{
      
    
    /*public function testEnsureHostIsValidFail(): void
    {
        $classDB = new DBconnector;
        $this->expectException(InvalidArgumentException::class);
        $classDB->getParamFromString('host','justtext');
    }
    
    public function testgetDnsfromStringParameterIsNotFound(): void
    {
        $classDB = new DBconnector;
        $this->assertEmpty($classDB->getParamFromString('anystring','anyvalue'));
    }
    
    
    
    public function testgetParamFromStringMessage():void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('host','incorrect');
        $this->assertNotEmpty($classDB->messerror['Error']['invalid_host']);
    }
    
    public function testGetParamFromStringDBNameFailPattern(): void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('dbname','1');
        //$this->assertObjectHasAttribute('foo', new stdClass);
        $this->assertEquals($classDB->params['dbname'], "");
    }
    
    public function testgetParamisNotFound(): string
    {
      $classDB= new DBconnector;
      $classDB->getParam('anystring','enyvalue');
      $this->assertFalse($classDB->messerror, "Parameter is not found!");
    }*/
}




?>