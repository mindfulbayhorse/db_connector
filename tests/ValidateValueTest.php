<?php
declare(strict_types=1);
namespace dbConnector;
use PHPUnit\Framework\TestCase;
/**
 * @covers DBconnector
 */
final class ValidateValueTest extends TestCase
{

    public function isValueValidMaxLength(): void
    {
      $classDB = new DBconnector;
      $this->assertRegExp('/^[a-zA-Z]+[\w\$]*(?(?<=[_]|[\$])[a-zA-Z\d]+)$/', 'd_$rf_$5f');
    }
    
    
}




?>