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
 * Class Post
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
 * @property bool $has_comments
 * @property bool $show_image_post
 * @property bool $show_image_category
 * @property bool $make_watermark
 * @property bool $in_sitemap
 * @property string|null $media
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 * @property string|null $description_short
 * @property bool $show_date
 * @property Carbon|null $date_pub
 * @property Carbon|null $date_end
 * @property string|null $image
 * @property int $hits
 * @property int $sort
 * @property float $stars
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property PostCategory|null $postCategory
 * @property Template|null $template
 * @property Collection|InfoBlock[] $infoBlocks
 * @property Collection|PostLanguage[] $postLanguages
 */
class Post extends Model
{
    use SoftDeletes;

    protected $table = 'post';

    protected $casts = [
        'template_id' => 'int',
        'post_category_id' => 'int',
        'is_published' => 'bool',
        'is_favourites' => 'bool',
        'has_comments' => 'bool',
        'show_image_post' => 'bool',
        'show_image_category' => 'bool',
        'make_watermark' => 'bool',
        'in_sitemap' => 'bool',
        'show_date' => 'bool',
        'date_pub' => 'datetime',
        'date_end' => 'datetime',
        'hits' => 'int',
        'sort' => 'int',
        'stars' => 'float',
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
        'has_comments',
        'show_image_post',
        'show_image_category',
        'make_watermark',
        'in_sitemap',
        'media',
        'title',
        'title_short',
        'description',
        'description_short',
        'show_date',
        'date_pub',
        'date_end',
        'image',
        'hits',
        'sort',
        'stars',
    ];

    /**
     * @return BelongsTo<PostCategory, Post>
     */
    public function postCategory(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class);
    }

    /**
     * @return BelongsTo<Template, Post>
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * @return BelongsToMany<InfoBlock>
     */
    public function infoBlocks(): BelongsToMany
    {
        return $this->belongsToMany(InfoBlock::class, 'post_has_info_block')
            ->withPivot('sort');
    }

    /**
     * @return HasMany<PostLanguage>
     */
    public function postLanguages(): HasMany
    {
        return $this->hasMany(PostLanguage::class);
    }
}
