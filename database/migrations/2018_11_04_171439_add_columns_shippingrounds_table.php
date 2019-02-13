<?php

use App\Models\Shippinground;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsShippingroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shippingrounds', function (Blueprint $table) {
            $table->integer('sorting_id');
            $table->string('file1')->nullable();
            $table->string('file2')->nullable();
            $table->string('file3')->nullable();
        });
        foreach (Shippinground::all() as $key => $item) {
            $item->sorting_id = $key + 1;
            $item->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shippingrounds', function (Blueprint $table) {
            $table->dropColumn('sorting_id');
            $table->dropColumn('file1');
            $table->dropColumn('file2');
            $table->dropColumn('file3');
          
        });
    }
}
