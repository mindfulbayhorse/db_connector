<?php
declare(strict_types=1);
namespace dbConnector;
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

/**
 * Tests for RSS reader functionality to ensure than no changes 
 * in the future code would distruct the class
 * 
 * @covers DBconnector
 * 
 */
final class SQLiteConnectorTest extends TestCase
{
    use TestCaseTrait;

    
    public $testDataDir="/vagrant/code/public/samples/php_code/dbConnector/tests/data/sqliteConnector/";
    
    public $DBStructureTest='feeds.xml';
    
    public $DBStructure=[];
    
    public $DBStructureSQL='sql_structure.txt';
    
    public $DBInsertSQL='sql_insert.txt';
    
    public $DBName='rssFeeds.db';
    
    public $newRowdata="FeedsRowStructure.xml";

    /**
     * @return PHPUnit\DbUnit\Database\Connection
     */
    public function getConnection()
    {
        $this->DBStructure=array('feeds'=>
                            array('fields'=>
                              array('id'=>
                                  array('type'=>'int',
                                        'key'=>true,
                                        'auto'=>true),
                                    'name_feed'=>
                                  array('title'=>'Title',
                                        'hint'=>'The title of the feed',
                                        'type'=>'string'),
                                    'url_feed'=>
                                  array('title'=>'URL address of the feed',
                                        'required'=>true,
                                        'type'=>'string'),
                                    'desc_feed'=>
                                  array('title'=>'Description for RSS feed',
                                        'type'=>'string'),
                                    'id_category'=>
                                  array('title'=>'Category of the feed',
                                        'relation'=>'category',
                                        'key_field'=>'id',
                                        'type'=>'int')
                                  ),
                               'relations'=>
                                    array('category'=>'id_category'),
                                ),
                           'category'=>
                            array('fields'=>
                                array('id'=>
                                  array('title'=>'ID',
                                        'type'=>'INT',
                                        'key'=>'PRIMARY KEY',
                                        'auto'=>'AUTO_INCREMENT'),
                                      'name_category'=>
                                  array('title'=>'The title of new category',
                                        'required',
                                        'type'=>'CHAR(255)'),
                                    'desc_category'=>
                                  array('title'=>'Short description for new category',
                                        'type'=>'TEXT'),
                                )
                            ));
        $classRSS = new SQLite3Connector($this->DBStructure,$this->testDataDir,$this->DBName);
        $pdo = new \PDO('sqlite:'.$this->testDataDir.$this->DBName);
        return $this->createDefaultDBConnection($pdo, $this->testDataDir.$this->DBName);
    }
    
    /**
     * @return PHPUnit\DbUnit\DataSet\IDataSet
     */
    public function getDataSet()
    {
        return $this->createXmlDataSet($this->testDataDir.$this->DBStructureTest);
    }
    
    
    public function testDirSet()
    {
        $this->assertDirectoryExists($this->testDataDir,$this->testDataDir);
    }
        
    /**
     * @return indication if the file for SQLite DB exists or the message if it doesn't
     */
    public function testConctructorDBExists()
    {
      $classRSS = new SQLite3Connector($this->DBStructure,$this->testDataDir,$this->DBName);
      $this->assertFileExists($this->testDataDir.$this->DBStructureTest,$this->testDataDir.$this->DBStructureTest);
    }
    
    public function testDBStructureSQL()
    {
        $classRSS = new SQLite3Connector($this->DBStructure,$this->testDataDir,$this->DBName);
        if(file_exists($this->testDataDir.$this->DBStructureSQL))
        {
            $linesSQL = file($this->testDataDir.$this->DBStructureSQL);

            $this->assertEquals($classRSS->buildCreateSQL('feeds'),rtrim($linesSQL[0]),$classRSS->buildCreateSQL('feeds'));
        }
    }
    
    
    public function testBuildSqlInsertCorrect()
    {
        $classRSS = new SQLite3Connector($this->DBStructure,$this->testDataDir,$this->DBName);
        $querySQL=$classRSS->buildInsertSQL('feeds',array(
                                                'name_feed'=>'Laravel',
                                                'url_feed'=>'https://rss.simplecast.com/podcasts/1356/rss',
                                                'desc_feed'=>'Laravel blog'));
        $this->assertStringEqualsFile($this->testDataDir.$this->DBInsertSQL, $querySQL);
    }
    
    
    
    public function testSaveFeedWorks()
    {
        $classRSS = new SQLite3Connector($this->DBStructure,$this->testDataDir,$this->DBName);
        $newRow=$classRSS->insertEntry('feeds',array('name_feed'=>'Everyday grammar',
                                                'url_feed'=>'https://learningenglish.voanews.com/api/zoroqqegtoqq',
                                                'desc_feed'=>'Tips for English leaners about details in speaking English'));
        $this->assertNotFalse($newRow);
    }
    
    public function testRowCountNewFeeds()
    {
        $this->assertSame(3, $this->getConnection()->getRowCount('feeds'), "Pre-Condition");

        $guestbook = new SQLite3Connector($this->DBStructure,$this->testDataDir,$this->DBName);
        $guestbook->insertEntry('feeds',array('name_feed'=>'Laravel',
                                          'url_feed'=>'https://rss.simplecast.com/podcasts/1356/rss',
                                          'desc_feed'=>'Laravel blog'));

        $this->assertSame(4, $this->getConnection()->getRowCount('feeds'), "Inserting failed");
    }
    
    
   public function testStructureFieldsTheSameTrue()
    {
        $guestbook = new SQLite3Connector($this->DBStructure,$this->testDataDir,$this->DBName);
        $guestbook->insertEntry('feeds',array('name_feed'=>'Everyday grammar',
                                            'url_feed'=>'https://learningenglish.voanews.com/api/zoroqqegtoqq',
                                            'desc_feed'=>'Tips for English leaners about details in speaking English'));
        
        $guestbook->insertEntry('feeds',array( 'name_feed'=>'Laravel',
                                            'url_feed'=>'https://rss.simplecast.com/podcasts/1356/rss',
                                            'desc_feed'=>'Laravel blog'));
                                            
        $guestbook->insertEntry('feeds',array( 'name_feed'=>'Naked Security',
                                            'url_feed'=>'https://nakedsecurity.sophos.com/feed/',
                                            'desc_feed'=>'Computer Security News, Advice and Research'));
                                            
                                            
                                  
        $queryTable = $this->getConnection()->createQueryTable(
            'feeds', 'SELECT name_feed, url_feed, desc_feed FROM feeds'
        );

        $expectedTable = $this->createFlatXmlDataSet($this->testDataDir.$this->newRowdata)
            ->getTable("feeds");
                              
                              
        $this->assertTablesEqual($expectedTable, $queryTable);
        
    }
    
    
    
      

    
    
}

?>