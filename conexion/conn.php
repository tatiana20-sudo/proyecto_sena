<?php

class Database
{

  private static $dbhost = "localhost";
  private static $dbname = "proyecto_sena";
  private static $dbuser = "root";
  private static $dbpass = "";

  public static function conectar()
  {
    try {
      $con = new PDO("mysql:host=" . self::$dbhost . ";dbname=" . self::$dbname, self::$dbuser, self::$dbpass);

      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $con;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}
