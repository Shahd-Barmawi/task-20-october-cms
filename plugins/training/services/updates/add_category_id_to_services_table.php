<?php namespace Training\Services\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('training_services_services', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('training_services_services', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
};