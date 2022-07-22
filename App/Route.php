<?php

    namespace App;

    class Route {
        public function initRouter() {
            $routes['index'] = array(
                'route' => '/AUmor/public/',
                'controller' => 'indexController',
                'action' => 'index'
            );
            $routes['sobreNos'] = array(
                'route' => '/AUmor/public/',
                'controller' => 'indexController',
                'action' => 'sobreNos'
            );
        }
        
        public function getUrl() {
            return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        }
    }

?>