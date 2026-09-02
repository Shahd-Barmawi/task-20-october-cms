<?php

namespace Training\Services\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('training_services_page_sections', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('page_id');

            $table->string('section_type');

            $table->text('content')->nullable();

            $table->integer('display_order')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->foreign('page_id')
                ->references('id')
                ->on('training_services_pages')
                ->onDelete('cascade');

            $table->index([
                'page_id',
                'display_order',
            ]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_services_page_sections');
    }
};
