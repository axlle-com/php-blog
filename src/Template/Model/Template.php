<?php

namespace Main\Template\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Main\Post\Model\Post;
use Main\Post\Model\PostCategory;

/**
 * Class Template
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string|null $resource
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Collection|Post[] $posts
 * @property Collection|PostCategory[] $postCategories
 */
class Template extends Model
{
    use SoftDeletes;

    protected $table = 'template';

    protected $fillable = [
        'title',
        'name',
        'resource',
    ];

    /**
     * @return HasMany<Post>
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return HasMany<PostCategory>
     */
    public function postCategories(): HasMany
    {
        return $this->hasMany(PostCategory::class);
    }
}
