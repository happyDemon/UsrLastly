<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsrlastlyDatabase extends Migration
{
    public function up()
    {
        Schema::create('user_last_seen', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('request')->nullable();
            $table->timestamp('date');
        });

    }

    public function down()
    {
        Schema::table('user_last_seen', function(Blueprint $table)
        {
            Schema::dropIfExists('quill_categories');
        });
    }
}
