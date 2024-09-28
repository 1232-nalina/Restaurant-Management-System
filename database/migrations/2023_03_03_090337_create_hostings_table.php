<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hosting_cat_id')->unsigned()->index();
            $table->foreign('hosting_cat_id')->references('id')->on('hosting_categories')->onDelete('CASCADE');
            $table->bigInteger('domain_id')->unsigned()->index()->nullable();
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('CASCADE');
            $table->string('external_domain')->nullable();
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->bigInteger('client_id')->unsigned()->index();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('CASCADE');
            $table->string('selling_price');
            $table->enum('status', ['active', 'inactive'])->default('active');

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
        Schema::dropIfExists('hostings');
    }
}
