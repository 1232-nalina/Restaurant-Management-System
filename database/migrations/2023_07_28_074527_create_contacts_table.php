<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('email');
            $table->string('phone_one');
            $table->string('phone_two')->nullable();
            $table->text('logo');
            $table->text('fab_icon')->nullable();
            $table->string('banner_image')->nullable();
            $table->text('google_map')->nullable();
            $table->string('facebook_link');
            $table->string('instagram_link');
            $table->string('twitter_link')->nullable();
            $table->string('gmail_link')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
