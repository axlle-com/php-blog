<?php

namespace Main\Gallery\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GalleryImage
 *
 * @property int $id
 * @property int|null $gallery_id
 * @property string $original_name
 * @property string $image
 * @property string|null $title
 * @property string|null $description
 * @property int $sort
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Gallery|null $gallery
 */
class GalleryImage extends Model
{
    use SoftDeletes;

    protected $table = 'gallery_image';

    protected $casts = [
        'gallery_id' => 'int',
        'sort' => 'int',
    ];

    protected $fillable = [
        'gallery_id',
        'original_name',
        'image',
        'title',
        'description',
        'sort',
    ];

    /**
     * @return BelongsTo<Gallery, GalleryImage>
     */
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
}
