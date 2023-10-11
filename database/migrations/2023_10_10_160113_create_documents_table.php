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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('parent_id')->unsigned()->nullable()->comment('Null if its a parent');
            $table->string('original_filename', 200);
            $table->string('path', 300);
            $table->string('hashname', 300);
            $table->boolean('is_s3')->nullable()->default(false);
            $table->string('mime_type', 200)->nullable();
            $table->string('type', 200)->nullable();
            $table->string('title', 200)->nullable();
            $table->string('description', 500)->nullable();
            $table->unsignedInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
