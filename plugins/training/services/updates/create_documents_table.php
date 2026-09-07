<?php

namespace Training\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('training_services_documents', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->unsignedInteger('document_category_id');

            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();

            $table->unsignedInteger('download_count')->default(0);

            $table->timestamps();

            $table->foreign('document_category_id')
                ->references('id')
                ->on('training_services_document_categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_services_documents');
    }
}
