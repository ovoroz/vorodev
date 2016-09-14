<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'vorodev');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'my_vorodev');
define("BASE_URL", "http://vorodev.altervista.org/");

/*function getDB()
  { */
  $dbhost=DB_SERVER;
  $dbuser=DB_USERNAME;
  $dbpass=DB_PASSWORD;
  $dbname=DB_DATABASE;
    try  {
      $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser, $dbpass);
      $dbConnection->exec("set names utf8");
      $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      /*return $dbConnection;*/
      }
    catch (PDOException $e) 
    {
      echo 'Connection Failed: '. $e->getMessage();
    }
  /*}*/
    include_once './class/userClass.php';
    include_once 'common.php';
    /*$dbconn = getDB();*/
    $user = new userClass($dbConnection);

?>