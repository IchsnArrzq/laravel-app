<?php

use App\Models\Machine;
use App\Models\PlanningMachine;
use App\Models\Shift;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PlanningMachine::class);
            $table->integer('line_stop_a');
            $table->integer('line_stop_b');
            $table->integer('line_stop_c');
            $table->integer('line_stop_other');
            $table->integer('qty_actual');
            $table->dateTime('datetime');
            $table->boolean('status');
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
        Schema::dropIfExists('productions');
    }
};
