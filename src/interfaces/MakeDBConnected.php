<?php
declare(strict_types=1);
/**
 * @author Olga Zhilkova
 * @copyright 2018
 */

namespace dbConnector;

interface MakeDBConnected
{
  
    public function dbConnect(string $dns):bool;
    
    private function validateParams(): bool;
    
    public function dbCreate(array $dbStructure):bool;
    
    public function insertEntry(string $tablename, array $requestFields): bool;
    
}

?>