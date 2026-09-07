<?php

namespace Training\Services\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create(
            'training_services_audit_logs',
            function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('backend_user_id')
                    ->nullable();

                $table->string('backend_user_name')
                    ->nullable();

                $table->string('action', 50);

                $table->string('module', 100);

                $table->unsignedBigInteger('record_id')
                    ->nullable();

                $table->text('description');

                $table->text('metadata')
                    ->nullable();

                $table->timestamps();

                $table->index('backend_user_id');
                $table->index('action');
                $table->index('module');
                $table->index('record_id');
                $table->index('created_at');
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists(
            'training_services_audit_logs'
        );
    }
};
