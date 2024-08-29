<?php

namespace Main\Post\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;/**
 * Class PostCategoryLanguage
 *
 * @property int $id
 * @property int $post_category_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $language
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 * @property string|null $preview_description
 * @property PostCategory $postCategory
 */

class PostCategoryLanguage extends Model
{
    protected $table = 'post_category_language';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'id' => 'int',
        'post_category_id' => 'int',
    ];

    protected $fillable = [
        'meta_title',
        'meta_description',
        'language',
        'title',
        'title_short',
        'description',
        'preview_description',
    ];

    /**
     * @return BelongsTo<PostCategory, PostCategoryLanguage>
     */
    public function postCategory(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class);
    }
}
