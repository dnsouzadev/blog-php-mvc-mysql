<?php

abstract class Connect {
  
  private static $conn;
  
  public static function getConn() {

    if (self::$conn == null) {
      self::$conn = new PDO('mysql: host=localhost; dbname=bd_site;', 'root', '');
    }

    return self::$conn;
  }
}