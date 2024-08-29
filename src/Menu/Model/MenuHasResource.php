<?php

namespace Main\Menu\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class MenuHasResource
 *
 * @property int $menu_id
 * @property string $resource
 * @property int $resource_id
 * @property Menu $menu
 */
class MenuHasResource extends Model
{
    protected $table = 'menu_has_resource';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'menu_id' => 'int',
        'resource_id' => 'int',
    ];

    /**
     * @return BelongsTo<Menu, MenuHasResource>
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
