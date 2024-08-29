<?php

namespace Main\Post\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Main\InfoBlock\Model\InfoBlock;
use Main\Template\Model\Template;

/**
 * Class PostCategory
 *
 * @property int $id
 * @property int|null $template_id
 * @property int|null $post_category_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $alias
 * @property string $url
 * @property bool $is_published
 * @property bool $is_favourites
 * @property bool $make_watermark
 * @property bool $in_sitemap
 * @property string|null $image
 * @property bool $show_image
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 * @property string|null $preview_description
 * @property int $sort
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property PostCategory|null $postCategory
 * @property Template|null $template
 * @property Collection|Post[] $posts
 * @property Collection|PostCategory[] $postCategories
 * @property Collection|InfoBlock[] $infoBlocks
 * @property Collection|PostCategoryLanguage[] $postCategoryLanguages
 */
class PostCategory extends Model
{
    use SoftDeletes;

    protected $table = 'post_category';

    protected $casts = [
        'template_id' => 'int',
        'post_category_id' => 'int',
        'is_published' => 'bool',
        'is_favourites' => 'bool',
        'make_watermark' => 'bool',
        'in_sitemap' => 'bool',
        'show_image' => 'bool',
        'sort' => 'int',
    ];

    protected $fillable = [
        'template_id',
        'post_category_id',
        'meta_title',
        'meta_description',
        'alias',
        'url',
        'is_published',
        'is_favourites',
        'make_watermark',
        'in_sitemap',
        'image',
        'show_image',
        'title',
        'title_short',
        'description',
        'preview_description',
        'sort',
    ];

    /**
     * @return BelongsTo<PostCategory, PostCategory>
     */
    public function postCategory(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * @return BelongsTo<Template, PostCategory>
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

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
        return $this->hasMany(self::class);
    }

    /**
     * @return BelongsToMany<InfoBlock>
     */
    public function infoBlocks(): BelongsToMany
    {
        return $this->belongsToMany(InfoBlock::class, 'post_category_has_info_block')
            ->withPivot('sort');
    }

    /**
     * @return HasMany<PostCategoryLanguage>
     */
    public function postCategoryLanguages(): HasMany
    {
        return $this->hasMany(PostCategoryLanguage::class);
    }
}
