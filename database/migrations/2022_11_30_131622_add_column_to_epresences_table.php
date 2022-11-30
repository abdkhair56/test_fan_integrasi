<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToEpresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('epresences', function (Blueprint $table) {
            $table->boolean('status_in')->nullable();
            $table->boolean('status_out')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('epresences', function (Blueprint $table) {
            $table->dropColumn('status_in');
            $table->dropColumn('status_out');
        });
    }
}
