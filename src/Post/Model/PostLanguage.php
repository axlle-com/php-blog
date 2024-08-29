<?php

namespace Main\Post\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PostLanguage
 *
 * @property int $id
 * @property int $post_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $language
 * @property string $title
 * @property string|null $title_short
 * @property string|null $preview_description
 * @property string|null $description
 * @property Post $post
 */
class PostLanguage extends Model
{
    protected $table = 'post_language';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'id' => 'int',
        'post_id' => 'int',
    ];

    protected $fillable = [
        'meta_title',
        'meta_description',
        'language',
        'title',
        'title_short',
        'preview_description',
        'description',
    ];

    /**
     * @return BelongsTo<Post, PostLanguage>
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
