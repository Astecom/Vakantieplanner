<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_id')->index('applications_type_id_foreign');
            $table->unsignedBigInteger('status_id')->index('applications_status_id_foreign');
            $table->unsignedBigInteger('user_id')->index('applications_user_id_foreign');
            $table->string('remark', 191)->nullable();
            $table->string('application_status_remark', 191)->nullable();
            $table->dateTime('date_from');
            $table->dateTime('date_till')->nullable();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('applications');
    }
}
