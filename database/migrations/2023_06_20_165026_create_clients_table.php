<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();

            // if (Schema::hasTable('employees')) {
                $table->foreign('employee_id')->references('id')->on('employees');
            // }
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
?>
