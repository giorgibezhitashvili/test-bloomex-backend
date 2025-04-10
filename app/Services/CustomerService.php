<?php

namespace App\Services;

use App\Interfaces\CustomerServiceInterface;
use App\Models\Customer;

class CustomerService implements CustomerServiceInterface
{
    public function getCustomers(){
        return Customer::all();
    }

    public function getCustomersCount(){
        return Customer::count();
    }

    public function addCustomer($data){
        $customer = new Customer();
        $customer->name = $data['name'];
        $customer->email = $data['email'];
        $customer->save();

        $this->updateCustomersShareAmount();
        return Customer::find($customer->id);
    }

    public function updateCustomersShareAmount(){
        $customersCount = $this->getCustomersCount();
        Customer::query()->update(['shared_amount' => 100 / $customersCount]);
    }

    public function resetCustomers(){
        Customer::query()->delete();
    }

    public function getCustomerByEmail($email){
        return Customer::query()->where('email', $email)->first();
    }
}
