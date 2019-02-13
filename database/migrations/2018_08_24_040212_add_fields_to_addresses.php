<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('telephone')->nullable()->after('address2');
            $table->integer('shippinground_id')->default(0)->unsigned()->after('telephone');
            $table->string('fax')->nullable()->after('telephone');
            $table->string('remark')->nullable()->after('fax');
            $table->boolean('exists')->default(false)->after('remark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('telephone');
            $table->dropColumn('shippinground_id');
            $table->dropColumn('fax');
            $table->dropColumn('remark');
            $table->dropColumn('exists');
        });
    }
}
