<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('date')->index();
            $table->foreignIdFor(\App\Models\User::class);
            $table->string('worker');
            $table->string('company');
            $table->integer('hours');
            $table->string('rate_per_hour');
            $table->string('taxable');
            $table->string('status');
            $table->string('shift_type');
            $table->string('paid_at');
            $table->float('total_pay');
$table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
                ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
