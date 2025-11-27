<?php

use App\enums\ActiveEnum;
use App\enums\Tasks\TaskStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('duration')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('amount', 10)->nullable();
            $table->decimal('reward', 10)->nullable();
            $table->boolean('active')->default(ActiveEnum::ACTIVE);
            $table->string('status')->default(TaskStatusEnum::OPEN);
            $table->string('type'); // TaskTypeEnum
            $table->text('description')->nullable();
            $table->integer('score')->nullable()->default(0);
            $table->unsignedBigInteger('wallet_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
