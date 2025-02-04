<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNepaliDateColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('morning_milks', function (Blueprint $table) {
            $table->string('np_date')->after('insert_date')->nullable();
        });

        Schema::table('evening_milks', function (Blueprint $table) {
            $table->string('np_date')->after('insert_date')->nullable();
        });

        Schema::table('advances', function (Blueprint $table) {
            $table->string('np_date')->after('settle_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('morning_milks', function (Blueprint $table) {
            $table->dropColumn('np_date');
        });

        Schema::table('evening_milks', function (Blueprint $table) {
            $table->dropColumn('np_date');
        });

        Schema::table('advances', function (Blueprint $table) {
            $table->dropColumn('np_date');
        });
    }
}
