<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20)->comment('姓名');
            $table->string('sex',5)->comment('性别');
            $table->string('mobile',15)->unique()->comment('手机号');
            $table->string('email',20)->comment('姓名');
            $table->string('stuid',20)->comment('学号');
            $table->string('department',20)->comment('学院');
            $table->string('major',20)->comment('专业');
            $table->string('remark',200)->nullable()->comment('备注');
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
        Schema::dropIfExists('students');
    }
}
