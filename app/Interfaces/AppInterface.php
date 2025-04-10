<?php

namespace App\Interfaces;

interface AppInterface
{
    public function apiRoutesInit();
    public function runMigration();
}