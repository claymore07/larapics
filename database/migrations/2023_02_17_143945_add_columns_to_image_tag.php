<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_tag', function (Blueprint $table) {
            //
            // $table->boolean('approved')->default(0);
            // $table->tinyInteger('priority')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_tag', function (Blueprint $table) {
            //
            // $table->dropColumn('approved');
            // $table->dropColumn('priority');
        });
    }
};
