<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_type_id')->after('password');
            $table->string('picture_url')->nullable()->after('user_type_id');
            $table->string('twitter_id')->nullable()->after('picture_url');
            $table->string('instagram_id')->nullable()->after('twitter_id');
            $table->string('line_notify_access_token')->nullable()->after('instagram_id');
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
