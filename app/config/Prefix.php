<?php

namespace app\config;

//use PDO;

/* Name cookie for PREFIX */
define('PREFIX', 'prefix');

class Prefix {

    static function list() {
        /* $query = Db::сonnect()->prepare('SELECT `id`, `code` FROM `lang` ORDER BY `default` DESC');
          $query->execute();
          $result = $query->fetchAll(PDO::FETCH_KEY_PAIR); */

        /* $query = Db::сonnect()->prepare('SELECT * FROM `lang` ORDER BY `default` DESC');
          while ($item = $query->fetch(PDO::FETCH_LAZY)) {
          $result[$item['id']] = $item['code'];
          } */

        $result = ['1' => 'en', '2' => 'ru'];

        //$result = [];

        return $result;
    }

    static function id($prefix) {
        $id = array_search($prefix, self::list());

        return $id;
    }

}
