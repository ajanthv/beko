<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_outgoing_notification_queue', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('badge');
            $table->integer('created_by_id');
            $table->string('notification_token', 255);
            $table->string('os_type', 100);
            $table->string('sound', 50);
            $table->string('title', 100);
            $table->text('message');
            $table->dateTime('send_date')->nullable();
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
        Schema::drop('trn_outgoing_notification_queue');
    }
}
