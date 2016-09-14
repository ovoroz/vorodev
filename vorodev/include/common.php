<?php 
session_start();
header('Cache-control: private'); // IE 6 FIX

if(isset($_GET['lang']))
{
  $lang = $_GET['lang'];
  
  $_SESSION['lang'] = $lang;
  
  setcookie('lang', $lang, time() + (3600 * 24 * 30 * 12)); // 1 Year
}
else if(isset($_SESSION['lang']))
{
  $lang = $_SESSION['lang'];
}
else if(isset($_COOKIE['lang']))
{
  $lang = $_COOKIE['lang'];
}
else
{
  $lang = 'en';
}

switch ($lang) {
  case 'en':
    $lang_file = 'lang_en.php';
    break;
    
  case 'it':
    $lang_file = 'lang_it.php';
    break;
    
  default:
    $lang_file = 'lang_en.php';
}

include_once 'lang/' .$lang_file;
?>