<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdersTable2 extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('country')->nullable()->change();
            $table->string('address2')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('country')->change();
            $table->string('address2')->change();
        });
    }
}
