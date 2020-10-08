<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE `users` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `role_id` int(11) NOT NULL,
            `fullname` varchar(255) NOT NULL,
            `username` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `password` text NOT NULL,
            `is_active` tinyint(1) NOT NULL DEFAULT 1,
            `last_logged_in` timestamp NULL DEFAULT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT NULL,
            `deleted_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `users_FK` (`role_id`),
            CONSTRAINT `users_FK` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
