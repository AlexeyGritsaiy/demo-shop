<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertsTables extends Migration
{
    public function up()
    {
        Schema::create('advert_adverts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users')->onDelete('CASCADE');

            $table->integer('manufacturer_id')->references('id')->on('advert_manufacturer')->nullable();

            $table->string('title');
            $table->integer('price');
            $table->text('address');
            $table->text('content')->nullable();
            $table->string('status', 16);
            $table->text('reject_reason')->nullable();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
        });

        Schema::create('advert_advert_values', function (Blueprint $table) {
            $table->integer('advert_id')->references('id')->on('advert_adverts')->onDelete('CASCADE');
            $table->integer('attribute_id')->references('id')->on('advert_attributes')->onDelete('CASCADE');
            $table->string('value');
            $table->primary(['advert_id', 'attribute_id']);
        });

        Schema::create('advert_advert_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sort_order');
            $table->boolean('is_main')->default(false);

            $table->integer('advert_id')->references('id')->on('advert_adverts')->onDelete('CASCADE');
            $table->string('file');
        });
    }

    public function down()
    {
        Schema::dropIfExists('advert_advert_photos');
        Schema::dropIfExists('advert_advert_values');
        Schema::dropIfExists('advert_adverts');
    }
}
