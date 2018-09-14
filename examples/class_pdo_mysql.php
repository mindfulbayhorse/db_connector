<?
error_reporting(E_STRICT);


class SimpleClass
{
    // host name
    //public $host_name = 'localhost';
	// user name
    //public $user_name = 'root';
	// database name
    //public $user_name = 'database';
	// password for user
    //public $user_name = 'password';

    // method to make connection to database
    public function connectDatabase() {
		$dsn = 'mysql:host=localhost;dbname=ad_ekodar_db';
		$username = 'ekodardbuser';
		$password = '6tgrft_YH';
		$options = array();
    try
		{
		  $dbh = new PDO($dsn, $username, $password,$options);
		  echo "Connected<p>";
		}
		catch (Exception $e)
		{
		  echo "Unable to connect: " . $e->getMessage() ."<p>";
		}
    }
}

 $obj = new SimpleClass(); 
 $obj->connectDatabase(); 

?>
