<?php
declare(strict_types=1);
namespace factoryDB;
/**
 * Class for implementing validation parameters for database connection
 * @author Olga Zhilkova
 * @copyright 2017
 */
class DBconnector extends SingleDBConnection
{
    protected $host='';
    protected $user='';
    protected $password='';
    protected $dns='';
    
    public $messerror='';
    public $dbname='';
    
    const HOST='host';
    const DBNAME='dbname';
    const DEFAULT_HOST='localhost';
    
    public function getDnsfromString(string $par_type, string $par_val)
    {
        $result=true;
        
        switch ($par_type)
        {
            case self::HOST:
                $this->ensureHostIsValid($par_val);
                $this->host=$par_val;
                break;
            case self::DBNAME:
                $this->dbname=$par_val;
                break;
            default:
                $this->messerror='Parameter is not found!';
                $result=false;
        }
        return $result;
    }
    
    public function DnsasString($par_type): string
    {
        switch ($par_type)
        {
            case self::HOST:
                return $this->host;
                break;
            case self::DBNAME:
                return $this->dbname;
                break;
            default:
                echo 'Parameter is not found!';
        }
    }
    
    public function getDns(): string
    {
        
    }
    
    private function getUsername(string $usename): string
    {
        $this->username=$username;
    }
    
    private function getPassword(string $password): string
    {
        $this->password=$password;
    }
    
    private function ensureHostIsValid(string $host): void
    {
        if($host!==self::DEFAULT_HOST)
        {
            if (!filter_var($host, FILTER_VALIDATE_IP))
            {
                throw new InvalidArgumentException(
                    sprintf('"%s" is not a valid IP address',
                    $host
                    )
                );
            }
        }

    }
    
    public function checkParams()
    {
      
    }
    
    

}




?>