<?php
// ----------------------------------------------------------------------------------
//
// ----------------------------------------------------------------------------------
  define("DB_HOST_ONLY",  'localhost');
  define("DB_PORT",       '3306');
  define("DB_HOST",        DB_HOST_ONLY.":".DB_PORT);
  define("DB_NAME",       'olvasas');
  define("DB_USER",       'olvasas');
  define("DB_PASSWORD",   '');


// ----------------------------------------------------------------------------------
  function var_null($valtozo)
  {
    return (($valtozo == "")?0:$valtozo);
  }
// ----------------------------------------------------------------------------------
  function print_POST()
  {
    echo "\$_POST változói: <br />\n";

    foreach($_POST as $key => $value)
    {
      echo "$key: $_POST[$key]<br />\n";
    }
    echo "<br />\n";
  }
// ----------------------------------------------------------------------------------
  function print_GET()
  {
    echo "\$_GET változói: <br />\n";

    foreach($_GET as $key => $value)
    {
      echo "$key: $_GET[$key]<br />\n";
    }
    echo "<br />\n";
  }
// ----------------------------------------------------------------------------------
  function print_SESSION()
  {
    echo "\$_SESSION változói: <br />\n";

    foreach($_SESSION as $key => $value)
    {
      echo "$key: $_SESSION[$key]<br />\n";
    }
    echo "<br />\n";
  }
// ----------------------------------------------------------------------------------
  function print_SERVER()
  {
    echo "\$_SERVER változói: <br />\n";

    foreach($_SERVER as $key => $value)
    {
      echo "$key: $_SERVER[$key]<br />\n";
    }
    echo "<br />\n";
  }
// ----------------------------------------------------------------------------------
  function print_COOKIE()
  {
    echo "\$_COOKIE változói: <br />\n";

    foreach($_COOKIE as $key => $value)
    {
      echo "$key: $_COOKIE[$key]<br />\n";
    }
    echo "<br />\n";
  }
// ----------------------------------------------------------------------------------
