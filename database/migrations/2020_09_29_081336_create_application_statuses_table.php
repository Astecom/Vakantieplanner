<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->string('btn_class', 190);
            $table->boolean('active')->default(1);
            $table->timestamps();

          });

          $data = [
          ['id'=> 1, 'active'=>0, 'name'=>'in afwachting', 'btn_class'=>'btn-primary'],
          ['id'=> 2, 'active'=>1, 'name'=>'goedgekeurd', 'btn_class'=>'btn-success'],
          ['id'=> 3, 'active'=>1, 'name'=>'afgekeurd', 'btn_class'=>'btn-danger'],
          ];

          DB::table('application_statuses')->insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_statuses');
    }
}
