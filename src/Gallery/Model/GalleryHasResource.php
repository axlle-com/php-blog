<?php

namespace Main\Gallery\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class GalleryHasResource
 *
 * @property int $gallery_id
 * @property string $resource
 * @property int $resource_id
 * @property Gallery $gallery
 */
class GalleryHasResource extends Model
{
    protected $table = 'gallery_has_resource';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'gallery_id' => 'int',
        'resource_id' => 'int',
    ];

    /**
     * @return BelongsTo<Gallery, GalleryHasResource>
     */
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
}
