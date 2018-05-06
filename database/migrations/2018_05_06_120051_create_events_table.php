<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('名称');
            $table->text('content')->comment('详情');
            $table->integer('signup_start')->comment('报名开始时间');
            $table->integer('signup_end')->comment('报名结束时间');
            $table->date('prize_date')->comment('开奖日期');
            $table->integer('signup_num')->default(10000)->comment('报名人数限制');
            $table->integer('is_prize')->default(0)->comment('是否已开奖');
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
        Schema::dropIfExists('events');
    }
}
