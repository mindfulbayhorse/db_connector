<?php
declare(strict_types=1);
namespace dbConnector;
use PHPUnit\Framework\TestCase;
/**
 * @covers DBconnector
 */
final class ValidateValueTest extends TestCase
{

    public function isPatternValidMaxLength(): void
    {
      $classDB = new DBconnector;
      $this->assertTrue($classDB->isPatternValid('/^[a-zA-Z]+[\w\$]*(?(?<=[_]|[\$])[a-zA-Z\d]+)$/', 'd_$rf_$5f'),"Pattern validation is not working correctly");
    }
    
    
}




?>