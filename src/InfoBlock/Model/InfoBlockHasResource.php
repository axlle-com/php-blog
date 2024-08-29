<?php

/**
 * Created by Reliese Model.
 */

namespace Main\InfoBlock\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class InfoBlockHasResource
 *
 * @property int $resource_id
 * @property string $resource
 * @property int $info_block_id
 * @property InfoBlock $infoBlock
 */
class InfoBlockHasResource extends Model
{
    protected $table = 'info_block_has_resource';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'resource_id' => 'int',
        'info_block_id' => 'int',
    ];

    protected $fillable = [
        'resource_id',
        'resource',
        'info_block_id',
    ];

    /**
     * @return BelongsTo<InfoBlock, InfoBlockHasResource>
     */
    public function infoBlock(): BelongsTo
    {
        return $this->belongsTo(InfoBlock::class);
    }
}
