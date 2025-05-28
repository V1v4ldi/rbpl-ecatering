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
        
        
        DB::unprepared("CREATE TRIGGER id_product
            BEFORE INSERT ON product
            FOR EACH ROW
            BEGIN
                IF NEW.product_id IS NULL OR NEW.product_id = '' THEN
                SET NEW.product_id = CONCAT('PRODUCT-', LPAD((SELECT IFNULL(MAX(CAST(SUBSTRING(product_id,6) AS UNSIGNED)),0)+1 FROM product), 4, '0'));
                END IF;
            END;"
        );
        
        
        DB::unprepared("CREATE TRIGGER id_cart
            BEFORE INSERT ON cart
            FOR EACH ROW
            BEGIN
                IF NEW.cart_id IS NULL OR NEW.cart_id = '' THEN
                SET NEW.cart_id = CONCAT('CART-', LPAD((SELECT IFNULL(MAX(CAST(SUBSTRING(cart_id,6) AS UNSIGNED)),0)+1 FROM cart), 4, '0'));
                END IF;
            END;"
        );
        
        
        DB::unprepared("CREATE TRIGGER id_order
            BEFORE INSERT ON `order`
            FOR EACH ROW
            BEGIN
                IF NEW.order_id IS NULL OR NEW.order_id = '' THEN
                SET NEW.order_id = CONCAT('ORDER-', LPAD((SELECT IFNULL(MAX(CAST(SUBSTRING(order_id,6) AS UNSIGNED)),0)+1 FROM `order`), 4, '0'));
                END IF;
            END;"
        );
        
        
        DB::unprepared("CREATE TRIGGER id_cart_detail
            BEFORE INSERT ON cart_detail
            FOR EACH ROW
            BEGIN
                IF NEW.cart_d_id IS NULL OR NEW.cart_d_id = '' THEN
                SET NEW.cart_d_id = CONCAT('CART_D-', LPAD((SELECT IFNULL(MAX(CAST(SUBSTRING(cart_d_id,6) AS UNSIGNED)),0)+1 FROM cart_d), 4, '0'));
                END IF;
            END;"
        );

        
        DB::unprepared("CREATE TRIGGER id_order_detail
            BEFORE INSERT ON order_detail
            FOR EACH ROW
            BEGIN
                IF NEW.order_d_id IS NULL OR NEW.order_d_id = '' THEN
                SET NEW.order_d_id = CONCAT('ORDER_D-', LPAD((SELECT IFNULL(MAX(CAST(SUBSTRING(order_d_id,6) AS UNSIGNED)),0)+1 FROM order_d), 4, '0'));
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
        DB::uprepared('DROP trigger `id_owner`');
        DB::uprepared('DROP trigger `id_admin`');
        DB::uprepared('DROP trigger `id_product`');
        DB::uprepared('DROP trigger `id_cart`');
        DB::uprepared('DROP trigger `id_cart_detail`');
        DB::uprepared('DROP trigger `id_order`');
        DB::uprepared('DROP trigger `id_order_detail`');
    }
};
