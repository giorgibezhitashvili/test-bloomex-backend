<?php

namespace App\Controllers;

use App\Services\CustomerService;

class CustomersController
{
    private $customerService;
    public function __construct()
    {
        $this->customerService = new CustomerService();
    }

    public function index(){
        return $this->customerService->getCustomers();
    }

    public function addCustomer(){
        $name = $_POST['name'];
        $email = $_POST['email'];

        if(empty($name)){
            return ['error'=>'Name cannot be empty'];
        }

        if(empty($email)){
            return ['error'=>'Email cannot be empty'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['error'=>'Invalid email format'];
        }

        $checkCustomer = $this->customerService->getCustomerByEmail($email);

        if(!empty($checkCustomer)){
            return ['error'=>'This email is already in use'];
        }

        return $this->customerService->addCustomer(['name'=>$name,'email'=>$email]);
    }

    public function resetCustomers(){
        $this->customerService->resetCustomers();
        return ['success' => true];
    }
}