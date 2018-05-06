<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnevtPrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enevt_prizes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('events_id')->comment('活动id');
            $table->string('name')->comment('奖品名称');
            $table->text('description')->comment('奖品详情');
            $table->unsignedInteger('member_id')->default(0)->comment('中奖商家账号id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enevt_prizes');
    }
}
