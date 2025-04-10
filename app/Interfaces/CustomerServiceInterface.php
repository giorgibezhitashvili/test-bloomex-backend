<?php

namespace App\Interfaces;

interface CustomerServiceInterface
{
    public function getCustomers();
    public function getCustomersCount();
    public function addCustomer($data);
    public function updateCustomersShareAmount();
    public function resetCustomers();
    public function getCustomerByEmail($email);
}