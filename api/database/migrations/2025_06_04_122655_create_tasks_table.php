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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('tasks')->cascadeOnDelete();
            $table->string('status'); // better if you want add new value of status
            $table->tinyInteger('priority');
            $table->string('title');
            $table->text('description');
            $table->timestampsTz();
            $table->dateTimeTz('completed_at')->nullable();

            $table->index(['user_id'], 'idx_user');
            $table->index(['user_id', 'priority', 'created_at'], 'idx_user_priority_created');
            $table->index(['user_id', 'priority', 'completed_at'], 'idx_user_priority_completed');
            $table->index(['user_id', 'created_at', 'completed_at'], 'idx_user_created_completed');
            $table->index(['user_id', 'status', 'priority', 'created_at'], 'idx_user_status_priority_created');
            $table->index(['user_id', 'parent_id'], 'idx_user_parent');
            $table->index(['status'], 'idx_status');
            $table->fullText(['title','description'],'idx_fulltext_title_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropIndex('idx_user');
            $table->dropIndex('idx_user_priority_created');
            $table->dropIndex('idx_user_priority_completed');
            $table->dropIndex('idx_user_created_completed');
            $table->dropIndex('idx_user_status_priority_created');
            $table->dropIndex('idx_user_parent');
            $table->dropIndex('idx_status');
            $table->dropFullText('idx_fulltext_title_description');
        });
        Schema::dropIfExists('tasks');
    }
};
