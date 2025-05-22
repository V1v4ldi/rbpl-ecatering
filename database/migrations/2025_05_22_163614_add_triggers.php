<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("CREATE TRIGGER id_customer
            BEFORE INSERT ON customer
            FOR EACH ROW
            BEGIN
                IF NEW.customer_id IS NULL OR NEW.customer_id = '' THEN
                SET NEW.customer_id = CONCAT('CUST-', LPAD((SELECT IFNULL(MAX(CAST(SUBSTRING(customer_id,6) AS UNSIGNED)),0)+1 FROM customer), 4, '0'));
                END IF;
            END;"
        );
        DB::unprepared("CREATE TRIGGER id_admin
            BEFORE INSERT ON admin
            FOR EACH ROW
            BEGIN
                IF NEW.admin_id IS NULL OR NEW.admin_id = '' THEN
                SET NEW.admin_id = CONCAT('ADMIN-', LPAD((SELECT IFNULL(MAX(CAST(SUBSTRING(admin_id,6) AS UNSIGNED)),0)+1 FROM admin), 4, '0'));
                END IF;
            END;"
        );
        DB::unprepared("CREATE TRIGGER id_owner
            BEFORE INSERT ON owner
            FOR EACH ROW
            BEGIN
                IF NEW.owner_id IS NULL OR NEW.owner_id = '' THEN
                SET NEW.owner_id = CONCAT('OWNER-', LPAD((SELECT IFNULL(MAX(CAST(SUBSTRING(owner_id,6) AS UNSIGNED)),0)+1 FROM owner), 4, '0'));
                END IF;
            END;"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::uprepared('DROP trigger `id_customer`');
    }
};
