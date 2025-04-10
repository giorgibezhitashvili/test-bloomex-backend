<?php

namespace App\Routes;
use App\Interfaces\RoutesInterface;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
class Routes implements RoutesInterface
{
    private $router;
    private $dispatcher;
    public function __construct()
    {
        $this->router = new RouteCollector();
    }

    public function getResponse(){
        $this->dispatcher = new Dispatcher($this->router->getData());
        return $this->dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }

    public function initRoutes(){
        $this->router->get('test', ['App\Controllers\CustomersController', 'test']);
        $this->router->get('/customers',['App\Controllers\CustomersController', 'index']);
        $this->router->post('/add-customer',['App\Controllers\CustomersController', 'addCustomer']);
        $this->router->delete('/reset-customers',['App\Controllers\CustomersController', 'resetCustomers']);
    }
}