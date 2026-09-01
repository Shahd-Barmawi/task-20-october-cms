<?php namespace Training\Services\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('training_services_contact_messages', function(Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->text('message');

            $table->string('status')->default('new');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_services_contact_messages');
    }
};