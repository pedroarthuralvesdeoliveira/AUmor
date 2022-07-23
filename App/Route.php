<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap{
    protected function initRoutes() {
        $routes['index'] = array(
            'route' => '/AUmor/public/index',
            'controller' => 'indexController',
            'action' => 'index'
        );

        $routes['sobreNos'] = array(
            'route' => '/AUmor/App/views/sobreNos',
            'controller' => 'indexController',
            'action' => 'sobreNos'
        );

        $this->setRoutes($routes);
    }
}
