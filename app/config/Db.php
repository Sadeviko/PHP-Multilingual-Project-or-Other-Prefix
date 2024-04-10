<?php

namespace app\config;

use PDO;

class Db {

  public static function сonnect() {
    $connect = new PDO('mysql:host=localhost;port=3306;dbname=pf', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $connect->exec("set names utf8");
    return $connect;
  }
}
