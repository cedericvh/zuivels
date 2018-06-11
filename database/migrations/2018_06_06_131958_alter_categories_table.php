<?php

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCategoriesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('sorting_id')->after('title')->nullable();
        });
        foreach (Category::all() as $key => $item) {
            $item->sorting_id = $key + 1;
            $item->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('sorting_id');
        });
    }
}
