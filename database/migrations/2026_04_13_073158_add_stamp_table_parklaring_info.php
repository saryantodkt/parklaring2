<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStampTableParklaringInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parklaring_info', function (Blueprint $table) {
            $table->integer('entity_stamp_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parklaring_info', function (Blueprint $table) {
            $table->dropColumn('entity_stamp_id');
        });
    }
}
