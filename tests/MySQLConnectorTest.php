<?php
declare(strict_types=1);
namespace dbConnector;
use PHPUnit\Framework\TestCase;
/**
 * Class for implementing validation parameters for database connection
 * @author Olga Zhilkova
 * @copyright 2017
 */
final class MySqlConnectorTest extends TestCase
{
    
    /**
     * @dataProvider additionDBNameAllowedProvider
     */
    public function testValidDBNameWithRegExpr($dbName)
    {
         $this->assertRegExp('/^[a-zA-Z]+[\w\$]*(?(?<=[_]|[\$])[a-zA-Z\d]+)$/', $dbName);     
    }
    
    
    /**
     *   @dataProvider additionDBNameRestrictedProvider
     */
    public function testWrongDBNameWithRegExpr($dbName)
    {
        $this->assertNotRegExp('/^[a-zA-Z]+[\w\$]*(?(?<=[_]|[\$])[a-zA-Z\d]+)$/', $dbName);
    }
    
    
    public function additionDBNameAllowedProvider()
    {
        return [
            'Only one first alphabetic symbol'=>['w'],
            'Only one first large alphabetic symbol'=>['T'],
            'String ends with digital number'=>['T4'],
            'String contains dollar'=>['T$w'],
            'String contains space symbol'=>['T_4'],
            'String contains space symbol, dollar in the middle and digital number at the end'=>['T_$4'],
        ];
    }

    public function additionDBNameRestrictedProvider()
    {
        return [
            'String ends with dollar'=>['T$'],
            'String ends with space symbol'=>['T_'],
            'String contains only one restricted symbol'=>['1'],
        ];
    }
    
}

?>