<?php

namespace Main\Comment\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 *
 * @property int $id
 * @property int|null $comment_id
 * @property string $resource
 * @property int $resource_id
 * @property string $person
 * @property int $person_id
 * @property int $status
 * @property bool $is_viewed
 * @property int $level
 * @property string|null $path
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Comment|null $comment
 * @property Collection|Comment[] $comments
 */
class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comment';

    protected $casts = [
        'comment_id' => 'int',
        'resource_id' => 'int',
        'person_id' => 'int',
        'status' => 'int',
        'is_viewed' => 'bool',
        'level' => 'int',
    ];

    protected $fillable = [
        'comment_id',
        'resource',
        'resource_id',
        'person',
        'person_id',
        'status',
        'is_viewed',
        'level',
        'path',
        'text',
    ];

    /**
     * @return BelongsTo<Comment, Comment>
     */
    public function comment(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * @return HasMany<Comment>
     */
    public function comments(): HasMany
    {
        return $this->hasMany(self::class);
    }
}
