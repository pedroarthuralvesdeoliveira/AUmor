<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap{
    protected function initRoutes() {
        $routes['index'] = array(
            'route' => '/public/index',
            'controller' => 'indexController',
            'action' => 'index'
        );

        $routes['sobreNos'] = array(
            'route' => '/App/views/sobreNos',
            'controller' => 'indexController',
            'action' => 'sobreNos'
        );

        $this->setRoutes($routes);
    }
}
