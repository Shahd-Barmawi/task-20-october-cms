<?php

namespace Training\Services\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('training_services_blog_posts', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');

            $table->unsignedBigInteger('blog_category_id');

            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            $table->foreign('blog_category_id')
                ->references('id')
                ->on('training_services_blog_categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_services_blog_posts');
    }
};
