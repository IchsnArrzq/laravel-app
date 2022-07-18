<?php

use App\Models\Machine;
use App\Models\PlanningMachine;
use App\Models\Shift;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->foreignIdFor(PlanningMachine::class)->nullable();
            $table->foreignIdFor(Machine::class)->nullable();
            $table->integer('line_stop_a')->nullable();
            $table->integer('line_stop_b')->nullable();
            $table->integer('line_stop_c')->nullable();
            $table->integer('line_stop_other')->nullable();
            $table->integer('qty_actual')->nullable();
            $table->dateTime('datetime')->useCurrent();
            $table->boolean('status')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
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
