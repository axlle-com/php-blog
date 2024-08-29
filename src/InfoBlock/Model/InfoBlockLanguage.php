<?php

/**
 * Created by Reliese Model.
 */

namespace Main\InfoBlock\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class InfoBlockLanguage
 *
 * @property int $id
 * @property int $info_block_id
 * @property string $language
 * @property string $title
 * @property string|null $title_short
 * @property string|null $preview_description
 * @property string|null $description
 * @property InfoBlock $infoBlock
 */
class InfoBlockLanguage extends Model
{
    protected $table = 'info_block_language';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'id' => 'int',
        'info_block_id' => 'int',
    ];

    protected $fillable = [
        'language',
        'title',
        'title_short',
        'preview_description',
        'description',
    ];

    /**
     * @return BelongsTo<InfoBlock, InfoBlockLanguage>
     */
    public function infoBlock(): BelongsTo
    {
        return $this->belongsTo(InfoBlock::class);
    }
}
