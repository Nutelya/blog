<?php
class DBFactory
{
  public static function getMysqlConnexionWithPDO()
  {
    $db = new PDO('mysql:host=salucinouvaxia.mysql.db;dbname=salucinouvaxia', 'salucinouvaxia', 'Alliance3738');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $db;
  }
}
