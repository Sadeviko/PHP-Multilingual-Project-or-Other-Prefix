<?php

namespace app\core;

use app\config\Prefix;

class Router {

    private $routes;

    function __construct() {
        $this->routes = require_once 'app/config/routes.php';
    }

    static function uri() {
        $segment = explode('/', trim(filter_input(INPUT_SERVER, 'REQUEST_URI'), '/'));
        $checklist = Prefix::list();

        if (in_array($segment[0], $checklist)) {
            $prefix = $segment[0];
            unset($segment[0]);
            //setcookie(PREFIX, $prefix, time() + 60 * 60 * 24 * 365, '/');
        } elseif (in_array(filter_input(INPUT_COOKIE, PREFIX), $checklist)) {
            $prefix = filter_input(INPUT_COOKIE, PREFIX);
        } else {
            $prefix = current($checklist);
        }

        $urn = implode('/', $segment);

        return ['prefix' => $prefix, 'urn' => $urn];
    }

    private static function params($conform, $matches) {
        //$matches[PREFIX_ID] = Prefix::id(self::uri()['prefix']);
        $matches['prefix_id'] = Prefix::id(self::uri()['prefix']);

        if (!isset($conform['action'])) {
            $conform['action'] = 'default';
        }

        foreach ($matches as $key => $value) {
            if (is_string($key) && !empty($value)) {
                $conform[$key] = $value;
            }
        }

        return $conform;
    }

    function routing() {
        $matches = NULL;
        foreach ($this->routes as $pattern => $conform) {
            if (preg_match("~^$pattern$~", self::uri()['urn'], $matches)) {
                $params = self::params($conform, $matches);
//        $file = 'app\controllers\\' . ucfirst($params['controller']) . 'Controller';
//        $action = 'action' . ucfirst($params['action']);
//        unset($params['controller'], $params['action']);
                break;
            }
        }

        debug(self::addPrefix('data'));

//    if (class_exists($file)) {
//      $controller = new $file;
//    }
//
//    if (method_exists($controller, $action)) {
//      call_user_func(array($controller, $action), $params);
//    }
    }

    static function addPrefix($data) {
        empty(Router::uri()['prefix']) ?: $segment[] = Router::uri()['prefix'];
        $segment[] = $data;

        return implode('/', $segment);
    }

//    private static function notFound() {
//        $segment[] = filter_input(INPUT_SERVER, 'HTTP_HOST');
//        empty(Router::uri()['prefix']) ?: $segment[] = Router::uri()['prefix'];
//        $url = implode('/', $segment);
//
//        header('HTTP/1.1 404 Not Found');
//        header('Status: 404 Not Found');
//        header("Location: http://$url/notfound");
//    }
}
