<?php
use App\Database\Database;
use App\Database\Migrations\CustomersMigration;
use App\Interfaces\AppInterface;
use App\Routes\Routes;

class App implements AppInterface
{
    public function __construct()
    {
        new Database();
    }

    public function apiRoutesInit()
    {
        header('Content-Type: application/json; charset=utf-8');
        $routes = new Routes();
        $routes->initRoutes();
        echo json_encode($routes->getResponse());
    }

    public function runMigration()
    {
        $migration = new CustomersMigration();
        $migration->up();
    }
}