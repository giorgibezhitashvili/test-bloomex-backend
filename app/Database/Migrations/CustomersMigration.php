<?php
namespace App\Database\Migrations;

use App\Database\Database;
use Illuminate\Database\Migrations\Migration;
class CustomersMigration extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $db = Database::getInstance();
        $db->query(
            "CREATE TABLE `customers` (
              `id` bigint unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
              `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
              `shared_amount` double NOT NULL DEFAULT '0',
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `customers_email_unique` (`email`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
    }
}