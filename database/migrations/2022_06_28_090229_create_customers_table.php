<?php

use App\Models\User;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('alias');
            $table->string('pic');
            $table->string('primary');
            $table->string('secondary')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('number_fax')->nullable();
            $table->string('postcode');
            $table->text('address');
            $table->text('remark')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
