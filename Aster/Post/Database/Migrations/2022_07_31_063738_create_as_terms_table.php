<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_terms', function (Blueprint $table) {
            $table->bigIncrements('term_id');
            $table->string('name', 200)->default('')->index('name');
            $table->string('slug', 200)->default('')->index('slug');
            $table->bigInteger('term_group')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('as_terms');
    }
}
