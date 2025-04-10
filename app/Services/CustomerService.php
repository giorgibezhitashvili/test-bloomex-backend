<?php

namespace App\Services;

use App\Database\Database;
use App\Interfaces\CustomerServiceInterface;

class CustomerService implements CustomerServiceInterface
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function getCustomers(){
        return $this->db->query("SELECT * FROM customers");
    }

    public function getCustomersCount(){
        $res = $this->db->query("SELECT COUNT(*) as cnt FROM customers", [], true);
        return $res['cnt'];
    }

    public function addCustomer($data){

        $res =$this->db->query("INSERT INTO customers (name, email) VALUES (:name, :email)", [":name" => $data['name'], ":email" => $data['email']]);
        $this->updateCustomersShareAmount();
        return $res;
    }

    public function updateCustomersShareAmount(){
        $customersCount = $this->getCustomersCount();
        return $this->db->query("UPDATE customers SET shared_amount = :amount", ['amount' => 100 / $customersCount]);
    }

    public function resetCustomers(){
        return $this->db->query("DELETE FROM customers");
    }

    public function getCustomerByEmail($email){
        return $this->db->query("SELECT * FROM customers WHERE email = :email", ['email' => $email], true);
    }
}
