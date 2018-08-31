<?php
declare(strict_types=1);
namespace dbConnector;
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
      $this->AssertEquals($patternDB,'^[a-zA-Z]+(?([_\$]+)[a-zA-Z\d]+|([a-zA-z\d]*))$');
    }
    
    
    /*public function testGetParamFromStringWrongDBnameOneSymbolony(): void
    {
      $classDB = new DBconnector;
      $this->assertRegExp('/^[a-zA-Z]+(?([_\$]+)[a-zA-Z\d]+|([a-zA-z\d]*))$/', 'd');
    }
    
    public function testGetParamFromStringWrongDBnameDollarSpace(): void
    {
      $classDB = new DBconnector;
      $this->assertRegExp('/^[a-zA-Z]+(?([_\$]+)[a-zA-Z\d]+|([a-zA-z\d]*))$/', 'd2$d_f');
    }
    
    public function testGetParamFromStringWrongDBnameFailer1(): void
    {
      $classDB = new DBconnector;
      $this->assertRegExp('/^[a-zA-Z]+[a-zA-z\d]*(?([_\$]+)[a-zA-Z\d]+)$/', 'd2_');
    }*/
    
    public function testGetParamFromStringWrongDBnameFailer2(): void
    {
      $classDB = new DBconnector;
      $this->assertRegExp('/^[a-zA-Z]+[\w\$]*(?(?<=[_]|[\$])[a-zA-Z\d]+)$/', 'd_$rf_$5f');
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