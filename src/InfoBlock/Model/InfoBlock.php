<?php

namespace Main\InfoBlock\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InfoBlock
 *
 * @property int $id
 * @property string $position
 * @property int $sort
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description_short
 * @property string|null $description
 * @property bool $make_watermark
 * @property string|null $media
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property InfoBlockHasResource $infoBlockHasResource
 * @property Collection|InfoBlockLanguage[] $infoBlockLanguages
 */
class InfoBlock extends Model
{
    use SoftDeletes;

    protected $table = 'info_block';

    protected $casts = [
        'sort' => 'int',
        'make_watermark' => 'bool',
    ];

    protected $fillable = [
        'position',
        'sort',
        'title',
        'title_short',
        'description_short',
        'description',
        'make_watermark',
        'media',
        'image',
    ];

    /**
     * @return HasOne<InfoBlockHasResource>
     */
    public function infoBlockHasResource(): HasOne
    {
        return $this->hasOne(InfoBlockHasResource::class);
    }

    /**
     * @return HasMany<InfoBlockLanguage>
     */
    public function infoBlockLanguages(): HasMany
    {
        return $this->hasMany(InfoBlockLanguage::class);
    }
}
