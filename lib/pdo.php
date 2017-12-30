<?php
//----------------------------------------------------------------------------------
//
// Adatbázis használatához szükséges funkciók
//
//----------------------------------------------------------------------------------
//
$db_handle = false;
//
//----------------------------------------------------------------------------------
  function GetMySqlLink()
  {
    global $db_handle;
    if( $db_handle )
      return $db_handle;
     
    $db_handle = new PDO('mysql:host='.DB_HOST_ONLY.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
    $db_handle -> exec("SET CHARACTER SET utf8");
    return $db_handle;
//    $db_handle->query();
//    mysqli_query($dbi_link, "SET CHARACTER SET UTF8");
//    mysqli_query($dbi_link, "SET NAMES 'UTF8'");
//    mysqli_query($dbi_link, 'SET character_set_results="UTF8"');
  }
//----------------------------------------------------------------------------------
//

//Sample query string
//$query = "UPDATE users SET name = :user_name WHERE id = :user_id";

//Sample parameters
//$params = [':user_name' => 'foobear', ':user_id' => 1001];

function pdo_build_query($string, $array) 
{
  //Get the key lengths for each of the array elements.
  $keys = array_map('strlen', array_keys($array));

  //Sort the array by string length so the longest strings are replaced first.
  array_multisort($keys, SORT_DESC, $array);

  foreach($array as $k => $v) 
  {
    //Quote non-numeric values.
    $replacement = is_numeric($v) ? $v : "'{$v}'";

    //Replace the needle.
    $string = str_replace($k, $replacement, $string);
  }

  return $string;
}
//echo build_pdo_query($query, $params);    //UPDATE users SET name = 'foobear' WHERE id = 1001
//----------
//
//
//  function CleanUpSql()
//  {
//    global $db_handle;
//    if( $db_handle != false )
//      mysqli_close($db_handle);
//    $db_handle = false;
//  }


/*    abstract class PDORepository{
        const USERNAME="root";
        const PASSWORD="";
        const HOST="localhost";
        const DB="parcial";

        private function getConnection(){
            $username = self::USERNAME;
            $password = self::PASSWORD;
            $host = self::HOST;
            $db = self::DB;
            $connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
            return $connection;
        }
        protected function queryList($sql, $args){
            $connection = $this->getConnection();
            $stmt = $connection->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }
    }

?>
<?php



// PDO, prepared statement
$pdo->prepare('SELECT * FROM users WHERE username = :username');
$pdo->execute(array(':username' => $_GET['username']));

# connect to the database
try {
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
 
  # UH-OH! Typed DELECT instead of SELECT!
  $DBH->prepare('DELECT name FROM people');
}
catch(PDOException $e) {
    echo "I'm sorry, Dave. I'm afraid I can't do that.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}



*/