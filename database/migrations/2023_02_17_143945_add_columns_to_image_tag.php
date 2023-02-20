<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('image_tag', function (Blueprint $table) {
            //
            // $table->boolean('approved')->default(0);
            // $table->tinyInteger('priority')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('image_tag', function (Blueprint $table) {
            //
            // $table->dropColumn('approved');
            // $table->dropColumn('priority');
        });
    }
};
