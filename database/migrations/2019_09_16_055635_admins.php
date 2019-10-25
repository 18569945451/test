<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Admins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('昵称');
            $table->string('mobile', 20)->unique();
            $table->string('password')->comment('密码');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态：默认为1，激活');
            $table->string('api_token', 64)->nullable()->comment('登录验证');
            $table->softDeletes();
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
