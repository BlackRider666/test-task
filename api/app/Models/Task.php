<?php

namespace App\Models;

use App\Enums\Task\TaskStatusEnum;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    /** @use HasFactory<TaskFactory> */
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'user_id',
        'parent_id',
        'status',
        'priority',
        'title',
        'description',
        'completed_at',
    ];

    protected $casts = [
        'status' => TaskStatusEnum::class,
        'completed_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id')->with('parent');
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->with('children');
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function isAuthor(int $userId): bool
    {
        return $this->user_id === $userId;
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->completed_at !== null && $this->status === TaskStatusEnum::DONE;
    }

    /**
     * @return bool
     */
    public function hasCompletedChild(): bool
    {
        return $this->children()->where('status', TaskStatusEnum::DONE)->whereNotNull('completed_at')->exists();
    }

    /**
     * @return bool
     */
    public function hasUncompletedChild(): bool
    {
        return $this->children()->where('status', '!=',TaskStatusEnum::DONE)->whereNull('completed_at')->exists();
    }
}
