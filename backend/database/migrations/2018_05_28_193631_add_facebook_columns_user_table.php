<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacebookColumnsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->unsignedBigInteger('fb_id')->unique()->nullable();
            $table->string('first_name')->after('fb_id');
            $table->string('last_name')->after('first_name');
            $table->string('email')->nullable()->change();
            $table->text('facebook_token')->after('remember_token')->nullable();
            $table->text('profile_pic')->after('facebook_token');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
