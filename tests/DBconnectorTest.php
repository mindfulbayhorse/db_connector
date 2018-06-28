<?php
declare(strict_types=1);
namespace factoryDB;
use PHPUnit\Framework\TestCase;
/**
 * @covers DBconnector
 */
final class DBconnectorTest extends TestCase
{
   
    public function testBuildPatternDBName()
    {
      $classDB = new DBconnector;
      $patternDB=$classDB->buildPattern('dbname');
      $this->AssertEquals($patternDB,'^[a-zA-Z]+([_\$]+[a-z\d]+)|([a-zA-z\d]*)$');
    }
    
    public function testGetParamFromStringWrongDBnameDigitFirst(): void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('dbname','1');
        $this->assertEquals($classDB->params['dbname'], "");
    }
    
    public function testGetParamFromStringRestrictedLastSymbolDBname(): void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('dbname','d_');
        $this->assertEquals($classDB->params['dbname'], "");
    }
    
    
    public function testGetParamFromStringDBnameLength(): void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('dbname','d');
        $this->assertEquals($classDB->params['dbname'], 'd');
    }    

    
    public function testGetParamFromStringDBnameDigitWords(): void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('dbname','d2$d_f');
        $this->assertEquals($classDB->params['dbname'], "d2\$d_f");
    }
    
    public function testGetParamFromStringDBnameDigitFirst(): void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('dbname','1d');
        $this->assertEquals($classDB->params['dbname'], "1d");
    }
    
    public function testGetParamFromStringDBnameDollarFirst(): void
    {
        $classDB = new DBconnector;
        $classDB->getParamFromString('dbname','$d');
        $this->assertEquals($classDB->params['dbname'], "");
    }
    
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