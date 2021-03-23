<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->tinyInteger('rating');
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
        Schema::dropIfExists('authors_rates');
    }
}
